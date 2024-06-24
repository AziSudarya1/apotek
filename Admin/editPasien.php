<?php
include '../configs/koneksi.php';

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_apoteker = $_POST['id_apoteker'];
    $kode_obat = $_POST['kode_obat'];

    if ($id) {
        // mengupdate record baru (update)
        $sql = "UPDATE pasien SET nama_pasien='$nama', alamat='$alamat', tanggal_lahir='$tanggal_lahir', id_apoteker='$id_apoteker', kode_obat='$kode_obat' WHERE id_pasien=$id";
    } else {
        // membuat record baru (input)
        $sql = "INSERT INTO pasien (nama_pasien, alamat, tanggal_lahir, id_apoteker, kode_obat) VALUES ('$nama', '$alamat', '$tanggal_lahir', '$id_apoteker', '$kode_obat')";
    }

    if ($connect->query($sql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

// for Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM pasien WHERE id_pasien=$id";

    if ($connect->query($sql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . $connect->error;
    }
}

// menampilkan data untuk hasil edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $connect->query("SELECT * FROM pasien WHERE id_pasien=$id");
    $edit = $result->fetch_assoc();
}

// tampilkan all data (sesudah di update/delete)
$result = $connect->query("SELECT * FROM pasien");

// tampikan data for apoteker and obat (sesudah di update/delete)
$apoteker_result = $connect->query("SELECT * FROM apoteker");
$obat_result = $connect->query("SELECT * FROM obat");
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
        <h2 class="mt-5">Data Pasien</h2>

        <form method="post" class="mt-3">
            <input type="hidden" name="id" value="<?php echo $edit['id_pasien'] ?? ''; ?>">
            <div class="mb-3">
                <label class="form-label">Nama Pasien</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama_pasien'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo $edit['alamat'] ?? ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $edit['tanggal_lahir'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apoteker</label>
                <select name="id_apoteker" class="form-control" required>
                    <?php while ($row = $apoteker_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['id_apoteker']; ?>" <?php echo isset($edit['id_apoteker']) && $edit['id_apoteker'] == $row['id_apoteker'] ? 'selected' : ''; ?>>
                            <?php echo $row['nama_apoteker']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Obat</label>
                <select name="kode_obat" class="form-control" required>
                    <?php while ($row = $obat_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['kode_obat']; ?>" <?php echo isset($edit['kode_obat']) && $edit['kode_obat'] == $row['kode_obat'] ? 'selected' : ''; ?>>
                            <?php echo $row['nama_obat']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID Pasien</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Nama Apoteker</th>
                    <th>Nama Obat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_pasien']; ?></td>
                        <td><?php echo $row['nama_pasien']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['tanggal_lahir']; ?></td>
                        <td>
                            <?php
                            $apoteker = $connect->query("SELECT nama_apoteker FROM apoteker WHERE id_apoteker=" . $row['id_apoteker'])->fetch_assoc();
                            echo $apoteker['nama_apoteker'];
                            ?>
                        </td>
                        <td>
                            <?php
                            $obat = $connect->query("SELECT nama_obat FROM obat WHERE kode_obat=" . $row['kode_obat'])->fetch_assoc();
                            echo $obat['nama_obat'];
                            ?>
                        </td>
                        <td>
                            <a href="?edit=<?php echo $row['id_pasien']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=<?php echo $row['id_pasien']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
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
