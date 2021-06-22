<?php 
	require_once "./lib/config.php";
	if(isset($_GET['action']) && isset($_GET['id'])){
		if(isset($_POST['upload_bukti'])){
			$foto_bukti = $_FILES['foto_bukti'];
			$nama_foto = $foto_bukti['name'];
			$tmp_foto = $foto_bukti['tmp_name'];
			$lokasi = "C:\\xampp\\htdocs\\Elektra\\product_image\\payment\\";
			if (move_uploaded_file($tmp_foto, $lokasi.$nama_foto)) {
				$id_pembelian = $_GET['id'];
				$query_update = $koneksi->query("UPDATE tb_pembelian SET foto_bukti='$nama_foto', tgl_pembayaran= NOW(), status='Proses' WHERE id_pembelian=$id_pembelian");
				if ($query_update) {
					echo "<script>alert('Pesanan anda sedang di proses!')
					location.href = 'info.php';
					</script>";
				}
				else{
					echo "<script>alert('Update Payment Failed')
					location.href = 'info.php';
					</script>";
				}
			}
			else{
				echo "<script>alert('Failed to Upload Image')
				location.href = 'info.php';
				</script>";
			}
		}
	}else{
		header('location: info.php');
	}
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elektra Hardware <?= $_SESSION['user_login']['id_konsumen'] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>

<body>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">
							Foto Bukti
						</label>
						<div class="col-sm-10">
							<input type="file" name="foto_bukti" class="form-control-file" required>
							<small>Max 2MB</small>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-4 offset-sm-2">
							<button type="reset" class="btn btn-secondary">Cancel</button>
							<button type="submit" class="btn btn-primary" name="upload_bukti">Bayar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>