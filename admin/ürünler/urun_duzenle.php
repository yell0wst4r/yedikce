<?php
if(isset($_GET['urun_duzenle'])){
    $edit_id = $_GET['urun_duzenle'];
    $get_data = "SELECT * from urunler where urun_id = '$edit_id'";
    $result=mysqli_query($con,$get_data);
    $row = mysqli_fetch_assoc($result);
    $urun_adi = $row['urun_adi'];
    $urun_aciklama = $row['urun_aciklama'];
    $urun_anahtar = $row['urun_anahtar'];
    $kat_id = $row['kat_id'];
    $urun_foto = $row['urun_foto'];
    $urun_fiyat = $row['urun_fiyat'];

    $select_kategori = "SELECT * from kategoriler where kat_id = '$kat_id'";
    $result_kategori=mysqli_query($con,$select_kategori);
    $row_kategori = mysqli_fetch_assoc($result_kategori);
    $kategori_adi = $row_kategori['kat_adi'];
}

?>
<div class="container ">
    <h2 class="text-center">ÜRÜN DÜZENLE</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-3">
            <label for="urun_adi" class="form-label"style ="color: #943939">Ürün Adı</label>
            <input type="text" id="urun_adi" value = "<?php echo $urun_adi ?>" name="urun_adi" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-3">
            <label for="urun_aciklama" class="form-label" style ="color: #943939">Ürün Açıklama</label>
            <input type="text" id="urun_aciklama" value = "<?php echo $urun_aciklama ?>" name="urun_aciklama" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-3">
            <label for="urun_anahtar" class="form-label" style ="color: #943939">Ürün Anahtarı</label>
            <input type="text" id="urun_anahtar" value = "<?php echo $urun_anahtar ?>" name="urun_anahtar" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-3">
        <label for="urun_kategori" class="form-label" style ="color: #943939">Ürün Kategorisi</label>
            <select name="urun_kategori" class="form-select">
                <option value = "<?php echo $kategori_adi ?>"><?php echo $kategori_adi ?></option>
                <?php 
                    $select_kategori_all = "SELECT * from kategoriler";
                    $result_kategori_all=mysqli_query($con,$select_kategori_all);
                    while($row_kategori_all = mysqli_fetch_assoc($result_kategori_all)){
                        $kategori_adi = $row_kategori_all['kat_adi'];
                        $kategori_id = $row_kategori_all['kat_id'];
                        echo "<option value='$kategori_id'>$kategori_adi</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-3">
            <label for="urun_foto" class="form-label" style ="color: #943939">Ürün Fotoğrafı</label>
            <div class="d-flex">
            <input type="file" id="urun_foto" name="urun_foto" class="form-control w-90 m-auto" required="required">
            <img src="./urun_foto/<?php echo $urun_foto?>" alt="" class="urunlist_foto">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-3">
            <label for="urun_fiyat" class="form-label" style ="color: #943939">Ürün Fiyatı</label>
            <input type="text" id="urun_fiyat" value = "<?php echo $urun_fiyat ?>" name="urun_fiyat" class="form-control" required="required">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" name="urun_degis" value="Düzenle" class="btn btn-warning active mb-3 px-3">
            <a class="btn btn-secondary mb-3 px-3" href="adminpanel.php?urun_list">İptal</a>
        </div>
    </form>
</div>

<?php 
if(isset($_POST['urun_degis'])){
    $urun_adi = $_POST['urun_adi'];
    $urun_aciklama = $_POST['urun_aciklama'];
    $urun_anahtar = $_POST['urun_anahtar'];
    $urun_kategori = $_POST['urun_kategori'];
    $urun_fiyat = $_POST['urun_fiyat'];

    $urun_foto = $_FILES['urun_foto']['name'];
    $temp_foto = $_FILES['urun_foto']['tmp_name'];
    
    if( $urun_adi=='' or $urun_aciklama=='' or $urun_anahtar=='' or $urun_kategori=='' or $urun_fiyat=='' or $urun_foto==''){
        echo "<script>alert('Lütfen bütün kutuları doldurunuz')</script>";
    }else{
        move_uploaded_file($temp_foto,"./urun_foto/$urun_foto");

        $urun_duzenle = "UPDATE urunler set urun_adi='$urun_adi', urun_aciklama='$urun_aciklama', urun_anahtar='$urun_anahtar', kat_id='$urun_kategori', urun_foto='$urun_foto', urun_fiyat='$urun_fiyat', tarih=NOW() WHERE urun_id = $edit_id";
        $result_duzenle = mysqli_query($con,$urun_duzenle);
        if($result_duzenle){
           echo "<script>alert('Ürün bilgileri başarıyla değiştirildi.')</script>";
           echo "<script>window.open('adminpanel.php?urun_list','_self')</script>";
         }
    }
}
?>