<?php
    if(isset($_GET['id'])){
        $id_konsumen = $_GET['id'];
        $query_check = $koneksi->query("SELECT * FROM tb_konsumen WHERE id_konsumen = $id_konsumen");
        if($query_check->num_rows > 0){
            $query_delete = $koneksi->query("DELETE FROM tb_konsumen WHERE id_konsumen = $id_konsumen");
            if($query_delete){
                $_SESSION['success_msg']['delete_konsumen'] = 'Category successfully deleted!';
                header('location: index.php?menu=pelanggan');
            }else{
                $_SESSION['error_msg']['delete_konsumen'] = 'failed to delete the category';
                header('location: index.php?menu=pelanggan');
            }
        }else{
            $_SESSION['error_msg']['delete_konsumen'] = 'something error!';
            header('location: index.php?menu=pelanggan');
        }
    }else{
        header('location: index.php?menu=pelanggan');
    }
?>