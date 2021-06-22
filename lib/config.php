<?php
    session_start();
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'elektra_hardware';

    @$koneksi = new mysqli($host, $username, $password, $db_name);
    if($koneksi->connect_error){
        die('Error : '.$koneksi->connect_error);
    }else{
        // echo "Sukses!";
    }
    if(!isset($_SESSION['grand_total'])){
        $_SESSION['grand_total'] = 0;
    }
?>
