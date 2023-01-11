 <?php
    session_start();


    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    // pagination
    // konfigurasi
    $jumlahDataPerHalaman = 2;
    $jumlahData = count(query("SELECT * FROM siswa"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


    $siswa = query("SELECT * FROM siswa LIMIT $awalData, $jumlahDataPerHalaman");

    // tombol cari ditekan
    if (isset($_POST["cari"])) {
        $siswa = cari($_POST["keyword"]);
    }


    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Halaman Admin</title>
 </head>

 <body>

     <a href="logout.php">Keluar</a>

     <h1>Daftar Siswa</h1>

     <a href="tambah.php">Tambah Data Siswa</a>
     <br><br>

     <form action="" method="post">
         <input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
         <button type="submit" name="cari" id="tombol-cari">Cari!</button>
     </form>
     <br><br>

     <!-- navigasi -->

     <?php if ($halamanAktif > 1) : ?>
         <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
     <?php endif; ?>

     <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
         <?php if ($i == $halamanAktif) : ?>
             <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
         <?php else : ?>
             <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
         <?php endif; ?>
     <?php endfor; ?>

     <?php if ($halamanAktif < $jumlahHalaman) : ?>
         <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
     <?php endif; ?>

     <br><br>
     <div id="container">
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
     </div>
     <script src="js/script.js"></script>

 </body>

 </html>