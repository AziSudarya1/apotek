<?php
include '../configs/koneksi.php';

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $obat = $_POST['obat'];
    $tanggal = $_POST['tanggal'];
    $total = $_POST['total'];
    $pasien = $_POST['pasien'];

    if ($id) {
        // Update existing record
        $sql = "UPDATE transaksi SET obat_yang_dibeli='$obat', tanggal_transaksi='$tanggal', total_harga='$total', id_pasien='$pasien' WHERE id_Transaksi=$id";
    } else {
        // Create new record
        $sql = "INSERT INTO transaksi (obat_yang_dibeli, tanggal_transaksi, total_harga, id_pasien) VALUES ('$obat', '$tanggal', '$total', '$pasien')";
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
    $sql = "DELETE FROM transaksi WHERE id_Transaksi=$id";

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
    $result = $connect->query("SELECT * FROM transaksi WHERE id_Transaksi=$id");
    $edit = $result->fetch_assoc();
}

// Fetch all data
$result = $connect->query("SELECT * FROM transaksi");

// Fetch pasien data for dropdown
$pasien_result = $connect->query("SELECT id_pasien, nama_pasien FROM pasien");
$pasien_data = [];
while ($row = $pasien_result->fetch_assoc()) {
    $pasien_data[] = $row;
}

// Fetch obat data for dropdown and JavaScript
$obat_result = $connect->query("SELECT kode_obat, nama_obat, harga FROM obat");
$obat_data = [];
while ($row = $obat_result->fetch_assoc()) {
    $obat_data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Apotek</title>
    <link rel="stylesheet" href="../bootstrap-5.3.0-dist/css/bootstrap.min.css">
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
    <div class="d-flex justify-content-around flex-lg-row w-100 align-items-center">
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
                <a href="../admin.php" class="text-decoration-none text-black">Menu</a>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="mt-5">Data Transaksi</h2>

    <form method="post" class="mt-3">
        <input type="hidden" name="id" value="<?php echo $edit['id_Transaksi'] ?? ''; ?>">
        <div class="mb-3">
            <label class="form-label">Obat yang Dibeli</label>
            <select id="obat" name="obat" class="form-control" required>
                <option value="">Pilih Obat</option>
                <?php foreach ($obat_data as $obat): ?>
                    <option value="<?php echo $obat['kode_obat']; ?>" data-harga="<?php echo $obat['harga']; ?>" <?php echo isset($edit['obat_yang_dibeli']) && $edit['obat_yang_dibeli'] == $obat['kode_obat'] ? 'selected' : ''; ?>>
                        <?php echo $obat['nama_obat']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal" class="form-control" value="<?php echo $edit['tanggal_transaksi'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Obat</label>
            <input type="number" id="jumlah" name="jumlah" class="form-control" value="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="number" id="total" name="total" class="form-control" value="<?php echo $edit['total_harga'] ?? ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Pasien</label>
            <select name="pasien" class="form-control" required>
                <?php foreach ($pasien_data as $pasien): ?>
                    <option value="<?php echo $pasien['id_pasien']; ?>" <?php echo isset($edit['id_pasien']) && $edit['id_pasien'] == $pasien['id_pasien'] ? 'selected' : ''; ?>>
                        <?php echo $pasien['nama_pasien']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Obat yang Dibeli</th>
                <th>Tanggal Transaksi</th>
                <th>Jumlah Obat</th>
                <th>Total Harga</th>
                <th>Pasien</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_Transaksi']; ?></td>
                    <td><?php echo $row['obat_yang_dibeli']; ?></td>
                    <td><?php echo $row['tanggal_transaksi']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td><?php echo $row['total_harga']; ?></td>
                    <td><?php echo $row['id_pasien']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['id_Transaksi']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?php echo $row['id_Transaksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const obatSelect = document.getElementById('obat');
        const jumlahInput = document.getElementById('jumlah');
        const totalInput = document.getElementById('total');

        function updateTotal() {
            const selectedObat = obatSelect.options[obatSelect.selectedIndex];
            const harga = parseFloat(selectedObat.getAttribute('data-harga'));
            const jumlah = parseInt(jumlahInput.value);
            totalInput.value = harga * jumlah;
        }

        obatSelect.addEventListener('change', updateTotal);
        jumlahInput.addEventListener('input', updateTotal);
    });
</script>
</body>
</html>

<?php $connect->close(); ?>
