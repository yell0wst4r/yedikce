<?php
require_once "C:\Users\Tarık Sarıyıldız\Desktop\yedikce\config.php";
 
$kullanici_adi = $sifre = $confirm_sifre = $ad = $soyad = "";
$kullanici_adi_err = $sifre_err = $confirm_sifre_err = $ad_err = $soyad_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["kullanici_adi"]))){
        $kullanici_adi_err = "Lütfen kullanıcı adını giriniz.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["kullanici_adi"]))){
        $kullanici_adi_err = "Kullanıcı adı sadece harf ve sayilardan oluşabilir.";
    } else{

        $sql = "SELECT id FROM admin WHERE kullanici_adi = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $kullanici_adi);
            
            $kullanici_adi = trim($_POST["kullanici_adi"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $kullanici_adi_err = "Bu kullanıcı adı alındi.";
                } else{
                    $kullanici_adi = trim($_POST["kullanici_adi"]);
                }
            } else{
                echo "Oops! Birşeyler yanlış gitti. Lütfen daha sonra tekrar deneyiniz.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["ad"]))){
        $ad_err = "Lütfen adınızı girin.";     
    } elseif(strlen(trim($_POST["ad"])) == 0){
        $ad_err = "Adınız boş olamaz.";
    } else{
        $ad = trim($_POST["ad"]);
    }

    if(empty(trim($_POST["soyad"]))){
        $soyad_err = "Lütfen soyadınızı girin.";     
    } elseif(strlen(trim($_POST["soyad"])) == 0){
        $soyad_err = "Soyadınız boş olamaz.";
    } else{
        $soyad = trim($_POST["soyad"]);
    }
    
    if(empty(trim($_POST["sifre"]))){
        $sifre_err = "Lütfen şifreyi giriniz.";     
    } elseif(strlen(trim($_POST["sifre"])) < 6){
        $sifre_err = "Şifre 6 karakterden fazla olmalı.";
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
    
    if(empty($kullanici_adi_err) && empty($sifre_err) && empty($confirm_sifre_err) && empty($confirm_ad_err) && empty($confirm_soyad_err)){
        
        $sql = "INSERT INTO admin (kullanici_adi, ad, soyad, sifre) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_kullanici_adi, $param_ad, $param_soyad , $param_sifre );
            
            $param_kullanici_adi = $kullanici_adi;
            $param_ad = $ad;
            $param_soyad = $soyad;
            $param_sifre = password_hash($sifre, PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){

                header("location: admingiris.php");
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
        .wrapper{ background-color:#e7bb8b; width: 400px; border-style: double; padding: 10px; border-width: 10px; border-color: #943939 ;  margin: auto;  color: #943939 ;
 }
    </style>
</head>
<div style="text-align: center;">
<img src="../images/yedikcelogo.png" style="width:400px;height:300px;" >
<div>
<body style="background-color:#943939;">
    <div class="wrapper">
        <h2>ADMİN KAYIT</h2>
        <p>Hesap oluşturmak için formu doldurunuz.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" name="kullanici_adi" class="form-control <?php echo (!empty($kullanici_adi_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $kullanici_adi; ?>">
                <span class="invalid-feedback"><?php echo $kullanici_adi_err; ?></span>
            </div>
            <div class="form-group">
                <label>Ad</label>
                <input type="text" name="ad" class="form-control <?php echo (!empty($ad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ad; ?>">
                <span class="invalid-feedback"><?php echo $ad_err; ?></span>
            </div>   
            <div class="form-group">
                <label>Soyad</label>
                <input type="text" name="soyad" class="form-control <?php echo (!empty($soyad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $soyad; ?>">
                <span class="invalid-feedback"><?php echo $soyad_err; ?></span>
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
            <p>Hesabınız var ise <a href="admingiris.php">Giriş Yapın</a>.</p>
        </form>
    </div>    
</body>
</html>