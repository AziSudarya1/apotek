<?php


require_once("../configs/koneksi.php");

if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    
    $nama = mysqli_real_escape_string($connect, $nama);
    $password = mysqli_real_escape_string($connect, $password);
    


    
    $query = "SELECT * FROM pemasok WHERE nama_pemasok ='$nama'";

    $hasil = $connect->query($query);

    if ($hasil) {
        $data_pemasok = $hasil->fetch_assoc();

        
        if ($data_pemasok) {
          if ($password == $data_pemasok['password']) {
              $_SESSION['id_pemasok'] = $data_pemasok['id_pemasok'];
              header("Location: ../menu/pemasok.php");
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
  <link rel="stylesheet" href="../bootstrap-5.3.0-dist/css/bootstrap.min.css" />

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

    .animation1 {
      animation: naikTurun 2s infinite;
    }

    @keyframes naikTurun {

      0%,
      100% {
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
      <h3 class="fw-semibold">LOGIN As Pemasok</h4>
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Nama Pemasok</label>
      <input name="nama" type="text" class="form-control" id="" required />
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Password</label>
      <input name="password" type="password" class="form-control" id="" required />
    </div>
    <div class="mb-3">
      <p>Belum mempunyai akun? silahkan <a href="../SignUp/signUpAsPemasok.php">Sign Up disini</a></p>
      <div class="row pb-4 ms-5 mx-5">
        <button type="submit" name="login" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>


  <script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.js"></script>
</body>

</html>