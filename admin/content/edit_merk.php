<?php 
  $id = $_GET['id'];
  $query_merk = $koneksi->query("SELECT * FROM tb_merk WHERE id_merk=$id");
  if ($query_merk->num_rows>0) {
    $data_merk = $query_merk->fetch_assoc();
  }
  else{
    header('location: index.php?menu=merk');
  }

  if (isset($_POST['update_merk'])) {
    $nama_merk = $koneksi->real_escape_string($_POST['nama_merk']);
    $kategori_merk = $koneksi->real_escape_string($_POST['kategori']);
    $query_update =  $koneksi->query("UPDATE tb_merk SET nama_merk='$nama_merk', id_kategori='$kategori_merk' WHERE id_merk=$id");
    if($query_update){
      $_SESSION['success_msg']['update_merk'] = "Brand is successfully updated!";
    }
    else{
      $_SESSION['error_msg']['update_merk'] = "Error while updated Brand!";
    }
      echo "<script>setTimeout(function(){
      location.href= 'index.php?menu=merk'},1000);
    </script>";
  }
?>
<?php
    if (isset($_SESSION['success_msg']['update_merk'])) {
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?=$_SESSION['success_msg']['update_merk'] = "Brand is successfully updated!"?></strong> 
    </div>
<?php 
    }
    elseif(isset($_SESSION['error_msg']['update_merk'])){
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?=$_SESSION['error_msg']['update_merk'] = "Error while updated Brand!"?></strong> 
    </div>
<?php 
    }
    unset($_SESSION['success_msg']['update_merk']);
    unset($_SESSION['error_msg']['update_merk']);
?>
                        
<div class="col-lg-12">
			
    <div class="card">
    <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Edit merk</h2>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2 form-control-label">Nama merk</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_merk" value="<?= $data_merk['nama_merk'] ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label">Kategori</label>
            <div class="col-sm-10">
                <select class="form-control" name="kategori">
                <?php 
                    $getKategori = $koneksi->query("SELECT * FROM tb_kategori");
                    while ($dataKategori = $getKategori->fetch_assoc()) {
                ?>
                    <option value="<?= $dataKategori['id_kategori'] ?>" <?= $data_merk['id_kategori'] == $dataKategori['id_kategori'] ? "selected" : "" ?>>
                        <?= $dataKategori['nama_kategori'] ?>
                    </option>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
            <div class="col-sm-4 offset-sm-2">
            <button type="reset" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update_merk">Simpan Perubahan</button>
            </div>
        </div>
        </form>
    </div>
    </div>
            
</div>