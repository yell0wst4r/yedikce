<?php
if(isset($_GET['kat_sil'])){
   $kat_sil = $_GET['kat_sil'];

   $kat_query = "DELETE from kategoriler WHERE kat_id = '$kat_sil'";
   $result_kat = mysqli_query($con,$kat_query);
   if($result_kat){
    echo "<script>alert('Kategori başarıyla silindi.')</script>";
    echo "<script>window.open('adminpanel.php?kat_list','_self')</script>";
   }
}
?>