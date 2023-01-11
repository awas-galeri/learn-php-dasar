<?php
sleep(1);
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM siswa
            WHERE
            nama LIKE '%$keyword%' OR
            nip LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
         ";

$siswa = query($query);


?>

<table border="1" cellspacing="0" cellpadding="10">
             <tr>
                 <th>No.</th>
                 <th>Aksi</th>
                 <th>Foto</th>
                 <th>NIP</th>
                 <th>Nama</th>
                 <th>Email</th>
                 <th>Jurusan</th>
             </tr>
             <?php $i = 1; ?>
             <?php foreach ($siswa as $row) : ?>
                 <tr>
                     <td><?= $i; ?></td>
                     <td>
                         <a href="ubah.php?id=<?= $row["id"] ?>">ubah</a> |
                         <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">hapus</a>
                     </td>
                     <td><img src="img/<?= $row["gambar"]; ?>" alt="" width="75"></td>
                     <td><?= $row["nip"] ?></td>
                     <td><?= $row["nama"] ?></td>
                     <td><?= $row["email"] ?></td>
                     <td><?= $row["jurusan"] ?></td>
                 </tr>
                 <?php $i++ ?>
             <?php endforeach; ?>
         </table>