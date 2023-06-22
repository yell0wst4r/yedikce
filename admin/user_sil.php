<?php
if(isset($_GET['user_sil'])){
   $id_sil = $_GET['user_sil'];

   $user_sil = "DELETE from user WHERE user_id = '$id_sil'";
   $result_user = mysqli_query($con,$user_sil);
   if($result_user){
    echo "<script>alert('Kullanıcı başarıyla silindi.')</script>";
    echo "<script>window.open('adminpanel.php?user_list','_self')</script>";
   }
}
?>