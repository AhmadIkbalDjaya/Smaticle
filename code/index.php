<?php
require 'functions.php';
session_start();
// vvariabel $_SESSION["admin"] digunkan untuk mengecek apakah user berhasil login atau tidak (apakah di admin atau tidak)

// cek apakah tombol kirim di tekan
if (isset($_POST['posting'])) {
    // cek apakah fungsi uploadContent mengembalikan nilai yg lebih besar dari nol
    // jika iy maka akan menampilkan notifikasi berhasil dan kembali ke halaman index
    // jika gagal juga akan menampilkan notifikasi
    if (uploadContent($_POST) > 0) {
        echo "<script>
            alert ('Data berhasil ditambahkan');
            document.location.href='index.php';
            </script>";
    } else {
        echo "<script>
                alert ('Data gagal ditambahkan');
            </script>";
    }
}

$content = query("SELECT * FROM `content`");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smaticle</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
</head>

<body>
    <header>
        <!-- header utama - Laptop -->
        <div class="left main-header">
            <a href="index.php">
                <h1>S</h1>
            </a>
            <form action="" class="input-search">
                <label for="cari"><i class="fas fa-search"></i></label>
                <input type="text" name="cari" id="cari" placeholder="Cari">
            </form>
        </div>
        <div class="right main-header">
            <a href="index.php" title="Home"><i class="fa fa-house select-page"></i></a>
            <a href="profile.php" title="Profile"><i class="fa-solid fa-user"></i></a>
            <!-- Jika user tidak login maka akan ditampilkan tombol untuk ke halaman login -->
            <?php if (!isset($_SESSION["admin"])) : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <!-- jika user sudah login makan akan menampilkan tombol logout dan tombol untuk membuat content -->
            <?php if (isset($_SESSION["admin"])) : ?>
                <a href="logout.php" title="LogOut"><i class="fa-solid fa-right-from-bracket"></i></a>
                <button class="write-content" title="Write Content"><i class="fa-solid fa-pencil "></i></button>
            <?php endif; ?>
        </div>

        <!-- responsive header - tablet & hp -->
        <div class="humberger responsive-header">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="menuHumberger responsive-header">
            <i class="fa fa-times closeMenu"></i>
            <!-- Jika user tidak login maka akan ditampilkan tombol untuk ke halaman login -->
            <?php if (!isset($_SESSION["admin"])) : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <a href="index.php"><i class="fa fa-house"></i>Dasbor</a>
            <a href="profile.php"><i class="fa-solid fa-user"></i>Profile</a>
            <!-- jika user sudah login makan akan menampilkan tombol logout -->
            <?php if (isset($_SESSION["admin"])) : ?>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
            <?php endif; ?>
        </div>
        <a href="index.php" class="responsive-header logoR">
            <h1>S</h1>
        </a>
        <form action="" class="responsive-header hide inputCariR">
            <input type="text" name="cari" id="inputCariR" class="responsive-header hide" placeholder="Cari">
        </form>
        <label for="inputCariR" class="responsive-header cariR fa fa-search"></label>
        <i class="fa fa-times responsive-header closeMenuR hide"></i>
    </header>
    <section>
        <div class="container">
            <main class="main">
                <!-- jika user sudah login makan user bisa malakukan upload content -->
                <?php if (isset($_SESSION["admin"])) : ?>
                    <div class="post">
                        <img src="img/ikbal.jpg" alt="" width="40" height="40">
                        <button class="upload write-content">Apa yang anda pelajari hari ini?</button>
                    </div>
                <?php endif; ?>
                <!-- melakukan perulangan untuk semua data yang ada pada tabel content di database -->
                <?php foreach ($content as $row) : ?>
                    <div class="postingan">
                        <div class="headerPostingan">
                            <a href="">
                                <img src="img/ikbal.jpg" alt="" width="40" height="40">
                                <div class="ident">
                                    Ahmad Ikbal Djaya<br>
                                    <span class="tanggal">
                                        <!-- menampilkan tanggal upload content dari database dengan format hari nama bulan dan tahun -->
                                        <?=date('d M Y', strtotime($row["dateContent"]));?>
                                    </span>
                                </div>
                            </a>
                            <!-- jika user sudah login maka di dapat mengakses opsi postingan/3titik, opsinya berupa mengedit content atau menghapus content -->
                            <?php if (isset($_SESSION["admin"])) : ?>
                                <button class="opsi">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            <?php endif; ?>
                            <div class="opsiAksi hide">
                                <!-- mengirim id content ke halaman edit/hapus, agar dapat di ambil menggunakan variabel $_GET -->
                                <a href="edit.php?idContent=<?= $row['idContent']; ?>">Edit</a>
                                <a href="hapus.php?idContent=<?= $row['idContent'];?>" onclick="return confirm('yakin?');">Hapus</a>
                                <p class="tutupAksi">Tutup</p>
                            </div>
                        </div>
                        <div class="mainPostingan">
                            <!-- menampilkkan judul dan isi content dari database -->
                            <h1> <?= $row["judulContent"] ?> </h1>
                            <p> <?= $row["isiContent"] ?> </p>
                        </div>
                        <ul class="footerPostingan">
                            <li title="Like"><i class="fa-regular fa-thumbs-up"></i></li>
                            <li title="Comment"><i class="fa-regular fa-comment"></i></li>
                            <li title="Share"><i class="fa-solid fa-share"></i></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </main>
            <aside class="aside">
                <div class="thanks">
                    <h3>Thank To</h3>
                    <hr>
                    <div class="sThanks">
                        <a href="https://code.visualstudio.com/" target="_blank">
                            <img src="img/VSC2.png" alt="" width="35" height="35">
                            Visual Studi Code
                        </a>
                        <a class="ic" href="https://code.visualstudio.com/" target="_blank">
                            Kunjungi &emsp;
                        </a>
                    </div>
                    <div class="sThanks">
                        <a href="https://fontawesome.com/" target="_blank">
                            <img src="img/font-awesome-solid.svg" alt="" width="35" height="35">
                            Font Awesome
                        </a>
                        <a class="ic" href="https://fontawesome.com/" target="_blank">
                            Kunjungi &emsp;
                        </a>
                    </div>
                    <div class="sThanks">
                        <a href="https://www.apachefriends.org/download.html" target="_blank">
                            <img src="img/XAMPP.png" alt="" width="35" height="35">
                            XAMPP
                        </a>
                        <a class="ic" href="https://www.apachefriends.org/download.html" target="_blank">
                            Kunjungi &emsp;
                        </a>
                    </div>
                </div>
                <div class="contact">
                    <h3>Contact</h3>
                    <hr>
                    <ul>
                        <li><i class="fa-brands fa-whatsapp-square"></i>081241250245</li>
                        <li>
                            <a href="https://www.instagram.com/djaya_ikbal/" target="_blank">
                                <i class="fa-brands fa-instagram-square"></i>@djaya_ikbal
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa-brands fa-facebook-square"></i>Ahmad Ikbal Djaya
                            </a>
                        </li>
                    </ul>
                </div>
                <footer class="footerAside">
                    <hr>
                    Dibuat Sebagai Tugas 1 Mata Kuliah Pemrograman Web2
                    <hr>
                    &copy; Ahmad Ikbal Djaya <br> April 2022
                </footer>
            </aside>
        </div>
    </section>
    <div class="overlay hide">
        <div class="containerOverlay">
            <div class="overlayHeader">
                <h1>Buat Postingan</h1>
                <button class="closeOverlay">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <hr>
            <form class="upload" action="" method="post" enctype="multipart/form-data">
                <h3>Ahmad Ikbal Djaya</h3>
                <input type="text" name="judul" id="" placeholder="Judul" required><br>
                <textarea type="text" name="content" placeholder="Text anda di sini" maxlength="500" required></textarea>
                <br>
                <input type="submit" value="Kirim" name="posting">
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>