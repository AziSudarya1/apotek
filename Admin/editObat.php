<?php
include '../configs/koneksi.php';

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode'] ?? null;
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Check if obat sudah ada dengan menggunakan atribut name
    $check_query = "SELECT * FROM obat WHERE nama_obat='$nama'";
    $check_result = $connect->query($check_query);

    if ($check_result->num_rows > 0) {
        // jika obat nama sudah ada maka, update stok only
        $existing_obat = $check_result->fetch_assoc();
        $new_stok = $existing_obat['stok'] + $stok;

        $sql = "UPDATE obat SET stok='$new_stok' WHERE kode_obat=" . $existing_obat['kode_obat'];
    } else {
        // Create new record
        $sql = "INSERT INTO obat (nama_obat, harga, stok) VALUES ('$nama', '$harga', '$stok')";
    }

    if ($connect->query($sql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $kode = $_GET['delete'];
    $sql = "DELETE FROM obat WHERE kode_obat=$kode";

    if ($connect->query($sql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . $connect->error;
    }
}

// Fetch data untuk editing
$edit = null;
if (isset($_GET['edit'])) {
    $kode = $_GET['edit'];
    $result = $connect->query("SELECT * FROM obat WHERE kode_obat=$kode");
    $edit = $result->fetch_assoc();
}

// Fetch semua data
$result = $connect->query("SELECT * FROM obat");
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
  <nav class="navbar navbar-expand-lg cfont container">
      
      <div class="d-flex justify-content-around flex-lg-row w-100 align-items-center">
        <a class="navbar-brand cfont2 border-bottom animation1 " href="../LandingPage.php">Apotek Sehati Farma</a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title cfont2" id="offcanvasNavbarLabel">Apotek Sehati Farma</h5>
            <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          
          <div class="sidebar flex-lg-row p-lg-0 offcanvas-body d-flex flex-column justify-content-lg-end">
                  <a href="../admin.php" class="text-decoration-none text-black">Menu</a>
              </div>
            </div>
          </div>
        </nav>
 

    
        <div class="container">
        <h2 class="mt-5">Data Obat</h2>

        <form method="post" class="mt-3">
            <input type="hidden" name="kode" value="<?php echo $edit['kode_obat'] ?? ''; ?>">
            <div class="mb-3">
                <label class="form-label">Nama Obat</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama_obat'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?php echo $edit['harga'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?php echo $edit['stok'] ?? ''; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['kode_obat']; ?></td>
                        <td><?php echo $row['nama_obat']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td>
                            <a href="?edit=<?php echo $row['kode_obat']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=<?php echo $row['kode_obat']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php $connect->close(); ?>