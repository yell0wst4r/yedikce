<?php
if(isset($_GET['edit_profil'])){
    $user_session_name = $_SESSION['email'];
    $select_query = "SELECT * from user WHERE email='$user_session_name'";
    $result_query =mysqli_query($con,$select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id= $row_fetch['user_id'];
    $user_ad= $row_fetch['ad']; 
    $user_soyad= $row_fetch['soyad']; 
    $user_email= $row_fetch['email']; 
    $user_adres= $row_fetch['adres'];
    $user_telno= $row_fetch['telefon_no'];
}

    if(isset($_POST['user_update'])){
        $update_id=$user_id;
        $user_ad= $_POST['ad']; 
        $user_soyad= $_POST['soyad']; 
        $user_email= $_POST['email']; 
        $user_adres= $_POST['adres'];
        $user_telno= $_POST['telefon_no']; 

        $update_data ="UPDATE user  set ad='$user_ad', soyad='$user_soyad', email='$user_email',
         adres='$user_adres', telefon_no='$user_telno' where user_id ='$update_id'";
             $result_query_update =mysqli_query($con,$update_data);
             if($result_query_update){
                echo "<script>alert('Bilgiler başarıyla değiştirildi.')</script>";
                echo "<script>window.open('usergiris.php','_self')</script>";
             }
    }

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Düzenle</title>
</head>
<body>
    <h3 class="text-dark mb-4 text-center"> Bilgileri Düzenle</h3>
    <form action="" method="post" enctype="multipart/form-data" >
        <div class="form-outline mb-4 w-50 m-auto ">
            <label for="urun_aciklama" class="form-label " style="color: #943939"> Ad </label>
            <input type="text" class="form-control" autocomplete="off" value="<?php echo $user_ad?>" name="ad">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="urun_aciklama" class="form-label " style="color: #943939"> Soyad </label>
            <input type="text" class="form-control" autocomplete="off" value="<?php echo $user_soyad?>" name="soyad">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="urun_aciklama" class="form-label " style="color: #943939"> Email </label>
            <input type="email" class="form-control" autocomplete="off" value="<?php echo $user_email?>" name="email">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="urun_aciklama" class="form-label " style="color: #943939"> Adres </label>
            <input type="text" class="form-control" autocomplete="off" value="<?php echo $user_adres?>" name="adres">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="urun_aciklama" class="form-label " style="color: #943939"> Telefon Numarası </label>
            <input type="number" class="form-control" autocomplete="off" value="<?php echo $user_telno?>" name="telefon_no">
        </div>
        <div class="form-outline text-center">
            <input type="submit" value="Güncelle" class="btn btn-warning active py-2 px-3 border-0" name="user_update">
        </div>
    </form>
</body>
</html>
