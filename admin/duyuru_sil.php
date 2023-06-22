<?php
if(isset($_GET['duyuru_sil'])){
   $id_sil = $_GET['duyuru_sil'];

   $duyuru_sil = "DELETE from duyurular WHERE duyuru_id = '$id_sil'";
   $result_duyuru = mysqli_query($con,$duyuru_sil);
   if($result_duyuru){
    echo "<script>alert('Duyuru başarıyla silindi.')</script>";
    echo "<script>window.open('adminpanel.php?duyurular','_self')</script>";
   }
}
?>