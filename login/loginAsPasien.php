<?php


require_once("../configs/koneksi.php");

if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    
    $nama = mysqli_real_escape_string($connect, $nama);
    $password = mysqli_real_escape_string($connect, $password);
    


    
    $query = "SELECT * FROM pasien WHERE nama_pasien ='$nama'";

    $hasil = $connect->query($query);

    if ($hasil) {
        $data_pasien = $hasil->fetch_assoc();
        
        if ($data_pasien) {
          if ($password == $data_pasien['password']) { 
              $_SESSION['id_pasien'] = $data_pasien['id_pasien'];
              header("Location: ../menu/menuforuser.php");
              exit();
          } else {
              echo '<script>alert("Password salah, Silahkan coba lagi");</script>';
          }
      } else {
          echo '<script>alert("Data yang dimasukkan salah. Silakan coba lagi.");</script>';
      }
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
  <img src="../img/sehati-removebg-preview.png" class="animation1" width="10%" srcset="">
  <a class="navbar-brand cfont2 border-bottom" href="#">Apotek Sehati Farma</a>
  <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title cfont2" id="offcanvasNavbarLabel">Apotek Sehati Farma</h5>
      <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="sidebar flex-lg-row p-lg-0 offcanvas-body d-flex flex-column justify-content-lg-end">
          <ul class="navbar-nav d-flex gap-4">
              <li><a href="../LandingPage.php" class="text-dark text-decoration-none">Home</a></li>
          </ul>
    </div>
  </div>
</div>
</nav>
      <form class="mt-5 bg2 bg-gradient col-sm-6 col-md-3 container rounded-4" method="POST">
        <div class="text-center pt-4 pb-4">
          <h3 class="fw-semibold">LOGIN As Pasien</h4>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Nama Pasien</label>
          <input
          name="nama"
            type="text"
            class="form-control"
            id=""
            required
          />
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Password</label>
          <input
            name="password"
            type="password"
            class="form-control"
            id=""
            required
          />
        </div>
        <div class="mb-3">
          <p>Belum mempunyai akun? silahkan <a href="../SignUp/signUpAsPasien.php">Sign Up disini</a></p>
          <div class="row pb-4 ms-5 mx-5">
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

    <script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.js"></script>
  </body>
</html>
