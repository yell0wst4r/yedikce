<h2 class = "text-center text-dark">DUYURULAR</h2>
<table class="table table-bordered mt-5">
    <thead style="background-color:#943939;">
        <tr class="text-center">
            <th>Duyuru ID</th>
            <th>Duyuru Başlık</th>
            <th>Duyuru Fotoğrafı</th>
            <th>Duyuru İçerik</th>
            <th>Duyuru Düzenle</th>
            <th>Duyuru Sil</th>
        </tr>
    </thead>
    <tbody class= "bg-secondary text-light">
            <?php
            include('C:\Users\Tarık Sarıyıldız\Desktop\yedikce\connect.php');
            $get_duyurular="SELECT * from duyurular";
            $result=mysqli_query($con,$get_duyurular);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $duyuru_id=$row['duyuru_id'];
                $duyuru_baslik=$row['duyuru_baslik'];
                $duyuru_fotograf=$row['duyuru_fotograf'];
                $duyuru_icerik=$row['duyuru_icerik'];
                $number++;
                ?>
                
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $duyuru_baslik; ?></td>
                <td><img src='./duyuru_foto/<?php echo $duyuru_fotograf;?>' class='urunlist_foto' /></td>
                <td><?php echo $duyuru_icerik; ?></td>
                <td><a href='adminpanel.php?duyuru_duzenle=<?php echo $duyuru_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='adminpanel.php?duyuru_sil=<?php echo $duyuru_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></td>
                </tr>
                <?php
            }
            ?>
       
       
    </tbody>
</table>