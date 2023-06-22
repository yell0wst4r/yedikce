<?php
session_start();
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\function.php');
if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
}
$userId = $_SESSION['user_id'];
$get_ip_adres =getIPAddress();
$toplam_fiyat=0;
$sepet_toplam_fiyat= "SELECT * from kart_detayi where ip_adres='$get_ip_adres' and user_id = '$userId'";
$result_sepet_fiyat=mysqli_query($con,$sepet_toplam_fiyat);
$invoice_number=mt_rand();
$durum = 'bekliyor';
$urun_topla=mysqli_num_rows($result_sepet_fiyat);
while($row_urun_fiyat=mysqli_fetch_array($result_sepet_fiyat)){
     $urun_id = $row_urun_fiyat['urun_id'];
     $select_urun= "SELECT * from urunler where urun_id='$urun_id'";
     $run_fiyat=mysqli_query($con,$select_urun);
     while($row_urun_fiyat=mysqli_fetch_array($run_fiyat)){
        $urun_fiyat=array($row_urun_fiyat['urun_fiyat']);
        $urun_adet=array_sum($urun_fiyat);   
        $toplam_fiyat+=$urun_adet;
     }
}
$get_sepet="SELECT * from kart_detayi";
$run_sepet = mysqli_query($con,$get_sepet);
$get_urun_adet =mysqli_fetch_array($run_sepet);
$adet = intval($get_urun_adet['adet']);
if($adet==0){
    $adet=1;
    $aratoplam=$toplam_fiyat;
}else{
    $aratoplam=$toplam_fiyat*$adet;
}
 $insert_siparis = "INSERT into siparis (user_id,urun_id,aratoplam,fatura_no,toplam_urun,siparis_tarihi,siparis_durum) values('$userId','$urun_id','$aratoplam','$invoice_number','$urun_topla',NOW(),'$durum')";
 $result_query =mysqli_query($con,$insert_siparis);
 if($result_query){
    echo "<script>alert('Sipariş başarıyla verildi.')</script>";
   
    $empty_sepet = "DELETE FROM kart_detayi where ip_adres='$get_ip_adres' and user_id = '$userId' ";
    $result_delete =mysqli_query($con,$empty_sepet );
    echo "<script>window.open('profil.php','_self')</script>";
 }

?>