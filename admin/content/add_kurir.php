<?php
  if(isset($_POST['save_kurir'])){
    $nama_jasa = $koneksi->real_escape_string($_POST['nama_jasa']);
    $tarif = $koneksi->real_escape_string($_POST['tarif']);
    if(empty($nama_jasa) || empty($tarif)){
        $_SESSION['error_msg']['add_kurir'] = "please fill all field!";
    }else{
        $query_check = $koneksi->query("SELECT * FROM tb_jasa_pengiriman WHERE nama_jasa='$nama_jasa'");
        if($query_check->num_rows == 0){
            $query_insert = $koneksi->query("INSERT INTO tb_jasa_pengiriman VALUES (NULL, '$nama_jasa', '$tarif')");
        if($query_insert){
            $_SESSION['success_msg']['add_kurir'] = "Services <b>".$nama_jasa."</b> is successfully added!";
        }else{
            $_SESSION['error_msg']['add_kurir'] = "Failed to add Services";
        }
        }else{
            $_SESSION['error_msg']['add_kurir'] = "Duplicate Services!";
        }
        echo "<script>setTimeout(function(){
                location.href= 'index.php?menu=add_kurir'},1000);
            </script>";
    }
  }
  if(isset($_SESSION['success_msg']['add_kurir'])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong><?= $_SESSION['success_msg']['add_kurir']?></strong>
    </div>
    <?php
  }else if(isset($_SESSION['error_msg']['add_kurir'])){
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong><?= $_SESSION['error_msg']['add_kurir']?></strong>
    </div>
<?php
  }
  unset($_SESSION['success_msg']['add_kurir']);
  unset($_SESSION['error_msg']['add_kurir']);
?>
<div class="col-lg-12">
   <div class="card">
       <div class="card-header d-flex align-items-center">
            <h2 class="h5 display">Tambah Jasa Pengiriman</h2>
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_jasa" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label">Tarif (Rp.)</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" class="form-control" name="tarif" required>
                    </div>
                </div>
                <div class="line"></div>

                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="save_kurir">Tambahkan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>