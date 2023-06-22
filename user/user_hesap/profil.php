<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\function.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../user_işlemler/usergiris.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yedikçe</title>

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
    <img src="/images/yedikcelogo.png" alt="" style="width:200px;height:100%;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" style= "color:#e7bb8b;" aria-current="page" href="../sayfalar/anasayfa.php"><h4>Ana Sayfa</h4></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="../sayfalar/urunler.php"><h4>Ürünlerimiz</h4></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="profil.php"><h4>Hesabım</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="../sayfalar/urunler.php"><h4>Duyurular</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php sepet_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="../sayfalar/sepet.php"><h5>Toplam Tutar:<?php sepet_toplami() ?> TL</h5></a>
        </li>
      </ul>
      <form class="d-flex" action="../sayfalar/ara.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Ne arıyorsunuz?" aria-label="Search" name = "search_data">
        <input type="submit" value = "Ara" style= "color:#e7bb8b;" class="btn btn-outline-light" name = "search_data_product">
      </form>
    </div>
  </div>
</nav>
<?php
sepet();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
  <?php
  if(!isset($_SESSION['email'])){
    echo "<li class='nav-item'>
    <a class='nav-link'href='#'> Hoşgeldin User </a>
    </li>";
  }else {
    echo "<li class ='nav-item'>
    <a class='nav-link' href='#'> Hoşgeldin ".$_SESSION['email']." </a>
    </li>";
  }
  ?>
</ul>
</nav>
  <div class="row">
    <div class="col-md-2 p-0">
    <ul class="navbar-nav bg-secondary text-center" style="height:70vh">
        <li class="nav-item " style="background-color:#943939;">
          <a class="nav-link " style= "color:#e7bb8b;" href="profil.php"><h4>Hesabım</h4></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="profil.php?user_siparis">Siparişler</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="profil.php?edit_profil">Bilgileri Düzenle</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="profil.php?user_sikayet">Şikayet Et</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="../user_hesap/usersifre.php">Şifre Değiştir</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="../user_hesap/usercikis.php">Çıkış Yap</a>
        </li>
    </ul>
    </div>
    <div class="col-md-10">
        <?php 
        get_user_siparis_detayi();
        if(isset($_GET['edit_profil'])){
          include('editprofil.php');
        }
        if(isset($_GET['user_siparis'])){
          include('usersiparis.php');
        }
        if(isset($_GET['user_sikayet'])){
          include('sikayet.php');
        }
        ?>
    </div>
  </div>
  


<div class="nav-item p-3 text-center" style="background-color: #943939;" style= "color:white">
<p>Sitenin bütün hakları Yedikçe'ye aittir. @ Designed by Tarık Sarıyıldız </p>
</div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>