<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\function.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../usergiris.php");
    exit;
}

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
          <a class="nav-link active" style= "color:#e7bb8b;" aria-current="page" href="anasayfa.php"><h4>Ana Sayfa</h4></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " style= "color:#e7bb8b;" href="urunler.php"><h4>Ürünlerimiz</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="../user_hesap/profil.php"><h4>Hesabım</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="user_duyurular.php"><h4>Duyurular</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php sepet_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="sepet.php"><h5>Toplam Tutar:<?php sepet_toplami() ?> TL</h5></a>
        </li>
      </ul>
      <form class="d-flex" action="ara.php" method="get">
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
        <li class="nav-item">
          <a class="nav-link" style= "color:#e7bb8b;" href="../user_hesap/usercikis.php">Çıkış Yap</a>
        </li>
</ul>
</nav>

  <div class="bg" style="background-color:#e7bb8b;">
<h1 class="text-center" >Duyurular</h1>
<p class="text-center" >Sizlerinde vereceği tavsiyelerle birlikte yeniliklerimizi burdan takip edebilirsiniz.</p>
  </div>

  <?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');

$select_duyurular = "SELECT * FROM duyurular";
$result_duyurular = mysqli_query($con, $select_duyurular);

while ($row = mysqli_fetch_assoc($result_duyurular)) {
    $duyuru_id = $row['duyuru_id'];
    $duyuru_baslik = $row['duyuru_baslik'];
    $duyuru_icerik = $row['duyuru_icerik'];
    $duyuru_foto = $row['duyuru_fotograf'];

    echo "<h2 class='dbaslik'>$duyuru_baslik</h2>";
    echo "<p class= 'dicerik'>$duyuru_icerik</p>";
    echo "<img src='/admin/duyuru_foto/$duyuru_foto' class ='foto'alt='Duyuru Fotoğrafı'>";

    $select_yorumlar = "SELECT * FROM yorumlar WHERE duyuru_id = '$duyuru_id'";
    $result_yorumlar = mysqli_query($con, $select_yorumlar);

    if (mysqli_num_rows($result_yorumlar) > 0) {
        echo "<h4 class='ybaslik'>Yorumlar:</h4>";

        while ($yorum_row = mysqli_fetch_assoc($result_yorumlar)) {
            $yorum = $yorum_row['yorum'];
            $kullanici_id = $yorum_row['user_id'];

            $select_kullanici = "SELECT * FROM user WHERE user_id = '$kullanici_id'";
            $result_kullanici = mysqli_query($con, $select_kullanici);
            $kullanici_row = mysqli_fetch_assoc($result_kullanici);
            $kullanici_email = $kullanici_row['email'];

            echo "<p class='yorum'><strong>$kullanici_email:</strong> $yorum</p>";
        }
    }

    echo "<form method='post'>";
    echo "<input type='hidden' name='duyuru_id' value='$duyuru_id'>";
    echo "<input type='hidden' name='user_id' value='".$_SESSION["user_id"]."'>";
    echo "<input class='yform' type='text' name='yorum_icerik' placeholder='Yorumunuzu girin'>";
    echo "<input class='ybuton' type='submit' name='yorum_yap' value='Yorum Yap'>";
    echo "</form>";
}
?>

<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');

if(isset($_POST['yorum_yap'])){
    $duyuru_id = $_POST['duyuru_id'];
    $user_id = $_POST['user_id'];
    $yorum = $_POST['yorum_icerik'];

    if($yorum==''){
        echo "<script>alert('Lütfen yorumunuzu girin.')</script>";
    }
    else{
        $insert_yorum = "INSERT INTO yorumlar (duyuru_id, user_id, yorum) VALUES ('$duyuru_id','$user_id', '$yorum')";
        $result_yorum = mysqli_query($con, $insert_yorum);
        if($result_yorum){
          echo "<script>alert ('Yorumunuz başarıyla yapıldı.') </script>";
          echo "<script>window.open ('user_duyurular.php','_self') </script>";        }
    }
}
?>

<div class="nav-item p-3 text-center" style="background-color: #943939;" style= "color:white">
    <p>Sitenin bütün hakları Yedikçe'ye aittir. @ Designed by Tarık Sarıyıldız </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous">
</script>
</body>
</html>


