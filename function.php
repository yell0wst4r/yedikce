<?php
include ('connect.php');

function urunal(){
    if(!isset($_GET['kategoriler'])){
    global $con;
    $select_query = "SELECT * FROM urunler order by rand() LIMIT 0,6";
    $result_query = mysqli_query($con,$select_query);
    while($row = mysqli_fetch_assoc($result_query)){
      $urun_id = $row['urun_id'];
      $urun_adi = $row['urun_adi'];
      $urun_aciklama = $row['urun_aciklama'];
      $urun_fiyat = $row['urun_fiyat'];
      $urun_foto = $row['urun_foto'];
      $kat_id = $row['kat_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card' style='background-color:#e7bb8b;'>
      <img src='/admin/urun_foto/$urun_foto' class='card-img-top' alt='$urun_adi'>
      <div class='card-body'>
        <h5 class='card-title'>$urun_adi</h5>
        <p class='card-text'>$urun_aciklama</p>
        <p class='card-text'>Fiyat: $urun_fiyat</p>
        <a href='../sayfalar/anasayfa.php?add_to_cart=$urun_id' class='btn btn-warning active'>Sepete ekle</a>
          </div>
          </div>
          </div>";
     }
   }
}
function urunler (){
        if(!isset($_GET['kategoriler'])){
        global $con;
        $select_query = "SELECT * FROM urunler order by urun_adi";
        $result_query = mysqli_query($con,$select_query);
        while($row = mysqli_fetch_assoc($result_query)){
          $urun_id = $row['urun_id'];
          $urun_adi = $row['urun_adi'];
          $urun_aciklama = $row['urun_aciklama'];
          $urun_fiyat = $row['urun_fiyat'];
          $urun_foto = $row['urun_foto'];
          $kat_id = $row['kat_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card' style='background-color:#e7bb8b;'>
          <img src='/admin/urun_foto/$urun_foto' class='card-img-top' alt='$urun_adi'>
          <div class='card-body'>
            <h5 class='card-title'>$urun_adi</h5>
            <p class='card-text'>$urun_aciklama</p>
            <p class='card-text'>Fiyat: $urun_fiyat</p>
            <a href='anasayfa.php?add_to_cart=$urun_id' class='btn btn-warning active'>Sepete ekle</a>
            </div>
              </div>
              </div>";
         }
       }
    }
function tekurunal(){
    global $con;
    if(isset($_GET['kategoriler'])){
        $kategori_id = $_GET['kategoriler']; 
    $select_query = "SELECT * FROM urunler where kat_id=$kategori_id";
    $result_query = mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class= 'text-center text-dark'> Bu kategoride ürün bulunmamaktadır </h2>";
    }
    while($row = mysqli_fetch_assoc($result_query)){
      $urun_id = $row['urun_id'];
      $urun_adi = $row['urun_adi'];
      $urun_aciklama = $row['urun_aciklama'];
      $urun_fiyat = $row['urun_fiyat'];
      $urun_foto = $row['urun_foto'];
      $kat_id = $row['kat_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card' style='background-color:#e7bb8b;'>
      <img src='/admin/urun_foto/$urun_foto' class='card-img-top' alt='$urun_adi'>
      <div class='card-body'>
        <h5 class='card-title'>$urun_adi</h5>
        <p class='card-text'>$urun_aciklama</p>
        <p class='card-text'>Fiyat: $urun_fiyat</p>
        <a href='anasayfa.php?add_to_cart=$urun_id' class='btn btn-warning active'>Sepete ekle</a>
          </div>
          </div>
          </div>";
    }
}
}

function kategorial(){
    global $con;
    $select_kategori = "SELECT * FROM kategoriler";
    $result_kategori = mysqli_query($con, $select_kategori);
    while ($row_data = mysqli_fetch_assoc($result_kategori)){
    $kategori_adi = $row_data['kat_adi'];
    $kategori_id = $row_data['kat_id'];
    echo "<li class='nav-item'>
      <a href='anasayfa.php?kategoriler=$kategori_id' class='nav-link text-light'>$kategori_adi</a>
    </li>";
    }
}

function ara(){
        global $con;
        if(isset($_GET['search_data_product'])){
            $search_data_value = $_GET['search_data'];
        }
        $search_query = "SELECT * FROM urunler where urun_anahtar like '%$search_data_value%'";
        $result_query = mysqli_query($con,$search_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class= 'text-center text-dark'> Aradığınız ürün mevcut değil. </h2>";
        }
        while($row = mysqli_fetch_assoc($result_query)){
          $urun_id = $row['urun_id'];
          $urun_adi = $row['urun_adi'];
          $urun_aciklama = $row['urun_aciklama'];
          $urun_fiyat = $row['urun_fiyat'];
          $urun_foto = $row['urun_foto'];
          $kat_id = $row['kat_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card' style='background-color:#e7bb8b;'>
          <img src='/admin/urun_foto/$urun_foto' class='card-img-top' alt='$urun_adi'>
          <div class='card-body'>
            <h5 class='card-title'>$urun_adi</h5>
            <p class='card-text'>$urun_aciklama</p>
            <p class='card-text'>Fiyat: $urun_fiyat</p>
            <a href='anasayfa.php?add_to_cart=$urun_id' class='btn btn-warning active'>Sepete ekle</a>
            </div>
              </div>
              </div>";
         }
       }
       function getIPAddress() {  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    
        function sepet(){
            if(isset($_GET['add_to_cart'])){
                global $con;
                $userId = $_SESSION['user_id'];
                $get_ip_adres = getIPAddress();
                $get_urun_id=$_GET['add_to_cart'];
                $select_query = "SELECT * FROM kart_detayi where ip_adres='$get_ip_adres' and urun_id = $get_urun_id and user_id = $userId";
                $result_query = mysqli_query($con,$select_query);
                $num_of_rows=mysqli_num_rows($result_query);
                if($num_of_rows>0){
                    echo "<script>alert ('Bu ürün zaten sepette mevcut.') </script>";
                    echo "<script>window.open ('../sayfalar/anasayfa.php','_self') </script>";
                } else{
                    $insert_query = "INSERT INTO kart_detayi (urun_id,user_id,ip_adres,adet) values ('$get_urun_id','$userId','$get_ip_adres',1)";
                    $result_query = mysqli_query($con,$insert_query);
                    echo "<script>alert ('Ürün sepete eklendi.') </script>";
                    echo "<script>window.open ('../sayfalar/anasayfa.php','_self') </script>";

                }
            }
        }
        function sepet_item(){
            if(isset($_GET['add_to_cart'])){
                global $con;
                $get_ip_adres = getIPAddress();
                $select_query = "SELECT * FROM kart_detayi where ip_adres='$get_ip_adres'";
                $result_query = mysqli_query($con,$select_query);
                $sepet_item_say=mysqli_num_rows($result_query);
            }else{
                global $con;
                $get_ip_adres = getIPAddress();
                $select_query = "SELECT * FROM kart_detayi where ip_adres='$get_ip_adres'";
                $result_query = mysqli_query($con,$select_query);
                $sepet_item_say=mysqli_num_rows($result_query);
                }
                echo $sepet_item_say;
            }
        function sepet_toplami(){
                global $con;
                $userId = $_SESSION['user_id'];
                $get_ip_adres = getIPAddress();
                $toplam_fiyat = 0;
                $sepet_query = "SELECT * FROM kart_detayi where ip_adres='$get_ip_adres' and user_id = $userId";
                $result = mysqli_query($con,$sepet_query);
                while($row = mysqli_fetch_array($result)){
                    $urun_id = $row['urun_id'];
                    $urun_adet = $row['adet'];
                    $select_urun = "SELECT * FROM urunler where urun_id='$urun_id '";
                    $result_urun = mysqli_query($con,$select_urun);
                    while($row_urun_fiyat = mysqli_fetch_array($result_urun)){
                        $urun_fiyat= intval($row_urun_fiyat['urun_fiyat']);
                        $toplam_fiyat+=$urun_fiyat*$urun_adet; 

                    }
                }
                echo $toplam_fiyat;
        }
        function get_user_siparis_detayi(){
          global $con;
          $user_id = $_SESSION['email'];
          $get_details="SELECT * FROM user WHERE email='$user_id'";
          $result_query=mysqli_query($con,$get_details);
          while($row_query=mysqli_fetch_array($result_query)){
            $user_id = $row_query['user_id'];
            if(!isset($_GET['edit_profil'])){
              if(!isset($_GET['user_siparis'])){
                if(!isset($_GET['user_sikayet'])){
                  $get_orders = "SELECT * from siparis where user_id = '$user_id' and siparis_durum = 'bekliyor'";
                  $result_orders_query=mysqli_query($con,$get_orders);
                  $row_count=mysqli_num_rows($result_orders_query);
                  if($row_count>0){
                    echo "<h3 class='text-center text-dark mt-5 mb-2'> Bekleyen <span class='text-danger'>$row_count</span> siparişiniz var.</h3>
                    <p class = 'text-center'><a href='../user_hesap/profil.php?user_siparis' class='text-dark'>Siparis Detayi</a></p>";
                  }else{
                    echo "<h3 class='text-center text-dark mt-5 mb-2'> Bekleyen siparişiniz yok.</h3>
                    <p class = 'text-center'><a href='../sayfalar/anasayfa.php?siparislerim' class='text-dark'>Alışverişe devam et</a></p>";
                  }
                }
              }
            }
          }
        }
        function delete(){
          global $con;
            if(isset($_POST['sepet_kaldir'])){
              $urun_id =$_POST['urun_id'] ;
              $delete_query = "DELETE from kart_detayi where urun_id='$urun_id'";
              $run_delete = mysqli_query($con,$delete_query);
              if($run_delete){
                echo "<script>window.open('sepet.php','_self')</script>";
              }
            }
          }
        
?>