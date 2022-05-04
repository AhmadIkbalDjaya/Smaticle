<?php
    require 'functions.php';
    session_start();
    // jika user sudah login sebelumnya makan dia tidak bisa ke halaman regis lagi
    if( isset($_SESSION["admin"]) ){
        header ('Location: index.php');
        exit;
    }

    // jika tombol register sudah di tekan
    if( isset($_POST["registrasi"]) ){

        if(registrasi($_POST) > 0){
            echo    "<script>
                        alert('user baru berhasil ditambahkan');
                        document.location.href='login.php';
                    </script>";
        }
        else{
            echo mysqli_error($conn);
        }
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
    <title>Registrasi Smaticle</title>
</head>
<body>
    <header>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </header>
    <main>
        <form class="login-box" action="" method="post" enctype="multipart/form-data">
            <h1>Registrasi</h1>
            <div class="inputBox">
                <input type="text" name="regisKey" id="" placeholder="Registrasi Key" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inputBox">
                <input type="text" name="username" id="" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" id="" placeholder="Password"required>
                <i class="fa-solid fa-key"></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password2" id="" placeholder="Konfirmasi Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <input type="submit" value="Registrasi" name="registrasi">
        </form>
    </main>
    <footer>
        &copy;Ahmad Ikbal Djaya 04 April 2022
    </footer>
</body>
</html>