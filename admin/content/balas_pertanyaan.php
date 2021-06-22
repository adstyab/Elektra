<?php 
  $id = $_GET['id'];
  $query_pertanyaan = $koneksi->query("SELECT * FROM tb_pertanyaan WHERE id_pertanyaan=$id");
  if ($query_pertanyaan->num_rows>0) {
    $data_pertanyaan = $query_pertanyaan->fetch_assoc();
  }
  else{
    header('location: index.php?menu=pertanyaan');
  }

  if (isset($_POST['update_pertanyaan'])) {
    $balas = $koneksi->real_escape_string($_POST['balas']);
    $query_update =  $koneksi->query("UPDATE tb_pertanyaan SET balas='$balas' WHERE id_pertanyaan=$id");
    if($query_update){
      $_SESSION['success_msg']['update_pertanyaan'] = "Asking is successfully updated!";
    }
    else{
      $_SESSION['error_msg']['update_pertanyaan'] = "Error while updated Asking!";
    }
      echo "<script>setTimeout(function(){
      location.href= 'index.php?menu=tanya&id=".$data_pertanyaan['id_produk']."'},1000);
    </script>";
  }
 ?>
  <?php
    if (isset($_SESSION['success_msg']['update_pertanyaan'])) {
      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
<strong><?=$_SESSION['success_msg']['update_pertanyaan'] = "Asking is successfully updated!"?></strong> 
</div>
<?php 
    }
    elseif(isset($_SESSION['error_msg']['update_pertanyaan'])){
      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong><?=$_SESSION['error_msg']['update_pertanyaan'] = "Error while updated Asking!"?></strong> 
        </div>
<?php 
    }
    unset($_SESSION['success_msg']['update_pertanyaan']);
    unset($_SESSION['error_msg']['update_pertanyaan']);
  ?>
                        
<div class="col-lg-12">
			
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h2 class="h5 display">Edit pertanyaan</h2>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label">pertanyaan</label>
          <div class="col-sm-10">
            <p>
            <?= $data_pertanyaan['isi'] ?>
            </p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label">balas</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="balas" value="<?= $data_pertanyaan['balas'] ?>" required>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-2">
            <button type="reset" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update_pertanyaan">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
            
</div>