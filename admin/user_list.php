<h2 class="text-center text-dark">ÜYELER</h2>
<table class="table table-bordered mt-5">
    <thead style="background-color:#943939;">

    <?php
    $get_user = "SELECT * from user";
    $result = mysqli_query($con,$get_user);
    $row_count=mysqli_num_rows($result);


    if($row_count==0){
        echo "<h2 class='text-danger text-center mt-5'>Henüz kullanıcı yok </h2>";
    }else{
        echo "<tr>
        <th>Üye ID</th>
        <th>Üye Adı</th>
        <th>Üye Soyadı</th>
        <th>Üye Email</th>
        <th>Üye Adresi</th>
        <th>Üye Telefonu</th>
        <th>Sil</th>
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
    
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id = $row_data['user_id'];
        $user_ad = $row_data['ad'];
        $user_soyad = $row_data['soyad'];
        $user_email = $row_data['email'];
        $user_adres = $row_data['adres'];
        $user_telefon = $row_data['telefon_no'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$user_ad</td>
        <td>$user_soyad</td>
        <td>$user_email</td>
        <td>$user_adres </td>
        <td>$user_telefon</td>
        <td><a href='adminpanel.php?user_sil=$user_id' class='text-light'><i class='fa-solid fa-trash'></i></td>
    </tr>";
        }
    }
     ?>
     </tbody>
</table>
