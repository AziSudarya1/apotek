<?php

  require_once("../configs/koneksi.php");

  if (isset($_POST['register']))
  {

      $nama = $_POST ['nama'];
      $password = $_POST ['password']; 
      $contact = $_POST ['contact']; 
      $alamat = $_POST ['alamat']; 


      $query = "INSERT INTO pemasok (nama_pemasok, password, kontak_pemasok, alamat) VALUES 
      ('$nama', '$password', '$contact', '$alamat')";
  
      $hasil = $connect->query($query);

      if ($hasil){
          header("Location: ../login/loginAsPemasok.php");
      }

  }

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Apotek</title>
    <link
      rel="stylesheet"
      href="../bootstrap-5.3.0-dist/css/bootstrap.min.css"
    />

    <style>
      body {
        font-family: "montserrat";
        height: 100vh;
        width: 100%;
        background-image: linear-gradient(to bottom, #adb5bd, #343a40);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
      }
      .bg1 {
        background-color: #adb5bd;
        height: 100px;
      }
      .bg2 {
        background-color: #adb5bd;
      }
      .animation1{
        animation: naikTurun 2s infinite;
      }
      @keyframes naikTurun {
        0%, 100% { 
          transform: translateY(-5%); 		
          }
          50% { 
          transform: translateY(0%); 
          }
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg cfont d-flex container">

    <div class="d-flex flex-column flex-lg-row align-items-center w-100">
      <a class="navbar-brand cfont2 border-bottom border-dark animation1" href="../LandingPage.php">Apotek Sehati Farma</a>
      </div>
    </div>
</nav>

      <form class="mt-5 bg2 bg-gradient col-sm-6 col-md-3 container rounded-4" method="POST">
        <div class="text-center pt-4 pb-4">
          <h3 class="fw-semibold">Sign Up AS Pemasok</h4>
        </div>
          <label for="" class="form-label">Nama Pemasok</label>
          <input
            name="nama"
            type="text"
            class="form-control"
            required
          />
          <label for="" class="form-label">Password</label>
          <input
            name="password"
            type="password"
            class="form-control"
            required
          />
          <label for="" class="form-label">Kontak Pemasok</label>
          <input
            name="contact"
            type="text"
            class="form-control"
            required
          />
        <div class="mb-3">
          <label for="" class="form-label">Alamat</label>
          <input
            name="alamat"
            type="text"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <p>Sudah mempunyai akun? silahkan <a href="../login/loginAsPemasok.php">Login disini</a></p>
          <div class="row pb-4 ms-5 mx-5">
            <button type="submit" name="register" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

    <script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.js"></script>
  </body>
</html>
