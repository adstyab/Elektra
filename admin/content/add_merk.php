<?php
  if(isset($_POST['save_merk'])){
    $nama_merk = $koneksi->real_escape_string($_POST['nama_merk']);
    $kategori_merk = $koneksi->real_escape_string($_POST['kategori']);
    if(empty($nama_merk) || empty($kategori_merk)){
        $_SESSION['error_msg']['add_merk'] = "please fill all field!";
    }else{
        $query_check = $koneksi->query("SELECT * FROM tb_merk WHERE nama_merk='$nama_merk'");
        if($query_check->num_rows == 0){
            $query_insert = $koneksi->query("INSERT INTO tb_merk VALUES (NULL, '$nama_merk', '$kategori_merk')");
        if($query_insert){
            $_SESSION['success_msg']['add_merk'] = "Brand <b>".$nama_merk."</b> is successfully added!";
        }else{
            $_SESSION['error_msg']['add_merk'] = "Failed to add Brand";
        }
        }else{
            $_SESSION['error_msg']['add_merk'] = "Duplicate Brand!";
        }
        echo "<script>setTimeout(function(){
                location.href= 'index.php?menu=add_merk'},1000);
            </script>";
    }
  }
  if(isset($_SESSION['success_msg']['add_merk'])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong><?= $_SESSION['success_msg']['add_merk']?></strong>
    </div>
    <?php
  }else if(isset($_SESSION['error_msg']['add_merk'])){
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong><?= $_SESSION['error_msg']['add_merk']?></strong>
    </div>
<?php
  }
  unset($_SESSION['success_msg']['add_merk']);
  unset($_SESSION['error_msg']['add_merk']);
?>
<div class="col-lg-12">
   <div class="card">
       <div class="card-header d-flex align-items-center">
            <h2 class="h5 display">Tambah Merk</h2>
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_merk" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kategori" id="">
                        <?php 
                            $getKategori = $koneksi->query("SELECT * FROM tb_kategori");
                            while ($dataKategori = $getKategori->fetch_assoc()) {
                        ?>
                            <option value="<?= $dataKategori['id_kategori'] ?>">
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
                        <button type="submit" class="btn btn-primary" name="save_merk">Tambahkan merk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>