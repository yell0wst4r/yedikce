<?php 
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');

if(isset($_POST['kat_ekle'])){
    $kat_adi=$_POST['kat_adi'];
    $select_query="SELECT * FROM kategoriler WHERE kat_adi = '$kat_adi' ";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('Böyle bir kategoriye zaten sahipsiniz.')</script>";
    }else{

    $insert_query="INSERT INTO kategoriler(kat_adi) values ('$kat_adi')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Kategori başarıyla eklendi.')</script>";
    }
}}

?>
<h2 class="text-center text-dark">KATEGORİ EKLE</h2>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4 w-50 m-auto">
         <label for="kat_adi" class="form-label" style ="color: #943939">Kategori Adı</label>
         <input type="text" name="kat_adi" id="kat_adi" class="form-control" placeholder="Kategori adını giriniz." autocomplete="off" required="required">
    </div>
     <div class="form-outline mb-4 w-50 m-auto">
         <input type="submit" class="btn btn-warning active mb-3 px-3" name="kat_ekle" value="Kategori Ekle"> 
    </div>
</form>