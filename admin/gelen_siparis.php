<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yedikçe</title>
    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        .sikayet-column {
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <h2 class="text-dark text-center">SİPARİŞLER</h2>
    <div class="table-container">
        <table class="table table-bordered mt-5">
            <thead style="background-color:#943939;">
                <tr>
                    <th>Sipariş ID</th>
                    <th>Fatura No</th>
                    <th>Müşteri</th>
                    <th>Adres</th>
                    <th>Telefon</th>
                    <th>Toplam Ürün</th>
                    <th>Sipariş Tarihi</th>
                    <th>Sipariş Durumu</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                $get_siparis = "SELECT * FROM siparis ORDER BY siparis_tarihi DESC";
                $result_siparis = mysqli_query($con,$get_siparis);

                $number = 1;
                while($row_siparis = mysqli_fetch_assoc($result_siparis)){
                    $siparis_id = $row_siparis['siparis_id'];
                    $user_id = $row_siparis['user_id'];
                    $aratoplam = $row_siparis['aratoplam'];
                    $fatura_no = $row_siparis['fatura_no'];
                    $toplam_urun = $row_siparis['toplam_urun'];
                    $siparis_tarihi = $row_siparis['siparis_tarihi'];
                    $siparis_durum = $row_siparis['siparis_durum'];

                    $get_user = "SELECT * FROM user WHERE user_id = '$user_id'";
                    $result_user = mysqli_query($con,$get_user);
                    if ($result_user && mysqli_num_rows($result_user) > 0) {
                        while($row_user = mysqli_fetch_assoc($result_user)){
                            $user_name = $row_user['ad'];
                            $user_surname = $row_user['soyad'];
                            $user_fullname = "$user_name $user_surname";
                            $user_adres = $row_user['adres'];
                            $user_telefon = $row_user['telefon_no'];

                        }
                    } else {
                        $user_fullname = "";
                        $user_adres = "";
                    }
                    echo "<tr>
                        <td>$number</td>
                        <td>$fatura_no</td>
                        <td>$user_fullname</td>
                        <td>$user_adres</td>
                        <td>$user_telefon</td>
                        <td>$toplam_urun</td>
                        <td>$siparis_tarihi</td>
                        <td>";

                    if ($siparis_durum == 'bekliyor') {
                        echo "
                            <form method='POST'>
                                <input type='hidden' name='siparis_id' value='$siparis_id'>
                                <select name='siparis_durum'>
                                    <option value='bekliyor'>bekliyor</option>
                                    <option value='Teslim Edildi'>Teslim Edildi</option>
                                </select>
                                <button type='submit' name='submit'>Güncelle</button>
                            </form>
                        ";
                    } else {
                        echo $siparis_durum;
                    }

                    echo "</td></tr>";
                    $number++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_POST['siparis_id']) && isset($_POST['siparis_durum'])) {
    $siparis_id = $_POST['siparis_id'];
    $siparis_durum = $_POST['siparis_durum'];

    $update_query = "UPDATE siparis SET siparis_durum = '$siparis_durum' WHERE siparis_id = '$siparis_id'";

    $result_update = mysqli_query($con, $update_query);
    if ($result_update) {
        echo "<script>alert ('Güncelleme işlemi başarıyla gerçekleşti.') </script>";
        echo "<script>window.open ('adminpanel.php?gelen_siparis','_self') </script>";

    } else {
        echo "Güncelleme işlemi sırasında bir hata oluştu: " . mysqli_error($con);
    }
}
?>
