<?php
include '../configs/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_obat = $_POST["nama_obat"];
    $tanggal_transaksi = $_POST["date"];
    $jumlah_obat = $_POST["obat_jumlah"];

    // Periksa apakah sesi ID pasien tersedia
    if (isset($_SESSION['id_pasien'])) {
        $id_pasien = $_SESSION['id_pasien'];

        $sql_start = "BEGIN";
        if ($connect->query($sql_start) === TRUE) {
            $sql_get_obat = "SELECT kode_obat, harga, stok FROM obat WHERE nama_obat = ? ORDER BY kode_obat ASC LIMIT 1";
            $stmt_get_obat = $connect->prepare($sql_get_obat);
            $stmt_get_obat->bind_param("s", $nama_obat);
            $stmt_get_obat->execute();
            $result = $stmt_get_obat->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $kode_obat = $row['kode_obat'];
                $harga_obat = $row['harga'];
                $stok_obat = $row['stok'];

                if ($jumlah_obat > $stok_obat) {
                    echo "Maaf, stok obat tidak mencukupi untuk transaksi ini";
                } else {
                    $total_harga = $harga_obat * $jumlah_obat;

                    $sql_insert_transaksi = "INSERT INTO transaksi (id_pasien, obat_yang_dibeli, tanggal_transaksi, total_harga, jumlah) 
                                            VALUES (?, ?, ?, ?, ?)";
                    $stmt = $connect->prepare($sql_insert_transaksi);
                    $stmt->bind_param("iisdi", $id_pasien, $kode_obat, $tanggal_transaksi, $total_harga, $jumlah_obat);
                    
                    if ($stmt->execute()) {
                        // Perbarui kolom 'id_obat' pada pasien
                        $sql_update_pasien = "UPDATE pasien SET kode_obat = ? WHERE id_pasien = ?";
                        $stmt_update_pasien = $connect->prepare($sql_update_pasien);
                        $stmt_update_pasien->bind_param("ii", $kode_obat, $id_pasien);
                        
                        if ($stmt_update_pasien->execute()) {
                            $sql_update_obat = "UPDATE obat SET stok = stok - ? WHERE kode_obat = ?";
                            $stmt_update_obat = $connect->prepare($sql_update_obat);
                            $stmt_update_obat->bind_param("ii", $jumlah_obat, $kode_obat);
                            
                            if ($stmt_update_obat->execute()) {
                                $sql_commit = "COMMIT";
                                if ($connect->query($sql_commit) === TRUE) {
                                    echo '<script>alert("Data Berhasil Di masukan, silahkan untuk membayar!");</script>';
                                } else {
                                    echo "Error saat melakukan COMMIT: " . $connect->error;
                                }
                            } else {
                                echo "Error saat mengurangi stok obat: " . $connect->error;
                            }
                        } else {
                            echo "Error saat memperbarui id_obat pada pasien: " . $connect->error;
                        }
                    } else {
                        echo "Error saat memasukkan data transaksi: " . $connect->error;
                    }
                }
            } else {
                echo '<script>alert("Obat Tidak Ditemukan");</script>';
            }
        } else {
            echo "Error saat memulai transaksi: " . $connect->error;
        }

        $connect->close();
    } else {
        echo "Sesi ID pasien tidak tersedia.";
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


    @media screen and (max-width: 768px) {
      .navbar-collapse {
        display: flex;
      }

      .navbar-expand-lg {
        height: 170px;
      }

      .d-flex {
        display: flex;
        flex-direction: column-reverse;
        margin-top: 90px;
        width: 100%;
      }

      .d-flex img {
        width: 100%;
      }

      .d-flex p {
        text-align: justify;
        font-size: 12px;
        padding: 0 12px 0 12px;
      }

      .d-flex h4 {
        font-size: 12px;
        padding-left: 12px;
      }
    }
  </style>
</head>
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
      background-color: white;
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
      0%, 100% {
        transform: translateY(-5%);
      }
      50% {
        transform: translateY(0%);
      }
    }
    @media screen and (max-width: 768px) {
      .navbar-collapse {
        display: flex;
      }
      .navbar-expand-lg {
        height: 170px;
      }
      .d-flex {
        display: flex;
        flex-direction: column-reverse;
        margin-top: 90px;
        width: 100%;
      }
      .d-flex img {
        width: 100%;
      }
      .d-flex p {
        text-align: justify;
        font-size: 12px;
        padding: 0 12px 0 12px;
      }
      .d-flex h4 {
        font-size: 12px;
        padding-left: 12px;
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg cfont container">
  <div class="d-flex justify-content-around flex-row w-100 align-items-center">
    <img src="../img/sehati-removebg-preview.png" alt="" class="animation1" style="width: 65px;">
    <a class="navbar-brand cfont2 border-bottom animation1" href="../LandingPage.php">Apotek Sehati Farma</a>
    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title cfont2" id="offcanvasNavbarLabel">Apotek Sehati Farma</h5>
        <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="sidebar flex-lg-row p-lg-0 offcanvas-body d-flex flex-column justify-content-lg-end">
        <a href="../menu/beliobat.php" class="text-decoration-none text-black">Back Menu Obat</a>
      </div>
    </div>
  </div>
</nav>

<div class="d-flex justify-content-center align-items-center vh-100 pb-5">
  <form class="bg2 bg-gradient col-sm-6 col-md-5 container rounded-4 d-flex flex-column" method="POST">
    <input type="hidden" name="id_pasien" value="<?php echo isset($_SESSION['id_pasien']) ? $_SESSION['id_pasien'] : ''; ?>" />
    <div class="text-center py-4">
      <h5 class="fw-semibold">Silahkan Masukan Obat</h5>
    </div>
    <div>
      <label for="" class="form-label py-2">Nama Obat</label>
      <select class="form-select" name="nama_obat">
            <option value="sakit_kepala">Sakit Kepala</option>
            <option value="sakit_pinggang">Sakit Pinggang</option>
            <option value="demam">Demam</option>
            <option value="sakit_maag">Sakit Maag</option>
            <option value="sakit_mata">Sakit Mata</option>
        </select>
      <label for="" class="form-label py-2">Obat yang dibeli (jumlah)</label>
      <input class="form-control" type="text" name="obat_jumlah" />
      <label for="" class="form-label py-2">Tanggal Transaksi</label>
      <input class="form-control" type="date" name="date" />
      <button type="submit" name="kirim" class="btn btn-primary my-3 col-12">Submit</button>
    </div>
  </form>
</div>

<?php
if (isset($_POST["kirim"])) {
  // Menampilkan tabel transaksi
  echo '<div class="container mt-4 vh-100">
          <h4>Detail Transaksi:</h4>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>ID Pasien</th>
                      <th>Nama Obat</th>
                      <th>Jumlah Obat</th>
                      <th>Tanggal Transaksi</th>
                      <th>Total Harga</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>' . $id_pasien . '</td>
                      <td>' . $nama_obat . '</td>
                      <td>' . $jumlah_obat . '</td>
                      <td>' . $tanggal_transaksi . '</td>
                      <td>' . $total_harga . '</td>
                  </tr>
              </tbody>
          </table>
          <div class="mt-3">
              <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20membayar%20pesanan%20dengan%20ID%20Pasien%20' . $id_pasien . '" class="btn btn-success">Bayar via WhatsApp</a>
              <button class="btn btn-primary" onclick="showPaymentInstructions()">Instruksi Pembayaran</button>
          </div>
      </div>';

  // Tambahkan modal untuk instruksi pembayaran
  echo '<div class="modal fade" id="paymentInstructionsModal" tabindex="-1" aria-labelledby="paymentInstructionsModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="paymentInstructionsModalLabel">Instruksi Pembayaran</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <p>Berikut adalah instruksi pembayaran untuk pesanan Anda:</p>
                      <ol>
                          <li>Silahkan screenchot bukti transaksinya</li>
                          <li>Setelah di screenshot klik tombol bayar via Wa</li>
                          <li>pembayaran bisa melalui bank bjb, bank bni, dana dan Qris</li>
                      </ol>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>
              </div>
          </div>
      </div>';
}
?>

<script>
function showPaymentInstructions() {
  var myModal = new bootstrap.Modal(document.getElementById('paymentInstructionsModal'), {
    keyboard: false
  });
  myModal.show();
}
</script>

<script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
