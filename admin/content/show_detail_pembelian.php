<?php 
	$id_detail = $_GET['id'];
	require_once '../lib/config.php';
 ?>
<link rel="stylesheet" type="text/css" href="../css/tables.css">
<div class="col-lg-12">
	<h3>Pembelian Dashboard</h3>
	<div class="card-header d-flex align-items-center justify-content-between">
		<h2 class="h5 display">List Pembelian</h2>
		<a href="?menu=pembelian" class="float-right">
			<button class="btn btn-primary">Back</button>
		</a>
	</div>
	<div class="card-body">
		<table class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th>#No</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Services Cost</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$nomor = 0;
					$query_pembelian = $koneksi->query("SELECT * FROM tb_pembelian_produk INNER JOIN tb_pembelian ON tb_pembelian_produk.id_pembelian = tb_pembelian.id_pembelian INNER JOIN tb_produk ON tb_pembelian_produk.id_produk = tb_produk.id_produk INNER JOIN tb_jasa_pengiriman ON tb_pembelian.id_jasa = tb_jasa_pengiriman.id_jasa WHERE tb_pembelian_produk.id_pembelian = $id_detail");
					while ($data = $query_pembelian->fetch_assoc()) {
						$Subtotal = $data['harga'] * $data['jml_pembelian'];
						?>
						<tr>
							<td scope="row"><?= ++$nomor?></td>
							<td><?=$data['nama_produk']?></td>
							<td><?=number_format($data['harga'])?></td>
							<td><?=$data['jml_pembelian']?></td>
							<td><?= $data['nama_jasa']."(Rp. ".$data['tarif'].")" ?></td>
							<td>Rp. <?= number_format($Subtotal + $data['tarif'] )?></td>
							<td>
							
							</td>
						</tr>
						<?php
					}
				 ?>
			</tbody>
		</table>
	</div>
</div>