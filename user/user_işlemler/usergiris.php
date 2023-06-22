<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: sayfalar/anasayfa.php");
    exit;
}
 
require_once "C:\Users\Tarık Sarıyıldız\Desktop\yedikce\config.php";
 
$email = $sifre = "";
$email_err = $sifre_err = $usergiris_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["email"]))){
        $email_err = "Lütfen email adresinizi girin.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["sifre"]))){
        $sifre_err = "Lütfen şifrenizi girin.";
    } else{
        $sifre = trim($_POST["sifre"]);
    }
    
    if(empty($email_err) && empty($sifre_err)){
        $sql = "SELECT user_id, email, sifre FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
        
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_sifre);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($sifre, $hashed_sifre)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["email"] = $email;  
                                                 
                            
                            header("location: ../sayfalar/anasayfa.php");
                        } else{
                            $usergiris_err = "Geçersiz email adresi yada şifre.";
                        }
                    }
                } else{
                    $usergiris_err = "Geçersiz email adresi yada şifre.";
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
    </style>
    <link rel="stylesheet" href="/style.css">
</head>
<div style="text-align: center;">
<a href="/admin/admingiris.php"><img src="/images/yedikcelogo.png" style="width:400px;height:300px;"></a>
<div>
<body
style="background-color:#943939;">
    <div class="wrapper">
        <h2>KULLANICI GİRİŞİ</h2>
        <p>Giriş yapmak için bilgilerinizi girin.</p>

        <?php 
        if(!empty($usergiris_err)){
            echo '<div class="alert alert-danger">' . $usergiris_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="sifre" class="form-control <?php echo (!empty($sifre_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $sifre_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning active " value="Giriş Yap">
            </div>
            <p>Hesabınız yok mu? <a href="userkayit.php">Kayıt olun.</a>.</p>
        </form>
    </div>
</body>
</html>