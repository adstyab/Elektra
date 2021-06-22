<?php 
	require_once 'lib/config.php';
	date_default_timezone_set('Asia/Makassar');
	$waktu = date("Y-m-d  H:i:s");
	// echo $waktu;
	$id_user = $_SESSION['user_login']['id_konsumen'];
	$id_jasa = $_POST['kurir_product'];
	$getKurir = $koneksi->query("SELECT * FROM tb_jasa_pengiriman WHERE id_jasa = '$id_jasa'");
	$dataKurir = $getKurir->fetch_assoc();
	$grand_total = $_SESSION['grand_total'] + $dataKurir['tarif'];
	$id_pembelian = 0;
	$query_pembelian = $koneksi->query("INSERT INTO tb_pembelian VALUES (NULL, '$id_user', '$id_jasa', '$grand_total', NULL,  'Belum Lunas', NULL)");
	if ($query_pembelian) {
		$id_pembelian = $koneksi->insert_id;
		foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah_qty) {
			$query_pembelian_produk = $koneksi->query("INSERT INTO tb_pembelian_produk VALUES (NULL, '$id_pembelian', '$id_produk', '$jumlah_qty')");
			$query_produk = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk = $id_produk");
			$data_produk = $query_produk->fetch_assoc();
			$stok_sekarang = $data_produk['stok'] - $jumlah_qty;
			$query_update_stok = $koneksi->query("UPDATE tb_produk SET stok=$stok_sekarang WHERE id_produk=$id_produk");
		}
		unset($_SESSION['keranjang_belanja']);
		$_SESSION['grand_total'] = 0;
		header('location: info.php');
	}
 ?>