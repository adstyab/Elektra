<?php 
  require_once 'lib/config.php';
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query_produk = $koneksi->query("SELECT * FROM tb_produk INNER JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori WHERE tb_produk.id_produk = $id");
    if($query_produk->num_rows > 0){
      $data_produk = $query_produk->fetch_assoc();
    }
    else{
      header('location: index.php');
    }
  }
  else{
    header('location: index.php');
  }
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elektra Hardware</title>

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
                                <a href="logout.php" class="nav-link">Logout</a>
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
    <div class="container">

      <div class="row">

        <div class="col-lg-3">
        	<br>
          <img src="./product_image/<?=$data_produk['foto_produk']?>" width="100%">
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
          <br><br>
       	<h3><?=$data_produk['nama_produk']?></h3>
       	<a href="index.php?category=<?=$data_produk['id_kategori']?>"><h6><?=$data_produk['nama_kategori']?></h6></a>
       	<div class="row">
       		<div class="col-md-8">
           <strong>Deskripsi : </strong>
       		<p><?=$data_produk['deskripsi']?></p>
       	</div>
       	</div>
       <strong>	<p style="color:#33b35a">Rp.<?= number_format($data_produk['harga'])?></p></strong>
       <form action="beli.php?id=<?=$data_produk['id_produk']?>" method="post" class="d-inline">
            <strong>stok : </strong>
            <input type="number" name="qty" min="1" max="<?=  $data_produk['stok'] ?>">
            <button type="submit" class="btn btn-primary">Add to cart</button>
       </form>
       <a href="ulasan.php?id=<?=$data_produk['id_produk']?>"><button class="btn btn-primary">Beri Ulasan</button></a>
       <a href="tanya.php?id=<?=$data_produk['id_produk']?>"><button class="btn btn-primary">Tanyakan Produk</button></a>
       <a href="index.php"> <button class="btn btn-secondary">Continue Shopping</button></a>
   </div>
</div>
   		<hr>
   		 <h3 class="mt-lg-5">Product Lainnya</h3>
          <div class="row">
              <?php 
                $query_lainnya = $koneksi->query("SELECT * FROM tb_produk ORDER BY RAND() LIMIT 4");
                if($query_lainnya->num_rows>0){
                  while($data_lainnya = $query_lainnya->fetch_assoc()){
                    ?> <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card h-100">
                          <!-- 700 x 400 -->
                          <a href=""><img class="card-img-top" src="./product_image/<?=$data_lainnya['foto_produk']?>" alt=""></a>
                          <div class="card-body">
                            <h4 class="card-title">
                              <a href="detail.php?id=<?=$data_produk['id_produk']?>" style="font-size:0.6em"><?=$data_lainnya['nama_produk']?></a>
                            </h4>
                            <h5 style="font-size:0.8em">Rp.<?=number_format($data_lainnya['harga'])?></h5>
                            <a href="beli.php?id=<?=$data_lainnya['id_produk']?>"><button class="btn btn-success btn-sm mt-lg-2">Add to cart</button></a>
                            <a href="detail.php?id=<?=$data_lainnya['id_produk']?>"><button class="btn btn-primary mt-lg-2 btn-sm">Detail</button></a>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted"><?=$data_lainnya['stok']?></small>
                          </div>
                        </div>
                      </div>
                <?php
                  }
                }
                else{

                }
              ?>
                     
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->
        <div class="container pb-5">
        <hr>
          <h3 class="pb-2">Pertanyaan</h3>
          <?php   
              $id = $_GET['id'];
              $getName = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk = $id");
              $dataName = $getName->fetch_assoc();
              $query_pertanyaan= $koneksi->query("SELECT * FROM tb_pertanyaan INNER JOIN tb_produk ON tb_pertanyaan.id_produk = tb_produk.id_produk INNER JOIN tb_konsumen ON tb_pertanyaan.id_konsumen = tb_konsumen.id_konsumen ");
              if($query_pertanyaan->num_rows > 0){
                  $nomor = 1;
                  while($data_pertanyaan = $query_pertanyaan->fetch_assoc()){
                      // var_dump($data_ulasan['nama_ulasan']);
                      ?>
                        <div class="card">
                          <div class="card-body">
                            <h6><strong><i class="fa fa-user-circle pr-2"></i><?= $data_pertanyaan['nama_lengkap'] ?></strong></h6>
                            <p><?= $data_pertanyaan['isi'] ?></p>
                          </div>
                          <div class="card-footer pb-1">
                            <strong>Balasan dari Admin : </strong>
                            <p><?= $data_pertanyaan['balas'] ?></p>
                          </div>
                        </div>                        
                      <?php
                      $nomor++;
                  }
              }else if($query_pertanyaan->num_rows == 0){
                  ?>
                      <td colspan="3" class="text-center">
                      <h1>Tidak Ada Pertanyaan</h1>
                      </td>
                  <?php
              }
          ?>
        </div>


        <div class="container pb-5">
        <hr>
          <h3 class="pb-2">Ulasan</h3>
          <?php   
              $id = $_GET['id'];
              $getName = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk = $id");
              $dataName = $getName->fetch_assoc();
              $query_ulasan= $koneksi->query("SELECT * FROM tb_ulasan INNER JOIN tb_produk ON tb_ulasan.id_produk = tb_produk.id_produk INNER JOIN tb_konsumen ON tb_ulasan.id_konsumen = tb_konsumen.id_konsumen");
              if($query_ulasan->num_rows > 0){
                  $nomor = 1;
                  while($data_ulasan = $query_ulasan->fetch_assoc()){
                      // var_dump($data_ulasan['nama_ulasan']);
                      ?>
                        <div class="card">
                          <div class="card-body">
                            <h6><strong><i class="fa fa-user-circle pr-2"></i><?= $data_ulasan['nama_lengkap'] ?></strong></h6>
                            <p><?= $data_ulasan['isi'] ?></p>
                          </div>
                          <div class="card-footer pb-1">
                            <strong>Rating : <?= $data_ulasan['rating'] ?> dari 5</strong>
                          </div>
                        </div>                        
                      <?php
                      $nomor++;
                  }
              }else if($query_ulasan->num_rows == 0){
                  ?>
                      <td colspan="3" class="text-center">
                      <h1>Tidak Ada Ulasan</h1>
                      </td>
                  <?php
              }
          ?>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Footer -->
 
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
