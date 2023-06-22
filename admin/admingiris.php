<?php
include_once 'C:\Users\Tarık Sarıyıldız\Desktop\yedikce\config.php';

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: adminpanel.php");
    exit;
}
 
require_once "C:\Users\Tarık Sarıyıldız\Desktop\yedikce\config.php";
 
$kullanici_adi = $sifre = "";
$kullanici_adi_err = $sifre_err = $admingiris_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["kullanici_adi"]))){
        $kullanici_adi_err = "Lütfen kullanıcı adıni girin.";
    } else{
        $kullanici_adi = trim($_POST["kullanici_adi"]);
    }
    
    if(empty(trim($_POST["sifre"]))){
        $sifre_err = "Lütfen şifrenizi girin.";
    } else{
        $sifre = trim($_POST["sifre"]);
    }
    
    if(empty($kullanici_adi_err) && empty($sifre_err)){
        $sql = "SELECT id, kullanici_adi, sifre FROM admin WHERE kullanici_adi = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_kullanici_adi);
            
            $param_kullanici_adi = $kullanici_adi;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
        
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $kullanici_adi, $hashed_sifre);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($sifre, $hashed_sifre)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["kullanici_adi"] = $kullanici_adi;  
                                                 
                            
                            header("location: adminpanel.php");
                        } else{
                            $admingiris_err = "Geçersiz kullanıcı adı yada şifre.";
                        }
                    }
                } else{
                    $admingiris_err = "Geçersiz kullanıcı adı yada şifre.";
                }
            } else{
                echo "Oops! Birşeyler yanlış gitti. Lütfen daha sonra tekrar deneyiniz.";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ background-color:#e7bb8b; width: 400px; border-style: double; padding: 10px; border-width: 10px; border-color: #943939 ;  margin:auto;  color: #943939; }
    </style>
</head>
<div style="text-align: center;">
<a href="../user/user_işlemler/usergiris.php"><img src="../images/yedikcelogo.png" style="width:400px;height:300px;" > </a>
<div>
<body
style="background-color:#943939;">
    <div class="wrapper">
        <h2>ADMİN GİRİŞ</h2>
        <p>Giriş yapmak için bilgilerinizi girin.</p>

        <?php 
        if(!empty($admingiris_err)){
            echo '<div class="alert alert-danger">' . $admingiris_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" name="kullanici_adi" class="form-control <?php echo (!empty($kullanici_adi_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $kullanici_adi; ?>">
                <span class="invalid-feedback"><?php echo $kullanici_adi_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="sifre" class="form-control <?php echo (!empty($sifre_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $sifre_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning active " value="Giriş Yap">
            </div>
            <p>Hesabınız yok mu? <a href="adminkayit.php">Kayıt olun.</a>.</p>
        </form>
    </div>
</body>
</html>