<?php 
  $id = $_GET['id'];
  $query_ulasan = $koneksi->query("SELECT * FROM tb_ulasan WHERE id_ulasan=$id");
  if ($query_ulasan->num_rows>0) {
    $data_ulasan = $query_ulasan->fetch_assoc();
  }
  else{
    header('location: index.php?menu=ulasan');
  }

  if (isset($_POST['update_ulasan'])) {
    $balasan = $koneksi->real_escape_string($_POST['balasan']);
    $query_update =  $koneksi->query("UPDATE tb_ulasan SET balasan='$balasan'WHERE id_ulasan=$id");
    if($query_update){
      $_SESSION['success_msg']['update_ulasan'] = "Review is successfully updated!";
    }
    else{
      $_SESSION['error_msg']['update_ulasan'] = "Error while updated Review!";
    }
      echo "<script>setTimeout(function(){
      location.href= 'index.php?menu=ulasan&id=".$data_ulasan['id_produk']."'},1000);
    </script>";
  }
 ?>
  <?php
    if (isset($_SESSION['success_msg']['update_ulasan'])) {
      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
<strong><?=$_SESSION['success_msg']['update_ulasan'] = "Review is successfully updated!"?></strong> 
</div>
<?php 
    }
    elseif(isset($_SESSION['error_msg']['update_ulasan'])){
      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong><?=$_SESSION['error_msg']['update_ulasan'] = "Error while updated Review!"?></strong> 
        </div>
<?php 
    }
    unset($_SESSION['success_msg']['update_ulasan']);
    unset($_SESSION['error_msg']['update_ulasan']);
  ?>
                        
<div class="col-lg-12">
			
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h2 class="h5 display">Edit ulasan</h2>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label">Ulasan</label>
          <div class="col-sm-10">
            <p>
            <?= $data_ulasan['isi'] ?>
            </p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label">Balasan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="balasan" value="<?= $data_ulasan['balasan'] ?>" required>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-2">
            <button type="reset" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update_ulasan">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
            
</div>