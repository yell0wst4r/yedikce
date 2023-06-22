<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
if(isset($_POST['urun_ekle'])){
    $urun_adi = $_POST['urun_adi'];
    $urun_aciklama = $_POST['urun_aciklama'];
    $urun_anahtar = $_POST['urun_anahtar'];
    $urun_kategori = $_POST['urun_kategori'];
    $urun_fiyat = $_POST['urun_fiyat'];
    $urun_durum = 'aktif';

    $urun_foto = $_FILES['urun_foto']['name'];
    $temp_foto = $_FILES['urun_foto']['tmp_name'];

    if($urun_adi=='' or $urun_aciklama=='' or $urun_anahtar=='' or $urun_kategori=='' or $urun_fiyat=='' or $urun_foto==''){
        echo "<script>alert('Lütfen bütün satırları doldurun.')</script>";
        exit();
    }
    else{
        move_uploaded_file($temp_foto,"./urun_foto/$urun_foto");
        $insert_urun = "INSERT INTO urunler SET urun_adi='$urun_adi', urun_aciklama='$urun_aciklama', urun_anahtar='$urun_anahtar', urun_fiyat='$urun_fiyat', urun_foto='$urun_foto', kat_id='$urun_kategori', tarih=NOW(), durum='$urun_durum'";
        $result_query = mysqli_query($con,$insert_urun);
        if($result_query){
            echo "<script>alert('Ürün başarıyla eklendi.')</script>";

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
    <title>Ürün Ekle - YÖNETİM PANELİ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../style.css">
</head>
<body >
<h2 class = "text-center text-dark">ÜRÜN EKLE</h2>
    <div class="container mt-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="urun_adi" class="form-label" style ="color: #943939"> Ürün Adı</label>
                <input type="text" name="urun_adi" id="urun_adi" class="form-control" 
                placeholder="Ürün adını giriniz." autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="urun_aciklama" class="form-label" style="color: #943939"> Ürün Açıklaması</label>
                <input type="text" name="urun_aciklama" id="urun_aciklama" class="form-control" 
                placeholder="Ürün açıklamasını giriniz." autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="urun_anahtar" class="form-label" style ="color: #943939"> Ürün Anahtarı</label>
                <input type="text" name="urun_anahtar" id="urun_anahtar" class="form-control" 
                placeholder="Ürün anahtarını giriniz." autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="urun_aciklama" class="form-label" style="color: #943939"> Ürün Kategorisi </label>
               <select name="urun_kategori" id="" class="form-select">
                <option value="">Kategori Seçin</option>
                <?php
                $select_query = "SELECT * FROM kategoriler";
                $result_query = mysqli_query($con,$select_query);
                while($row = mysqli_fetch_assoc($result_query)){
                    $kategori_adi = $row['kat_adi'];
                    $kategori_id = $row['kat_id'];
                    echo "<option value='$kategori_id'>$kategori_adi</option>";
                }
                ?>    
               </select>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="urun_foto" class="form-label" style ="color: #943939"> Ürün Fotoğrafı</label>
                <input type="file" name="urun_foto" id="urun_foto" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="urun_fiyat" class="form-label" style ="color: #943939"> Ürün Fiyatı</label>
                <input type="text" name="urun_fiyat" id="urun_fiyat" class="form-control" 
                placeholder="Ürün fiyatını giriniz." autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="urun_ekle" class="btn btn-warning active mb-3 px-3" value="Ürün Ekle">
                <a class="btn btn-secondary mb-3 px-3" href=" adminpanel.php">İptal</a>
            </div>
            
        </form>
    </div>

    
</body>
</html>