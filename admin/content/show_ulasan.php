<link rel="stylesheet" type="text/css" href="../css/table.css">
<div class="row">
    <?php 
    if (isset($_SESSION['success_msg']['delete_ulasan'])){
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        <strong>Success Message</strong> 
        </div>
    <?php
    }
    elseif (isset($_SESSION['error_msg']['delete_ulasan'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error Message</strong>
        </div>
    <?php
    }
    unset($_SESSION['success_msg']['delete_ulasan']);
    unset($_SESSION['error_msg']['delete_ulasan']);
    ?>
                           
</div>
                <?php
                    $id = $_GET['id'];
                    $getName = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk = $id");
                    $dataName = $getName->fetch_assoc();
                    $query_ulasan= $koneksi->query("SELECT * FROM tb_ulasan INNER JOIN tb_produk ON tb_ulasan.id_produk = tb_produk.id_produk INNER JOIN tb_konsumen ON tb_ulasan.id_konsumen = tb_konsumen.id_konsumen");
                    
                    
                ?>
<div class="col-lg-12">
	<h3>Ulasan Dashboard</h3>
	<div class="card">
		<div class="card-header d-flex align-items-center">
			<h2 class="h5 display">Ulasan Produk <?= $dataName['nama_produk'] ?></h2>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover table-responsive">
				<thead>
					<tr>
						<th>#No</th>
                        <th>Konsumen</th>
						<th>Isi ulasan</th>
                        <th>Balasan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php   
                        if($query_ulasan->num_rows > 0){
                            $nomor = 1;
                            while($data_ulasan = $query_ulasan->fetch_assoc()){
                                // var_dump($data_ulasan['nama_ulasan']);
                                ?>
                                    <tr>
                                        <th scope="row"><?= $nomor?></th>
                                        <td><?= $data_ulasan['nama_lengkap'] ?></td>
                                        <td><?= $data_ulasan['isi']?></td>
                                        <td><?= isset($data_ulasan['balasan']) ? $data_ulasan['balasan'] : "Tidak ada" ?></td>
                                        <td>
                                        <a href="index.php?menu=balas_ulasan&id=<?= $data_ulasan['id_ulasan']?>"><button class="btn btn-info">Reply</button></a>
                                        </td>
                                    </tr>
                                <?php
                                $nomor++;
                            }
                        }else if($query_ulasan->num_rows == 0){
                            ?>
                                <td colspan="3" class="text-center">
                                <h1>Tidak Ada Data</h1>
                                </td>
                            <?php
                        }
                    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>