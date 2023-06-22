<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\function.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: admingiris.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/style.css">
</head>
<body style="background-color:#e7bb8b;">
    
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #943939;">
        <div class="container-fluid">
            <img src="../images/yedikcelogo.png" style="width:200px;height:100%;" alt="">
        </div>
    </nav>

    <div class="bg-light">
        <h1 class="text-center p-2" style="background-color:#e7bb8b;">Yönetim Paneli</h1>
    </div>
    <div class="row">
        <div class="col-md-12 p-1 d-flex align-items-center" style="background-color:#943939;">
            <div class="px-5">
                <a href="#"><img src="../images/logo.png" alt="" class="admin_foto"></a>
                <p class="text-light text-center"><?php echo htmlspecialchars($_SESSION["kullanici_adi"]); ?></p>
            </div>
            <div class="button text-center">
                <button><a href="adminpanel.php?urun_list" class="nav-link text-dark" style="background-color:#e7bb8b;">Ürünler</a></button>
                <button><a href="adminpanel.php?urun_ekle" class="nav-link text-dark" style="background-color:#e7bb8b;">Ürün Ekle</a></button>
                <button><a href="adminpanel.php?kat_list" class="nav-link text-dark" style="background-color:#e7bb8b;">Kategoriler</a></button>
                <button><a href="adminpanel.php?kat_ekle" class="nav-link text-dark" style="background-color:#e7bb8b;">Kategori Ekle</a></button>
                <button><a href="adminpanel.php?gelen_siparis" class="nav-link text-dark" style="background-color:#e7bb8b;">Siparişler</a></button>
                <button><a href="adminpanel.php?user_list" class="nav-link text-dark" style="background-color:#e7bb8b;">Üyeler</a></button>
                <button><a href="adminpanel.php?user_sikayet" class="nav-link text-dark" style="background-color:#e7bb8b;">Şikayetler</a></button>
                <button><a href="adminpanel.php?duyurular" class="nav-link text-dark" style="background-color:#e7bb8b;">Duyurular</a></button>
                <button><a href="adminpanel.php?duyuru_ekle" class="nav-link text-dark" style="background-color:#e7bb8b;">Duyuru Ekle</a></button>
                <button><a href="../admin/adminsifre.php" class="nav-link text-dark" style="background-color:#e7bb8b;">Şifre Değiş</a></button>
                <button><a href="../admin/admincikis.php" class="nav-link text-dark" style="background-color:#e7bb8b;">Çıkış Yap</a></button>

            </div>
        </div>
    </div>
    <div class="container my-3">
        <?php 
        if(isset($_GET['urun_list'])){
            include('ürünler/urun_list.php');
        }
        if(isset($_GET['urun_duzenle'])){
            include('ürünler/urun_duzenle.php');
        }
        if(isset($_GET['urun_ekle'])){
            include('ürünler/urun_ekle.php');
        }
        if(isset($_GET['urun_sil'])){
            include('ürünler/urun_sil.php');
        }
        if(isset($_GET['kat_ekle'])){
            include('kategoriler/kategori_ekle.php');
        }
        if(isset($_GET['kat_list'])){
            include('kategoriler/kategori_list.php');
        }
        if(isset($_GET['kat_duzenle'])){
            include('kategoriler/kategori_duzenle.php');
        }
        if(isset($_GET['kat_sil'])){
            include('kategoriler/kategori_sil.php');
        }
        if(isset($_GET['user_list'])){
            include('user_list.php');
        }
        if(isset($_GET['user_sikayet'])){
            include('user_sikayet.php');
        }
        if(isset($_GET['user_sil'])){
            include('user_sil.php');
        }
        if(isset($_GET['gelen_siparis'])){
            include('gelen_siparis.php');
        }
        if(isset($_GET['duyuru_ekle'])){
            include('duyuru_ekle.php');
        }
        if(isset($_GET['duyurular'])){
            include('duyurular.php');
        }
        if(isset($_GET['duyuru_duzenle'])){
            include('duyuru_duzenle.php');
        }
        if(isset($_GET['duyuru_sil'])){
            include('duyuru_sil.php');
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>    

</body>
</html> 