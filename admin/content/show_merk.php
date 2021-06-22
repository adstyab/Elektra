<link rel="stylesheet" type="text/css" href="../css/table.css">
<div class="row">
    <?php 
    if (isset($_SESSION['success_msg']['delete_merk'])){
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        <strong>Success Message</strong> 
        </div>
    <?php
    }
    elseif (isset($_SESSION['error_msg']['delete_merk'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error Message</strong>
        </div>
    <?php
    }
    unset($_SESSION['success_msg']['delete_merk']);
    unset($_SESSION['error_msg']['delete_merk']);
    ?>
                           
	<div class="col-lg-12">
		<a href="?menu=add_merk" class="float-right">
			<button class="btn btn-primary">Add Merk</button>
		</a>
	</div>
</div>
<div class="col-lg-12">
	<h3>Merk Dashboard</h3>
	<div class="card">
		<div class="card-header d-flex align-items-center">
			<h2 class="h5 display">List of Merk (Menghapus 1 merk, berarti menghapus semua produk sesuai dengan merknya)</h2>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover table-responsive">
				<thead>
					<tr>
						<th>#No</th>
						<th>Nama Merk</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        $query_merk= $koneksi->query("SELECT * FROM tb_merk");
                        if($query_merk->num_rows > 0){
                            $nomor = 1;
                            while($data_merk = $query_merk->fetch_assoc()){
                                // var_dump($data_merk['nama_merk']);
                                ?>
                                    <tr>
                                        <th scope="row"><?= $nomor?></th>
                                        <td><?= $data_merk['nama_merk']?></td>
                                        <td>
                                        <a href="index.php?menu=edit_merk&id=<?= $data_merk['id_merk']?>"><button class="btn btn-info">Edit</button></a>
                                        <a href="index.php?menu=delete_merk&id=<?= $data_merk['id_merk']?>"><button class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                <?php
                                $nomor++;
                            }
                        }else if($query_merk->num_rows == 0){
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