<?php
if(isset($_POST['sikayet_et'])){
    $ad_soyad = $_POST['ad_soyad'];
    $user_email = $_POST['user_email'];
    $konu = $_POST['konu'];
    $sikayet = $_POST['sikayet'];
 
    if($ad_soyad=='' or $user_email=='' or $konu=='' or $sikayet==''){
        echo "<script>alert('Lütfen bütün satırları doldurun.')</script>";
        exit();
    }
    else{
        $insert_sikayet = "INSERT INTO sikayet SET ad_soyad='$ad_soyad', user_email='$user_email', konu='$konu',sikayet_tarihi=NOW(), sikayet='$sikayet'";
        $result_query = mysqli_query($con,$insert_sikayet);
        if($result_query){
            echo "<script>alert('Talebiniz başarıyla iletildi.')</script>";

        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikayet Et</title>

</head>
<body >
<h2 class = "text-center text-dark">Bize Bildirin</h2>
           <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="ad" class="form-label" style ="color: #943939"> Ad & Soyad</label>
                <input type="text" name="ad_soyad" id="ad_soyad" class="form-control" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="user_email" class="form-label" style="color: #943939"> Email Adresiniz </label>
                <input type="email" name="user_email" id="user_email" class="form-control" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="konu" class="form-label" style="color: #943939"> Konu </label>
                <input type="text" name="konu" id="konu" class="form-control" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="urun_aciklama" class="form-label" style="color: #943939"> Şikayetiniz </label>
                <textarea type="text" id="sikayet" name="sikayet" class="form-control" rows="5" autocomplete="off" required="required"></textarea>
            </div>
            <div class="form-outline text-center">
                <input type="submit" name="sikayet_et" class="btn btn-warning active mb-3 px-3" value="Gönder">
            </div>   
        </form>
</body>
</html>