<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yedikçe</title>
</head>
<body>
    <?php
        $email = $_SESSION['email'];
        $get_user="SELECT * from user where email='$email'";
        $result=mysqli_query($con,$get_user);
        $row_fetch=mysqli_fetch_assoc($result);
        $user_id = $_SESSION['user_id'];
    ?>
<h3 class="text-dark text-center">Siparişlerim</h3>
<table class="table table-bordered mt-5">
    <thead style="background-color:#943939;">
    <tr>
        <th>Sipariş No</th>
        <th>Toplam Tutar</th>
        <th>Toplam Ürün</th>
        <th>Fatura No</th>
        <th>Tarih</th>
        <th>Teslim Edildi/Edilmedi</th>
    </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $get_siparis_detay="SELECT * from siparis where user_id = '$user_id'";
        
        $result_siparis =mysqli_query($con,$get_siparis_detay);
        $number=1;
        while($row_siparis=mysqli_fetch_assoc($result_siparis)){
            $siparis_id = $row_siparis['siparis_id'];
            $aratoplam = $row_siparis['aratoplam'];
            $aratoplam = $row_siparis['aratoplam'];
            $toplamurun = $row_siparis['toplam_urun'];
            $faturano = $row_siparis['fatura_no'];
            $siparisdurum = $row_siparis['siparis_durum'];
            if($siparisdurum=='bekleyen'){
                $siparisdurum ='Teslim Edilmedi';
            }else{
                $siparisdurum = 'Teslim Edildi';
            }
            $siparistarihi = $row_siparis['siparis_tarihi'];
            echo "<tr>
            <td class= 'text-center'>$number</td>
            <td>$aratoplam TL</td>
            <td>$toplamurun adet</td>
            <td>$faturano</td>
            <td>$siparistarihi</td>
            <td>$siparisdurum</td>
        </tr>";
        $number++;
        }
            /* <td><a   href='confirm_payment.php' class='text-light'>Onayla </a></td> */


        ?>
    </tbody>
</table>
</body>
</html>