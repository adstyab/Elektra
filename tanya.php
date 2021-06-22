<?php
  require_once 'lib/config.php';
  if(isset($_POST['save_pertanyaan'])){
    $id = $_GET['id'];
    $isi_pertanyaan = $koneksi->real_escape_string($_POST['isi_pertanyaan']);
    if(empty($isi_pertanyaan)){
      $_SESSION['error_msg']['add_pertanyaan'] = "please fill all field!";
    }else{
    $id_konsumen = $_SESSION['user_login']['id_konsumen'];
    $query_insert = $koneksi->query("INSERT INTO tb_pertanyaan VALUES (NULL, '$id', '$id_konsumen', '$isi_pertanyaan', NULL)");
        if($query_insert){
            $_SESSION['success_msg']['add_pertanyaan'] = "Asking is successfully added!";
        }else{
            $_SESSION['error_msg']['add_pertanyaan'] = "failed to add Review";
    }
    echo "<script>setTimeout(function(){
            location.href= 'tanya.php?id=".$id."'},1000);
          </script>";
    }
  }
  if(isset($_SESSION['success_msg']['add_pertanyaan'])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
    <strong><?= $_SESSION['success_msg']['add_pertanyaan']?></strong>
    </div>
    <?php
  }else if(isset($_SESSION['error_msg']['add_pertanyaan'])){
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
    <strong><?= $_SESSION['error_msg']['add_pertanyaan']?></strong>
    </div>
<?php
  }
  unset($_SESSION['success_msg']['add_pertanyaan']);
  unset($_SESSION['error_msg']['add_pertanyaan']);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elektra Hardware <?= $_SESSION['user_login']['id_konsumen'] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-green fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Elektra Hardware</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="mx-auto">
          <form class="form-inline my-2 my-lg-0" method="GET">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
          <button class="btn my-2 my-sm-0" type="submit" >Search</button>
        </form>
        </div>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item active">
                <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <?php 
                if (isset($_SESSION['user_login'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php"><?=$_SESSION['user_login']['nama_konsumen']?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><span class="fa fa-shopping-cart"></span> Rp.<?=number_format($_SESSION['grand_total'])?></a>
                    </li>
                    <li class="nav-item">
                        <a href="admin/logout.php" class="nav-link">Logout</a>
                    </li>
                    <?php
                }
                else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Signup</a>
                    </li>
                    <?php
                }
                ?>
                    
                </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container w-100 h-100">
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center">
            <h2 class="h5 display">Ajukan pertanyaan</h2>
            </div>
            <div class="card-body">
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label">pertanyaan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="isi_pertanyaan" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="save_pertanyaan">Simpan pertanyaan</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
 
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>