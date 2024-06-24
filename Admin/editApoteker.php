<?php
include '../configs/koneksi.php';

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'];
    $pass = $_POST['password'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $pend_terakhir = $_POST['pend_terakhir'];

    if ($id) {
        // Update existing record
        $sql = "UPDATE apoteker SET nama_apoteker='$nama', password='$pass', alamat='$alamat', jabatan='$jabatan', pend_terakhir='$pend_terakhir' WHERE id_apoteker=$id";
    } else {
        // Create new record
        $sql = "INSERT INTO apoteker (nama_apoteker, password, alamat, jabatan, pend_terakhir) VALUES ('$nama', '$pass', '$alamat', '$jabatan', '$pend_terakhir')";
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
    $id = $_GET['delete'];
    $sql = "DELETE FROM apoteker WHERE id_apoteker=$id";

    if ($connect->query($sql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . $connect->error;
    }
}

// Fetch data for editing
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $connect->query("SELECT * FROM apoteker WHERE id_apoteker=$id");
    $edit = $result->fetch_assoc();
}

// tampilkan all data
$result = $connect->query("SELECT * FROM apoteker");
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
    <h2 class="mt-5">Data Apoteker</h2>

    <form method="post" class="mt-3">
        <input type="hidden" name="id" value="<?php echo $edit['id_apoteker'] ?? ''; ?>">
        <div class="form-group">
            <label>Nama Apoteker</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama_apoteker'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control" value="<?php echo $edit['password'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?php echo $edit['alamat'] ?? ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?php echo $edit['jabatan'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Pendidikan Terakhir</label>
            <input type="text" name="pend_terakhir" class="form-control" value="<?php echo $edit['pend_terakhir'] ?? ''; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Apoteker</th>
                <th>Nama Apoteker</th>
                <th>Password</th>
                <th>Alamat</th>
                <th>Jabatan</th>
                <th>Pendidikan Terakhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_apoteker']; ?></td>
                    <td><?php echo $row['nama_apoteker']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><?php echo $row['pend_terakhir']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['id_apoteker']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?php echo $row['id_apoteker']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
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