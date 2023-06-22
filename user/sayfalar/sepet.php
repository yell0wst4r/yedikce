<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\function.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./user_işlemler/usergiris.php");
    exit;
}

if(isset($_POST['sepet_degistir'])){
    $urun_id = $_POST['urun_id'];
    $qty = intval($_POST['qty']);
    $get_ip_adres = getIPAddress();
    $sepet_degistir = "UPDATE kart_detayi SET adet ='$qty' WHERE ip_adres='$get_ip_adres' AND urun_id='$urun_id'";
    $result_urun_adet = mysqli_query($con,$sepet_degistir);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yedikçe Sepet Detayı</title>

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
          <a class="nav-link" style= "color:#e7bb8b;" href="#"><h4>İletişim</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php sepet_item(); ?></sup></a>
        </li>
      </ul>
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
<h3 class="text-center" >Ürünlerimiz</h3>
<p class="text-center" >Sipariş etmek istediğiniz ürünleri sepetinize ekleyebilirsiniz.</p>
  </div>

  <div class="container">
    <div class="row">
        <table class="table table-bordered text-center">

              <?php
              $get_ip_adres = getIPAddress();
              $toplam_fiyat = 0;
              $userId = $_SESSION['user_id'];
              $sepet_query = "SELECT * FROM kart_detayi where ip_adres='$get_ip_adres' and user_id = '$userId'";
              $result = mysqli_query($con,$sepet_query);
              $result_count = mysqli_num_rows($result);

              if($result_count>0){
                echo "  <thead>
                <tr>
                    <th>Ürün adı</th>
                    <th>Ürün Fotoğrafı</th>
                    <th>Adet</th>
                    <th>Ürün Fiyatı</th>
                    <th>Kaldır</th>
                    <th colspan='2'>İşlemler</th>
                </tr>
               </thead>
              <tbody>";

              while($row = mysqli_fetch_array($result)){
                $urun_id = $row['urun_id'];
                $urun_adet = $row['adet'];
                $select_urun = "SELECT * FROM urunler where urun_id='$urun_id'";
                $result_urun = mysqli_query($con,$select_urun);
 
                if ($result_urun) {
                    while ($row_urun = mysqli_fetch_assoc($result_urun)) {
                        $urun_adi = $row_urun['urun_adi'];
                        $urun_foto = $row_urun['urun_foto'];
                        $urun_fiyat = $row_urun['urun_fiyat'];
                        $toplam_fiyat+=($urun_adet*intval($urun_fiyat));
                        echo "<form method='post'>
                        <tr>
                        <td>$urun_adi</td>
                        <td><img src='/admin/urun_foto/$urun_foto' alt='' class='kart_foto'></td>
                        <td><input type='number' name='qty' value='$urun_adet' class='form_input w-50'></td>
                        <td>$urun_fiyat</td>
                        <td><input type='checkbox' name='urunkaldir'></td>
                        <td>
                        <input type='hidden' name='urun_id' value='$urun_id'>
                        <input type='submit' value='Değiştir' class='btn btn-warning px-3 py-2 border-0 mx-3' name='sepet_degistir'>
                        <input type='submit' value='Kaldır' class='btn btn-secondary px-3 py-2 border-0 mx-3' name='sepet_kaldir'>
                        </td>
                        </tr>    
                        </form>";
                    }
                   }
                 }
               }
                else{
                  echo "<h2 class='text-center text-danger'> Sepetiniz boş.</h2>";
                }
                ?>
            </tbody>
        </table>
        <div class="d-flex mb-5">
          <?php
             $get_ip_adres = getIPAddress();
             $sepet_query = "SELECT * FROM kart_detayi where ip_adres='$get_ip_adres'"; 
             $result = mysqli_query($con,$sepet_query);
             $result_count = mysqli_num_rows($result);
             if($result_count>0){
              echo "<h4 class='px-3'>Toplam Tutar:<strong class='text-dark'> $toplam_fiyat TL </strong></h4>
              <button class='btn btn-warning px-3 py-2 border-0 mx-3'><a href ='../user_hesap/siparis.php' class='text-dark text-decoration-none'> Satın Al</a></button>
              <button class='btn btn-secondary px-3 py-2 border-0'><a href ='anasayfa.php' class='text-light text-decoration-none'> İptal</a></button>";
             }else{
              echo "<input type='submit' value= 'Alışverişe Devam Et' class='btn btn-warning px-3 py-2 border-0 mx-3' name='alisveris_devam'>";
             }
             if(isset($_POST['alisveris_devam'])){
              echo "<script>window.open('anasayfa.php','_self')</script>";
             }
          ?>            
        </div>
    </div>
  </div>

  <?php
  delete();
  ?>
 
    <div class="nav-item p-3 text-center" style="background-color: #943939;" style= "color:white">
    <p>Sitenin bütün hakları Yedikçe'ye aittir. @ Designed by Tarık Sarıyıldız </p>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>