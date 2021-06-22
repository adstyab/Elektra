<?php 
  require_once "./lib/config.php";
  if(!isset($_SESSION['user_login']))
    header('location: login.php');
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Info - Elektra Hardware</title>

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
          <form class="form-inline my-2 my-lg-0" method="GET" action="index.php">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
          <button class="btn my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div>
        <div class="collapse navbar-collapse" id="navbarResponsive">
           <ul class="navbar-nav ml-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><span class="fa fa-home"></span> Home
                <span class="sr-only">(current)</span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php"><span class="fa fa-laptop"></span> About</a>
                    </li>
                    <?php 
                        if (isset($_SESSION['user_login'])) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="info.php"><span class="fa fa-user"></span><?=$_SESSION['user_login']['nama_konsumen']?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php"><span class="fa fa-shopping-cart"></span> Rp. <?=number_format($_SESSION['grand_total'])?></a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/logout.php" class="nav-link"><span class="fa fa-sign-out"></span> Logout</a>
                            </li>
                            <?php
                        }
                        else{
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><span class="fa fa-user"></span> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php"><span class="fa fa-user"></span> Signup</a>
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
      <?php 
        if (!isset($_GET['action']) || !isset($_GET['id'])) {
          ?>
          <div class="row">
        <div class="col-lg-9 mx-auto">
          <br><br><br><br>
          <h1>Transaksi Saya</h1>
          <p>*Untuk melakukan transaksi silahkan transfer ke rekening kami 80398********* <br>lalu upload bukti pembayaran disini</p>
         <table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>#No</th>
            <th>Date</th>
            <th>Grand Total</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php 
            $id_konsumen = $_SESSION['user_login']['id_konsumen'];
            $query = $koneksi->query("SELECT * FROM tb_pembelian WHERE id_konsumen = $id_konsumen");
            $nomor =0;
            while ($data = $query->fetch_assoc()) {
              ?>
            <tr>
              <th scope="row">1</th>
              <td><?= $data['tgl_pembayaran']?></td>
              <td>Rp. <?= number_format($data['total'])?></td>
              <td><img src="product_image/payment/<?=$data['foto_bukti']?>" width="100px"></td>
              <td><?= $data['status']?></td>
              <td><a href="?action=detail&id=<?= $data['id_pembelian']?>">Detail Pembelian</a></td>
              <?php 
                if ($data['status'] != "Proses" && $data['status'] != "Lunas") {
                  ?>
                  <td><a href="bayar.php?action=hapus&id=<?=$data['id_pembelian']?>">Upload Bukti Pembayaran</a></td>
                  <?php
                }
               ?>
            </tr>
              <?php
            }
            if ($query->num_rows == 0) {
              ?>
              <tr>
                <td colspan="5" align="center">Tidak ada transaksi</td>
              </tr>
              <?php 
            }
           ?>
        </tbody>
      </table>


          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
          <?php
        }
        else if (isset($_GET['action']) && isset($_GET['id'])) {
          $idKonsumen = $_SESSION['user_login']['id_konsumen'];
          $getUser = $koneksi->query("SELECT * FROM tb_konsumen WHERE id_konsumen = '$idKonsumen'")->fetch_assoc();
         ?>
         <div class="row">
        <div class="col-lg-9 mx-auto pb-5">
          <br><br><br><br>
          <h1>Detail Pembelian</h1>
          <div class="card mb-5">
            <div class="card-body">
            <h5 class="card-title">Pesanan atas nama <?= $getUser['nama_lengkap'] ?></h5>
            <p class="card-text">No. Telp : <?= $getUser['no_telp'] ?> | Email : <?= $getUser['email'] ?></p>
            <p class="card-text">Alamat : <?= $getUser['alamat']?></p>
            <hr>
            <h5 class="card-title">Info Produk</h5>
            <?php 
              $id_pembelian = $_GET['id'];
              $query = $koneksi->query("SELECT * FROM tb_pembelian_produk INNER JOIN tb_pembelian ON tb_pembelian_produk.id_pembelian = tb_pembelian.id_pembelian INNER JOIN tb_produk ON tb_pembelian_produk.id_produk = tb_produk.id_produk INNER JOIN tb_jasa_pengiriman ON tb_pembelian.id_jasa = tb_jasa_pengiriman.id_jasa WHERE tb_pembelian_produk.id_pembelian = $id_pembelian");
              $nomor = 0; 
              $grand_total = 0;
              while ($data = $query->fetch_assoc()) {
                $grand_total = $data['total'];
                $Subtotal = $data['harga'] * $data['jml_pembelian'];
                ?>
                  <div class="card mb-3" style="max-width: 768px;">
                    <div class="row no-gutters">
                      <div class="col-md-3">
                        <img src="product_image/<?= $data['foto_produk'] ?>" class="card-img" alt="...">
                      </div>
                      <div class="col-md-9">
                        <div class="card-body">
                          <h5 class="card-title"><?= $data['nama_produk'] ?></h5>
                          <p class="card-text"><strong>Deskripsi : </strong><br><?= $data['deskripsi'] ?></p>
                          <p class="card-text"><small class="text-muted">Harga : Rp. <?= number_format($data['harga']) ?> | Qty : <?= $data['jml_pembelian'] ?></small></p>
                          <p class="card-text">Subtotal : Rp. <?= number_format($data['jml_pembelian'] * $data['harga']) ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php 
              }
              $getKurir = $koneksi->query("SELECT * FROM tb_pembelian INNER JOIN tb_jasa_pengiriman ON tb_pembelian.id_jasa = tb_jasa_pengiriman.id_jasa WHERE tb_pembelian.id_pembelian = $id_pembelian")->fetch_assoc();
            ?>
            </div>
            <div class="card-footer pb-1">
              <h5 class="card-title">Jasa Pengiriman : <?= $getKurir['nama_jasa'] ?> (Rp. <?= $getKurir['tarif'] ?>)</h5>
            </div>
          </div>
      <h4>Grand Total : Rp.<?= number_format($grand_total)?></h4>
      <a href="info.php"><button class="btn btn-primary">Back</button></a>  



          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
         <?php 
        }
       ?>
 
			
    </div>
    <!-- /.container -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
