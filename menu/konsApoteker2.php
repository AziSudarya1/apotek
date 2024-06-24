<?php


include '../configs/koneksi.php';

if (isset($_POST['kirim'])) {
    if (isset($_SESSION['id_pasien'])) {
        $id_pasien = $_SESSION['id_pasien'];

        $sakit_dirasakan = $_POST['sakit_dirasakan'];
        $obat_alert = "";

        switch ($sakit_dirasakan) {
            case 'sakit_kepala':
                $obat_alert = "Paramex";
                break;
            case 'sakit_pinggang':
                $obat_alert = "Oskadon Sp";
                break;
            case 'demam':
                $obat_alert = "Paracetamol";
                break;
            case 'sakit_maag':
                $obat_alert = "Promag";
                break;
            default:
                $obat_alert = "Obat tidak tersedia";
                break;
        }

      
        $id_apoteker = 2; 

        $query_update_pasien = "UPDATE pasien SET id_apoteker = ? WHERE id_pasien = ?";
        $stmt_update_pasien = $connect->prepare($query_update_pasien);
        $stmt_update_pasien->bind_param("ii", $id_apoteker, $id_pasien);

        if ($stmt_update_pasien->execute()) {
            echo "<script>alert('Silahkan membeli obat $obat_alert');</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data pasien.');</script>";
        }
    } else {
        echo "<script>alert('Sesi pasien tidak ditemukan.');</script>";
    }
}

$connect->close();
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
        background-image: white;
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
      

@media screen and (max-width: 768px) {
  .navbar-collapse{
    display: flex;
  }
  .navbar-expand-lg{
    height: 170px;
  }
  .d-flex{
    display: flex;
    flex-direction: column-reverse;
    margin-top: 90px;
    width: 100%;
  }
  .d-flex img{
    width: 100%;
  }
  .d-flex p{
    text-align: justify;
    font-size: 12px;
    padding: 0 12px 0 12px;
  }
  .d-flex h4{
    font-size: 12px;
    padding-left: 12px;
  }
}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg1">
      <div class="container-fluid">
        <img src="../img/sehati-removebg-preview.png" class="animation1" width="10%" srcset="" />
        <h5 class="fw-bold animation1">APOTEK SEHATI FARMA</h5>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a class="nav-link Active fw-medium" href="../menu/menuforuser.php">Back Menu</a>
              </li>
            <li class="nav-item">
                <a class="nav-link Active fw-medium" href="../menu/konsultasi.php">Back Menu Konsultasi</a>
              </li>
          </ul>
        </div>
      </div>
    </nav>  

    
    <div class="d-flex justify-content-center align-items-center vh-100">
    <form class="bg2 bg-gradient col-sm-6 col-md-5 container rounded-4 d-flex flex-column" method="POST">
    <div class="text-center py-4">
        <h5 class="fw-semibold">Sikahkan berkonsultasi😇</h5>
    </div>
    <div>
        <label for="exampleInputEmail1" class="form-label py-2">Sakit Yang Dirasakan</label>
        <select class="form-select" name="sakit_dirasakan">
            <option value="sakit_kepala">Sakit Kepala</option>
            <option value="sakit_pinggang">Sakit Pinggang</option>
            <option value="demam">Demam</option>
            <option value="skakit_maag">Sakit Maag</option>
        </select>
        <button type="submit" name="kirim" class="btn btn-primary my-3 col-12">Submit</button>
    </div>
</form>

    </div>
    

    <script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
