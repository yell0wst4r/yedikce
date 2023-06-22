<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');

?>
<!DOCTYPE html>
<html lang="en">
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
          <a class="nav-link active" style= "color:#e7bb8b;" aria-current="page" href="nologin.php"><h4>Ana Sayfa</h4></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="nologin.php"><h4>Kategoriler</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="nologin.php"><h4>Ürünlerimiz</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="#"><h4>Duyurular</h4></a>
        </li>
   
      </ul>
      <form class="d-flex" action="nologin.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Ne arıyorsunuz?" aria-label="Search" name = "search_data">
        <input type="submit" value = "Ara" style= "color:#e7bb8b;" class="btn btn-outline-light" name = "search_data_product">
      </form>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="../user_işlemler/usergiris.php">Giriş Yap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="../user_işlemler/userkayit.php">Kayıt Ol</a>
        </li>
</ul>
</nav>

  <div class="bg" style="background-color:#e7bb8b;">
<h3 class="text-center" >Hoşgeldiniz</h3>
<p class="text-center" >Sipariş vermek için giriş yapınız. Hesabınız yoksa kayıt olunuz.</p>
  </div>

  <div class="row px-1">
    <div class="col-md-10">
<div class="row">
<div class="py-2 m-1 "><img src="/images/aaa.jpg" style="width:1640px;height:800px;" /></div>

</div>      
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