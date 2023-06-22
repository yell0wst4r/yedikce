<?php
if(isset($_GET['kat_duzenle'])){
    $kat_duzenle = $_GET['kat_duzenle'];
    $get_kategori = "SELECT * from kategoriler WHERE kat_id = '$kat_duzenle'";
    $result =mysqli_query($con,$get_kategori);
    $row = mysqli_fetch_assoc($result);
    $kat_adi = $row['kat_adi'];
}
if(isset($_POST['edit_kat'])){
    $kategori_adi = $_POST['kat_adi'];
    $update_query = "UPDATE kategoriler set kat_adi='$kategori_adi' WHERE kat_id = '$kat_duzenle'";
    $result_kat = mysqli_query($con,$update_query);
    if($result_kat){
        echo "<script>alert('Kategori adı başarıyla değiştirildi.')</script>";
        echo "<script>window.open('./adminpanel.php?kat_list','_self')</script>";
    }
}
?>
    <h2 class="text-center text-dark">KATEGORİ DÜZENLE</h2>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="kat_adi" class="form-label" style ="color: #943939">Kategori Adı</label>
            <input type="text" name="kat_adi" id="kat_adi" class="form-control" required="required" value='<?php echo $kat_adi ?>'>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" value="Güncelle" class="px-3 mb-3 btn btn-warning" name="edit_kat">
        </div>
    </form>
