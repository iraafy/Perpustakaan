<?php 

    require 'conn.php';
    session_start();
    if( !isset($_SESSION["login"]))
    {
        header("Location: login.php");
        exit;
    }
    else{
        $query = "UPDATE peminjaman SET sudah_dikembalikan = 1 WHERE id_buku = $_GET[id_buku]";
        mysqli_query($conn, $query);
        header('location: riwayat.php');
    }

?>