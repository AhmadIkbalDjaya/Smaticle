<?php
    require 'functions.php';
    session_start();
    // jika belum login maka akan menuju login.php
    // karena hanya admin yg boleh melakukan perubahan atau edit content
    if( !isset($_SESSION["admin"]) ){
        header("Location: login.php");
        exit;
    }
    // mengambil id yg dikirm melalui url
    $idContent = $_GET["idContent"];
    // mengambil data content dari database berdasarkan id content
    $data = query("SELECT * FROM `content` WHERE idContent='$idContent'")[0];
    // cek apakah user menekan tomboll edit content
    if( isset($_POST["editContent"]) ){
        // jika fungsi edit mengembalikan nilai yg lebih besar dari nol maka akan menampilkan notifikasi berhasil di edit dan akan menuju halaman index
        // singkatnya apakh data berhasil di  edit atau tidak
        if(edit($_POST) > 0){
            echo "<script>
                alert ('Data berhasil diubah');
                document.location.href='index.php';
            </script>";
        }
        // jika fungsi edit mengembalikan nilai yg nol ataulebih kecill maka akan menampilkan notifikasi berhasil di edit dan akan menuju halaman index
        else{
            echo "<script>
                alert ('Data gagal diubah');
            </script>";
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smaticle - Edit Content</title>
    <link rel="stylesheet" href="css/edit.css">
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
            <a href="index.php" title="Home"><i class="fa fa-house"></i></a>
            <a href="profile.php" title="Profile"><i class="fa-solid fa-user"></i></a>
            <!-- Jika user tidak login maka akan ditampilkan tombol untuk ke halaman login -->
            <?php if (!isset($_SESSION["admin"])) : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <!-- jika user sudah login makan akan menampilkan tombol logout dan tombol untuk membuat content -->
            <?php if (isset($_SESSION["admin"])) : ?>
                <a href="logout.php" title="LogOut"><i class="fa-solid fa-right-from-bracket"></i></a>
                <!-- <button class="write-content" title="Write Content"><i class="fa-solid fa-pencil "></i></button> -->
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
            <input type="text" name="cari" id="inputCariR" class="responsive-header hide" placeholder="Cari SSSSSSSSS">
        </form>
        <label for="inputCariR" class="responsive-header cariR fa fa-search"></label>
        <i class="fa fa-times responsive-header closeMenuR hide"></i>
    </header>
    <section>
        <div class="container">
            <main class="main">
                <div class="post">
                    <h1>Edit Content</h1>
                </div>
                <div class="postingan">
                    <div class="headerPostingan">
                        <a href="">
                            <img src="img/ikbal.jpg" alt="" width="40" height="40">
                            <div class="ident">
                                Ahmad Ikbal Djaya<br>
                                <span class="tanggal"><!-- menampilkan tanggal upload content dari database dengan format hari nama bulan dan tahun -->
                                    <?=date('d M Y', strtotime($data["dateContent"]));?>
                                </span>
                            </div>
                        </a>
                    </div>
                    <form class="mainPostingan editContent" action="" method="post" enctype="multipart/form-data">
                        <!-- menampilkan id, judul dan isi content yg ingin di edit sebagai value di elemen input -->
                        <input type="hidden" name="idContent" value="<?= $data['idContent'];?>">
                        <input type="text" name="judul" id="" value="<?= $data['judulContent'];?>"><br>
                        <textarea type="text" name="content"><?= $data['isiContent'];?></textarea>
                        <br>
                        <input type="submit" value="Edit Content" name="editContent">
                    </form>
                </div>
            </main>
        </div>
    </section>
<script src="js/script.js"></script>
</body>
</html>