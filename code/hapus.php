<?php
    require 'functions.php';
    session_start();
    // jika belum login maka akan menuju login.php
    // karena hanya admin yg boleh melakukan penghapusan
    if( !isset($_SESSION["admin"]) ){
        header("Location: login.php");
        exit;
    }
    // mengambil id yg dikirm melalui url
    $idContent = $_GET["idContent"];
    // jika fungsi hapus mengembalikan nilai yg lebih besar dari nol maka akan menampilkan notifikasi berhasil di hapus dan akan menuju halaman index
    if( hapus($idContent) > 0 ){
        echo "<script>
            alert ('Data berhasil dihapus');
            document.location.href='index.php';
            console.log('OK');
        </script>";
    }
    // jika fungsi hapus mengembalikan nilai nol atau lebih kecil  maka juga akan menampilakn notifikasi dan menuju halaman index
    else{
        echo "<script>
                alert ('Data gagal dihapus');
                document.location.href='index.php';
            </script>";
    }

?>