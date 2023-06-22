<?php
require_once "C:\Users\Tarık Sarıyıldız\Desktop\yedikce\config.php";
 
$sifre = $confirm_sifre = $ad = $soyad = $email = $adres = $telefon_no = "";
$sifre_err = $confirm_sifre_err = $ad_err = $soyad_err = $email_err = $adres_err = $telefon_no_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["email"]))){
        $email_err = "Lütfen email adresinizi giriniz.";
    } elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", trim($_POST["email"]))){
        $email_err = "Email adresinizi doğru bir şekilde giriniz.";
    } else{

        $sql = "SELECT user_id FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $email);
            
            $email = trim($_POST["email"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Bu email adresi kullanılıyor.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Birşeyler yanlış gitti. Lütfen daha sonra tekrar deneyiniz.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["ad"]))){
        $ad_err = "Lütfen adınızı girin.";     
    } elseif(strlen(trim($_POST["ad"])) < 1){
        $ad_err = "Adınız boş olamaz.";
    } else{
        $ad = trim($_POST["ad"]);
    }

    if(empty(trim($_POST["soyad"]))){
        $soyad_err = "Lütfen soyadınızı girin.";     
    } elseif(strlen(trim($_POST["soyad"])) < 1){
        $soyad_err = "Soyadınız boş olamaz.";
    } else{
        $soyad = trim($_POST["soyad"]);
    }
    
    if(empty(trim($_POST["telefon_no"]))){
        $telefon_no_err = "Lütfen telefon numaranızı girin.";     
    } elseif(strlen(trim($_POST["telefon_no"])) < 6){
        $telefon_no_err = "Telefon numaranızı doğru giriniz.";
    } else{
        $telefon_no = trim($_POST["telefon_no"]);
    }

    if(empty(trim($_POST["adres"]))){
        $adres_err = "Lütfen adresinizi girin.";     
    } elseif(strlen(trim($_POST["adres"])) < 6){
        $adres_err = "Adresinizi doğru giriniz.";
    } else{
        $adres = trim($_POST["adres"]);
    }

    if(empty(trim($_POST["sifre"]))){
        $sifre_err = "Lütfen şifrenizi giriniz.";     
    } elseif(strlen(trim($_POST["sifre"])) < 6){
        $sifre_err = "Şifreniz 6 karakterden fazla olmalı.";
    } else{
        $sifre = trim($_POST["sifre"]);
    }
    
    if(empty(trim($_POST["confirm_sifre"]))){
        $confirm_sifre_err = "Lütfen şifrenizi doğrulayın.";     
    } else{
        $confirm_sifre = trim($_POST["confirm_sifre"]);
        if(empty($sifre_err) && ($sifre != $confirm_sifre)){
            $confirm_sifre_err = "Şifreler eşleşmedi.";
        }
    }
    
    if(empty($email_err) && empty($adres_err) && empty($sifre_err) && empty($confirm_sifre_err) && empty($confirm_ad_err) && empty($confirm_soyad_err) && empty($confirm_telefon_no_err)){
        
        $sql = "INSERT INTO user (email, ad, soyad, adres, telefon_no, sifre) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_email, $param_ad, $param_soyad, $param_adres, $param_telefon_no, $param_sifre );
            
            $param_email = $email;
            $param_ad = $ad;
            $param_soyad = $soyad;
            $param_adres = $adres;
            $param_telefon_no = $telefon_no;
            $param_sifre = password_hash($sifre, PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){

                header("location: usergiris.php");
            } else{
                echo "Oops! Birşeyler yanliş gitti. Lütfen daha sonra tekrar deneyiniz.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
    </style>
    <link rel="stylesheet" href="/style.css">
</head>
<div style="text-align: center;">
<img src="/images/yedikcelogo.png" style="width:400px;height:300px;" >
<div>
<body style="background-color:#943939;">
    <div class="wrapper">
        <h2>KULLANICI KAYIT</h2>
        <p>Hesap oluşturmak için formu doldurunuz.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" autocomplete="off" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Ad</label>
                <input type="text" name="ad" autocomplete="off" class="form-control <?php echo (!empty($ad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ad; ?>">
                <span class="invalid-feedback"><?php echo $ad_err; ?></span>
            </div>   
            <div class="form-group">
                <label>Soyad</label>
                <input type="text" name="soyad" autocomplete="off" class="form-control <?php echo (!empty($soyad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $soyad; ?>">
                <span class="invalid-feedback"><?php echo $soyad_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Telefon Numarası</label>
                <input type="number" name="telefon_no" autocomplete="off" class="form-control <?php echo (!empty($telefon_no_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefon_no; ?>">
                <span class="invalid-feedback"><?php echo $telefon_no_err; ?></span>
            </div>
            <div class="form-group">
                <label>Adres</label>
                <input type="text" name="adres" autocomplete="off" class="form-control <?php echo (!empty($adres_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adres; ?>">
                <span class="invalid-feedback"><?php echo $adres_err; ?></span>
            </div>
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="sifre" class="form-control <?php echo (!empty($sifre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sifre; ?>">
                <span class="invalid-feedback"><?php echo $sifre_err; ?></span>
            </div>
            <div class="form-group">
                <label>Şifreyi doğrulayınız</label>
                <input type="password" name="confirm_sifre" class="form-control <?php echo (!empty($confirm_sifre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_sifre; ?>">
                <span class="invalid-feedback"><?php echo $confirm_sifre_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning active" value="Kayıt Ol">
                <input type="reset" class="btn btn-secondary ml-2" value="Yenile">
            </div>
            <p>Hesabınız var ise <a href="usergiris.php">Giriş Yapın</a>.</p>
        </form>
    </div>    
</body>
</html>