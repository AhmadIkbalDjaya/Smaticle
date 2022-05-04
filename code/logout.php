<?php

    session_start();
    // mengosongkan variabel $_SESSION
    $_SESSION = [];
    // menghilangkan seluruh variabel session
    session_unset();
    // menghilangkan session
    session_destroy();
    // Menuju halaman login
    header('Location: login.php');
    exit;

?>