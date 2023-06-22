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
    <h2 class="text-dark text-center">ŞİKAYETLER</h2>
    <div class="table-container">
        <table class="table table-bordered mt-5">
            <thead style="background-color:#943939;">
                <tr>
                    <th>Şikayet ID</th>
                    <th>Ad & Soyad</th>
                    <th>Email</th>
                    <th>Konu</th>
                    <th>Tarih</th>
                    <th>Şikayet</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                $get_sikayet_detay = "SELECT * FROM sikayet ORDER BY sikayet_tarihi DESC";
                $result_sikayet = mysqli_query($con,$get_sikayet_detay);
                $number = 1;
                while($row_sikayet = mysqli_fetch_assoc($result_sikayet)){
                    $sikayet_id = $row_sikayet['sikayet_id'];
                    $ad_soyad = $row_sikayet['ad_soyad'];
                    $user_email = $row_sikayet['user_email'];
                    $konu = $row_sikayet['konu'];
                    $sikayet_tarihi = $row_sikayet['sikayet_tarihi'];
                    $sikayet = $row_sikayet['sikayet'];

                    echo "<tr>
                        <td>$number</td>
                        <td>$ad_soyad</td>
                        <td>$user_email</td>
                        <td>$konu</td>
                        <td>$sikayet_tarihi</td>
                        <td class='sikayet-column'>$sikayet</td>
                    </tr>";
                    $number++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
