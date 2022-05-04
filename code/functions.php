<?php
    // menghubungkan database dengan php
    $conn = mysqli_connect("localhost", "root", "", "tugas1_web2");

    // membuat fuungsi query dan memasukkan nilainya ke dalam variabel array
    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }


    // fungsi upload content dengan parameter $data
    function uploadContent($data){
        global $conn;
        // memberi nama random untuk id content
        $idContent = uniqid();
        $judulContent = htmlspecialchars($data["judul"]);
        $isiContent = htmlspecialchars($data["content"]);
        // mengambil data hari saat conent di upload
        $dateContent = date('Y-m-d');

        $query =    "INSERT INTO `content` VALUES
                    ('$idContent','$judulContent','$isiContent', '$dateContent')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // fungsi hapus degan parameter idContent
    function hapus($idContent){
        global $conn;
        // mengahapus data sesuai idContent yg dikirim melalui parameter
        mysqli_query($conn, "DELETE FROM content WHERE idContent='$idContent'");
        return mysqli_affected_rows($conn);
    }

    // fungsi edit dengan parameter $data
    function edit($data){
        global $conn;
        
        $idContent = $data["idContent"];
        $judulContent = htmlspecialchars($data["judul"]);
        $isiContent = htmlspecialchars($data["content"]);
        // melalukakan update pada data dengan id tertentu
        $query =    "UPDATE `content` SET
                    judulContent = '$judulContent',
                    isiContent = '$isiContent'
                    WHERE idContent = '$idContent'
                    ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }


    function registrasi($data){
        global $conn;
    
        $regiskey = strtolower( stripslashes($data["regisKey"]) );
        $username = strtolower( stripslashes($data["username"]) );
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM `admin`
                                        WHERE username = '$username'");
    
        if( $regiskey != "breakpoint"){
            echo    "<script>
                        alert ('Regis Key salah anda tidak dapat buat akun!');
                    </script>";
            return false;
        }    

        if( mysqli_fetch_assoc($result) ) {
            echo    "<script>
                        alert ('username sudah terdaftar!');
                    </script>";
            return false;
        }
    
        // cek konfirmasi password
        if( $password !== $password2 ){
            echo    "<script>
                        alert('konfirmasi password tidak sesuai!');
                    </script>";
            return false;
        }
    
        // enkripsi password
        // $password = password_hash($password, PASSWORD_DEFAULT);

        // terjadi error pada login saat password di enkripsi
        // jadi saya memutuskan untuk tidak enkripsi dulu
        
    
        // tambahkan userbaru ke database
        mysqli_query($conn, "INSERT INTO `admin` VALUES('','$username','$password')");
    
        return mysqli_affected_rows($conn);
    }

?>