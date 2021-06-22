<?php
    if(isset($_GET['id'])){
        $id_merk = $_GET['id'];
        $query_check = $koneksi->query("SELECT * FROM tb_merk WHERE id_merk = $id_merk");
        if($query_check->num_rows > 0){
            $query_delete = $koneksi->query("DELETE FROM tb_merk WHERE id_merk = $id_merk");
            if($query_delete){
                $_SESSION['success_msg']['delete_merk'] = 'Category successfully deleted!';
                header('location: index.php?menu=merk');
            }else{
                $_SESSION['error_msg']['delete_merk'] = 'failed to delete the category';
                header('location: index.php?menu=merk');
            }
        }else{
            $_SESSION['error_msg']['delete_merk'] = 'something error!';
            header('location: index.php?menu=merk');
        }
    }else{
        header('location: index.php?menu=merk');
    }
?>