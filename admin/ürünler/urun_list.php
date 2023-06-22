<h2 class = "text-center text-dark">ÜRÜNLER</h2>
<table class="table table-bordered mt-5">
    <thead style="background-color:#943939;">
        <tr class="text-center">
            <th>Ürün ID</th>
            <th>Ürün Adı</th>
            <th>Ürün Fotoğrafı</th>
            <th>Ürün Fiyatı</th>
            <th>Toplam Satış</th>
            <th>Ürün Düzenle</th>
            <th>Ürün Sil</th>
        </tr>
    </thead>
    <tbody class= "bg-secondary text-light">
            <?php
            include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
            $get_urunler="SELECT * from urunler";
            $result=mysqli_query($con,$get_urunler);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $urun_id=$row['urun_id'];
                $urun_adi=$row['urun_adi'];
                $urun_foto=$row['urun_foto'];
                $urun_fiyat=$row['urun_fiyat'];
                $number++;
                ?>
                
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $urun_adi; ?></td>
                <td><img src='./urun_foto/<?php echo $urun_foto;?>' class='urunlist_foto' /></td>
                <td><?php echo $urun_fiyat; ?></td>
                <td><?php
                $get_count = "SELECT * from siparis where urun_id ='$urun_id'";
                $result_count=mysqli_query($con,$get_count);
                $row_count=mysqli_num_rows($result_count);
                echo $row_count;
                ?></td>
                <td><a href='adminpanel.php?urun_duzenle=<?php echo $urun_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='adminpanel.php?urun_sil=<?php echo $urun_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></td>
                </tr>
                <?php
            }
            ?>
       
       
    </tbody>
</table>