<?php
if(isset($_GET['duyuru_duzenle'])){
    $edit_id = $_GET['duyuru_duzenle'];
    $get_data = "SELECT * from duyurular where duyuru_id = '$edit_id'";
    $result=mysqli_query($con,$get_data);
    $row = mysqli_fetch_assoc($result);
    $duyuru_baslik = $row['duyuru_baslik'];
    $duyuru_icerik = $row['duyuru_icerik'];
    $duyuru_fotograf = $row['duyuru_fotograf'];
    
}
?>

<div class="container ">
    <h2 class="text-center">DUYURU DÜZENLE</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-3">
            <label for="duyuru_baslik" class="form-label"style ="color: #943939">Duyuru Başlık</label>
            <input type="text" id="duyuru_baslik" value = "<?php echo $duyuru_baslik ?>" name="duyuru_baslik" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-3">
            <label for="duyuru_fotograf" class="form-label" style ="color: #943939">Duyuru Fotoğrafı</label>
            <div class="d-flex">
            <input type="file" id="duyuru_fotograf" name="duyuru_fotograf" class="form-control w-90 m-auto" required="required">
            <img src="./duyuru_foto/<?php echo $duyuru_fotograf?>" alt="" class="urunlist_foto">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-3">
            <label for="duyuru_icerik" class="form-label" style ="color: #943939">Duyuru İçerik</label>
            <textarea type="text" id="duyuru_icerik" name="duyuru_icerik" class="form-control" rows="5" autocomplete="off" required="required"><?php echo $duyuru_icerik ?></textarea>
        </div>
        <div class="w-50 m-auto">
            <input type="submit" name="duyuru_degis" value="Düzenle" class="btn btn-warning active mb-3 px-3">
            <a class="btn btn-secondary mb-3 px-3" href="adminpanel.php?duyurular">İptal</a>
        </div>
    </form>
</div>

<?php 
if(isset($_POST['duyuru_degis'])){
    $duyuru_baslik = $_POST['duyuru_baslik'];
    $duyuru_icerik = $_POST['duyuru_icerik'];

    $duyuru_fotograf = $_FILES['duyuru_fotograf']['name'];
    $temp_foto = $_FILES['duyuru_fotograf']['tmp_name'];
    
    if( $duyuru_baslik=='' or $duyuru_icerik=='' or $duyuru_fotograf==''){
        echo "<script>alert('Lütfen bütün kutuları doldurunuz.')</script>";
    }else{
        move_uploaded_file($temp_foto,"./duyuru_foto/$duyuru_fotograf");

        $duyuru_duzenle = "UPDATE duyurular set duyuru_baslik='$duyuru_baslik', duyuru_icerik='$duyuru_icerik', duyuru_fotograf='$duyuru_fotograf' WHERE duyuru_id = $edit_id";
        $result_duzenle = mysqli_query($con,$duyuru_duzenle);
        if($result_duzenle){
           echo "<script>alert('Duyuru bilgileri başarıyla değiştirildi.')</script>";
           echo "<script>window.open('adminpanel.php?duyurular','_self')</script>";
         }
    }
}
?>