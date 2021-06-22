<?php 
  $id = $_GET['id'];
  $query_kurir = $koneksi->query("SELECT * FROM tb_jasa_pengiriman WHERE id_jasa=$id");
  if ($query_kurir->num_rows>0) {
    $data_kurir = $query_kurir->fetch_assoc();
  }
  else{
    header('location: index.php?menu=kurir');
  }

  if (isset($_POST['update_kurir'])) {
    $nama_jasa = $koneksi->real_escape_string($_POST['nama_jasa']);
    $tarif = $koneksi->real_escape_string($_POST['tarif']);
    $query_update =  $koneksi->query("UPDATE tb_jasa_pengiriman SET nama_jasa='$nama_jasa', tarif='$tarif' WHERE id_jasa=$id");
    if($query_update){
      $_SESSION['success_msg']['update_kurir'] = "Services is successfully updated!";
    }
    else{
      $_SESSION['error_msg']['update_kurir'] = "Error while updated Services!";
    }
      echo "<script>setTimeout(function(){
      location.href= 'index.php?menu=kurir'},1000);
    </script>";
  }
?>
<?php
    if (isset($_SESSION['success_msg']['update_kurir'])) {
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?=$_SESSION['success_msg']['update_kurir'] = "Services is successfully updated!"?></strong> 
    </div>
<?php 
    }
    elseif(isset($_SESSION['error_msg']['update_kurir'])){
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?=$_SESSION['error_msg']['update_kurir'] = "Error while updated Services!"?></strong> 
    </div>
<?php 
    }
    unset($_SESSION['success_msg']['update_kurir']);
    unset($_SESSION['error_msg']['update_kurir']);
?>
                        
<div class="col-lg-12">
			
    <div class="card">
    <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Edit kurir</h2>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2 form-control-label">Nama Jasa</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_jasa" value="<?= $data_kurir['nama_jasa'] ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label">Tarif (Rp.)</label>
            <div class="col-sm-10">
                <input type="number" min="1" class="form-control" name="tarif" value="<?= $data_kurir['tarif'] ?>" required>
            </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
            <div class="col-sm-4 offset-sm-2">
            <button type="reset" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update_kurir">Simpan Perubahan</button>
            </div>
        </div>
        </form>
    </div>
    </div>
            
</div>