<?php
include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
if(isset($_POST['duyurular'])){
    $duyuru_baslik = $_POST['duyuru_baslik'];
    $duyuru_icerik = $_POST['duyuru_icerik'];
   

    $duyuru_foto = $_FILES['duyuru_fotograf']['name'];
    $temp_foto = $_FILES['duyuru_fotograf']['tmp_name'];

    if($duyuru_baslik=='' or $duyuru_icerik=='' or $duyuru_foto==''){
        echo "<script>alert('Lütfen bütün satırları doldurun.')</script>";
        exit();
    }
    else{
        move_uploaded_file($temp_foto,"duyuru_foto/$duyuru_foto");
        $insert_duyuru = "INSERT INTO duyurular SET duyuru_baslik='$duyuru_baslik', duyuru_icerik='$duyuru_icerik', duyuru_fotograf='$duyuru_foto'";
        $result_query = mysqli_query($con,$insert_duyuru);
        if($result_query){
            echo "<script>alert('Duyuru başarıyla eklendi.')</script>";

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
    <title>Duyuru Ekle</title>
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
<h2 class = "text-center text-dark">DUYURU PAYLAŞ</h2>
    <div class="container mt-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="duyuru_baslik" class="form-label" style ="color: #943939"> Başlık</label>
                <input type="text" name="duyuru_baslik" id="duyuru_baslik" class="form-control" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="duyuru_fotograf" class="form-label" style ="color: #943939"> Fotoğraf</label>
                <input type="file" name="duyuru_fotograf" id="duyuru_fotograf" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="duyuru_icerik" class="form-label" style ="color: #943939"> İçerik</label>
                <textarea type="text" id="duyuru_icerik" name="duyuru_icerik" class="form-control" rows="5" autocomplete="off" required="required"></textarea>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="duyurular" class="btn btn-warning active mb-3 px-3" value="Paylaş">
                <a class="btn btn-secondary mb-3 px-3" href=" adminpanel.php">İptal</a>
            </div>
        </form>
    </div>
</body>
</html>