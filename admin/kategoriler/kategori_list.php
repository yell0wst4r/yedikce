<h2 class = "text-center text-dark">KATEGORİLER</h2>
<table class="table table-bordered mt-5">
    <thead style="background-color:#943939;">
        <tr class="text-center">
            <th>Kategori ID</th>
            <th>Kategori Adı</th>
            <th>Kategori Düzenle</th>
            <th>Kategori Sil</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_kat = "SELECT * from kategoriler";
        $result = mysqli_query($con,$select_kat);
        $number=0;
        while ($row=mysqli_fetch_assoc($result)){
            $kat_id = $row ['kat_id'];
            $kat_adi = $row ['kat_adi'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number ?></td>
            <td><?php echo $kat_adi ?></td>
            <td><a href='adminpanel.php?kat_duzenle=<?php echo $kat_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='adminpanel.php?kat_sil=<?php echo $kat_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>