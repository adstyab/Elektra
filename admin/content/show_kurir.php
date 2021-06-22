<!-- <?php 
	// $id_detail = $_GET['id'];
 ?> -->
<link rel="stylesheet" type="text/css" href="../css/tables.css">
<div class="col-lg-12">
	<h3>Dashboard Layanan Pengiriman</h3>
	<div class="card-header d-flex align-items-center justify-content-between">
		<h2 class="h5 display">List Jasa Pengiriman</h2>
		<a href="?menu=add_kurir">
			<button class="btn btn-primary">Add Kurir</button>
		</a>
	</div>
	<div class="card-body">
	
		<table class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th>#No</th>
					<th>Nama Layanan</th>
					<th>Tarif</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$nomor = 0;
					$query_user = $koneksi->query("SELECT * FROM tb_jasa_pengiriman");
					while ($data = $query_user->fetch_assoc()) {
						?>
						<tr>
							<td scope="row"><?= ++$nomor?></td>
							<td><?= $data['nama_jasa']?></td>
							<td><?= $data['tarif']?></td>
							<td>
								<a href="index.php?menu=edit_kurir&id=<?= $data['id_jasa']?>"><button class="btn btn-info">Edit</button></a>
								<a href="index.php?menu=delete_kurir&id=<?= $data['id_jasa']?>"><button class="btn btn-danger">Delete</button></a>
							</td>
						</tr>
						<?php
					}
				 ?>
			</tbody>
		</table>
	</div>
</div>