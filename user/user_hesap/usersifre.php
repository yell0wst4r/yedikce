<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../user_işlemler/usergiris.php");
    exit;
}
 
require_once "C:\Users\Tarık Sarıyıldız\Desktop\yedikce\config.php";
 
$new_sifre = $confirm_sifre = "";
$new_sifre_err = $confirm_sifre_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["new_sifre"]))){
        $new_sifre_err = "Yeni şifrenizi girin.";     
    } elseif(strlen(trim($_POST["new_sifre"])) < 6){
        $new_sifre_err = "Şifre 6 karakterden fazla olmalı.";
    } else{
        $new_sifre = trim($_POST["new_sifre"]);
    }
    

    if(empty(trim($_POST["confirm_sifre"]))){
        $confirm_sifre_err = "Lütfen şifrenizi doğrulayın.";
    } else{
        $confirm_sifre = trim($_POST["confirm_sifre"]);
        if(empty($new_sifre_err) && ($new_sifre != $confirm_sifre)){
            $confirm_sifre_err = "Şifreler eşleşmedi.";
        }
    }
        
    if(empty($new_sifre_err) && empty($confirm_sifre_err)){
        $sql = "UPDATE user SET sifre = ? WHERE user_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_sifre, $param_id);
            
            $param_sifre = password_hash($new_sifre, PASSWORD_DEFAULT);
            $param_id = $_SESSION["user_id"];
            
            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: ../user_işlemler/usergiris.php");
                exit();
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
    <title>Şifre Yenile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ background-color:#943939; width: 400px; border-style: double; padding: 10px; border-width: 10px; border-color: #e7bb8b ;  margin: 50px auto;  color: #e7bb8b ; }
    </style>
</head>
<body
style="background-color:#943939;">
    <div class="wrapper">
        <h2>Şifre Yenileme</h2>
        <p>Şifrenizi yenilemek için formu doldurunuz.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Yeni Şifre</label>
                <input type="sifre" name="new_sifre" autocomplete="off" class="form-control <?php echo (!empty($new_sifre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_sifre; ?>">
                <span class="invalid-feedback"><?php echo $new_sifre_err; ?></span>
            </div>
            <div class="form-group">
                <label>Şifreyi doğrulayınız</label>
                <input type="sifre" name="confirm_sifre" autocomplete="off" class="form-control <?php echo (!empty($confirm_sifre_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_sifre_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning active" value="Yenile">
                <a class="btn btn-secondary ml-2" href="profil.php">İptal</a>
            </div>
        </form>
    </div>    
</body>
</html>