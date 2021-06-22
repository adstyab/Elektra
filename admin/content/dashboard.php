<?php
    if(isset($_GET['menu'])){
        if($_GET['menu'] == 'kategori'){
            // echo "<h1>Menu Kategori</h1>";
            require_once "content/show_kategori.php";
        }else if($_GET['menu'] == 'add_kategori'){
            require_once "content/add_kategori.php";
        }else if($_GET['menu'] == 'delete_kategori' && isset ($_GET['id'])){
            require_once "content/delete_kategori.php";
        }else if($_GET['menu'] == 'edit_kategori' && isset ($_GET['id'])){
            require_once "content/edit_kategori.php";
        }
        
        elseif ($_GET['menu'] == 'add_merk') {
            require_once "content/add_merk.php";
        }elseif ($_GET['menu'] == 'merk') {
            require_once "content/show_merk.php";
        }else if($_GET['menu'] == 'delete_merk' && isset ($_GET['id'])){
            require_once "content/delete_merk.php";
        }else if($_GET['menu'] == 'edit_merk' && isset ($_GET['id'])){
            require_once "content/edit_merk.php";
        }

        elseif ($_GET['menu'] == 'add_kurir') {
            require_once "content/add_kurir.php";
        }elseif ($_GET['menu'] == 'kurir') {
            require_once "content/show_kurir.php";
        }else if($_GET['menu'] == 'delete_kurir' && isset ($_GET['id'])){
            require_once "content/delete_kurir.php";
        }else if($_GET['menu'] == 'edit_kurir' && isset ($_GET['id'])){
            require_once "content/edit_kurir.php";
        }
        
        else if($_GET['menu'] == 'produk'){
            // echo "<h1>Menu Produk</h1>";
            require_once "content/show_produk.php";
        }else if($_GET['menu'] == 'add_produk'){
            // echo "<h1>Menu Produk</h1>";
            require_once "content/add_produk.php";
        }else if($_GET['menu'] == 'ulasan' && isset ($_GET['id'])){
            // echo "<h1>Menu Produk</h1>";
            require_once "content/show_ulasan.php";
        }else if($_GET['menu'] == 'balas_ulasan' && isset ($_GET['id'])){
            // echo "<h1>Menu Produk</h1>";
            require_once "content/balas_ulasan.php";
        }  

        else if($_GET['menu'] == 'tanya' && isset ($_GET['id'])){
            // echo "<h1>Menu Produk</h1>";
            require_once "content/show_pertanyaan.php";
        }else if($_GET['menu'] == 'balas_pertanyaan' && isset ($_GET['id'])){
            // echo "<h1>Menu Produk</h1>";
            require_once "content/balas_pertanyaan.php";
        }  
        
        else if($_GET['menu'] == 'pembelian'){
            // echo "<h1>Menu Pembelian</h1>";
            require_once "content/show_pembelian.php";
        }else if($_GET['menu'] == 'detail_pembelian'){
            //echo "<h1>Menu Pembelian</h1>";
            require_once "content/show_detail_pembelian.php";
        }else if($_GET['menu'] == 'konfirmasi_pembelian'){
            //echo "<h1>Menu Pembelian</h1>";
            require_once "content/konfirmasi_pembelian.php";
        }
        
        else if($_GET['menu'] == 'pelanggan'){
            // echo "<h1>Menu Pelanggan</h1>";
            require_once "content/show_pelanggan.php";
        }else if($_GET['menu'] == 'delete_pelanggan' && isset ($_GET['id'])){
            // echo "<h1>Menu Pelanggan</h1>";
            require_once "content/delete_pelanggan.php";
        }
        
        else if($_GET['menu'] == 'edit_produk' && isset ($_GET['id'])){
            require_once "content/edit_produk.php";
        }else if($_GET['menu'] == 'delete_produk' && isset ($_GET['id'])){
            require_once "content/delete_produk.php";
        }else if($_GET['menu'] == 'hapus_pembelian' && isset ($_GET['id'])){
            require_once "content/hapus_pembelian.php";
        }else{
            header('location: index.php');
        }
    }else{
        echo "<h1>Bukan Halaman Menu</h1>";
    }
?>