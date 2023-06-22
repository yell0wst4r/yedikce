<?php
if(isset($_GET['urun_sil'])){
   $id_sil = $_GET['urun_sil'];

   $urun_sil = "DELETE from urunler WHERE urun_id = '$id_sil'";
   $result_urun = mysqli_query($con,$urun_sil);
   if($result_urun){
    echo "<script>alert('Ürün başarıyla silindi.')</script>";
    echo "<script>window.open('adminpanel.php?urun_list','_self')</script>";
   }
}
?>