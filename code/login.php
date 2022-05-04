<?php
    require 'functions.php';
    session_start();
    // jika user sudah login sebelumnya makan dia tidak bisa ke halaman login lagi
    if( isset($_SESSION["admin"]) ){
        header ('Location: index.php');
        exit;
    }
    // cek apakah tobol login di tekan
    if( isset($_POST["login"]) ){
        // jika login ditekan maka dari dari from akan dimasukkan ke variabel
        $username = $_POST["username"];
        $password = $_POST["password"];
        // cekk apakah username ada di database
        $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username'");
        
        if( mysqli_num_rows($result) === 1){
            // jika username ditemukan makan akan dilakukan cek password
            $row = mysqli_fetch_assoc($result);
            if( $password == $row["password"]){
                // jika pasword benar makan akan dibuat variabel session dengan key admin yg menandakan user berhasil login
                $_SESSION["admin"] = true;
                // jika sudah berhasil login maka halaman akan menuju ke halaman index
                header("Location: index.php");
                // setelah ke halaman index makan perintah di bawah exit; tidak akan dijalankan
                exit;
            }
        }
        // jika username/password tidak sesuai dengan database makan akan dibuat variabel error
        $error = true;
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Smaticle</title>
</head>
<body>
    <header>
        <a href="index.php">Home</a>
        <a href="registrasion.php">Registrasi</a>
    </header>
    <main>
        <form class="login-box" action="" method="post" enctype="multipart/form-data">
            <h1>Login</h1>
            <div class="inputBox">
                <input type="text" name="username" id="" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" id="" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <!-- jika error maka akan menampilkan notifikasi -->
            <?php if( isset($error) ) : ?>
            <p class="gagalLogin">Username / Password Salah!</p>
            <?php endif ?>
            <input type="submit" value="Login" name="login">
        </form>
    </main>
    <footer>
        &copy;Ahmad Ikbal Djaya 04 April 2022
    </footer>
</body>
</html>