<?php 
	session_start();
	if(!isset($_SESSION['user_login'])){
		header('location: login.php');
	}
	else{
		$id_produk = $_GET['id'];
		$qty = $_POST['qty'];
		if (isset($_SESSION['keranjang_belanja'][$id_produk])) {
			!isset($_POST['qty']) ? 
			$_SESSION['keranjang_belanja'][$id_produk]++	
			: $_SESSION['keranjang_belanja'][$id_produk] += $qty;
		}
		else{
			if(!isset($_POST['qty'])){
				$_SESSION['keranjang_belanja'][$id_produk] = 1;
			}else{
				$_SESSION['keranjang_belanja'][$id_produk] = $qty;
			}
		}
		if(isset($_GET['clear'])){
			unset($_GET['keranjang_belanja']);
			unset($_GET['grand_total']);
		}
		header('location: cart.php');
	}
 ?>
