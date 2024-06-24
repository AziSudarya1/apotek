<?php
include '../configs/koneksi.php';
$id_pemasok = $_SESSION['id_pemasok'];

// Menambahkan obat baru
if(isset($_POST['kirim'])) {
    $nama_obat = $_POST['nama_obat'];
    $stok_obat = $_POST['stok_obat'];
    $harga_obat = $_POST['harga_obat'];

    $query_check_obat = "SELECT * FROM obat WHERE nama_obat = ?";
    $stmt_check_obat = $connect->prepare($query_check_obat);
    $stmt_check_obat->bind_param("s", $nama_obat);
    $stmt_check_obat->execute();
    $result = $stmt_check_obat->get_result();

    if ($result->num_rows > 0) {
        $query_update_stok = "UPDATE obat SET stok = stok + ? WHERE nama_obat = ?";
        $stmt_update_stok = $connect->prepare($query_update_stok);
        $stmt_update_stok->bind_param("is", $stok_obat, $nama_obat);
        if ($stmt_update_stok->execute()) {
            echo '<script>alert("Stok obat berhasil diperbarui.");</script>';
        } else {
            echo '<script>alert("Gagal memperbarui stok obat.");</script>';
        }
    } else {
        $query_insert_obat = "INSERT INTO obat (nama_obat, stok, harga, id_pemasok) VALUES (?, ?, ?, ?)";
        $stmt_insert_obat = $connect->prepare($query_insert_obat);
        $stmt_insert_obat->bind_param("siii", $nama_obat, $stok_obat, $harga_obat, $id_pemasok);
        if ($stmt_insert_obat->execute()) {
            echo '<script>alert("Obat baru berhasil ditambahkan.");</script>';
        } else {
            echo '<script>alert("Gagal menambahkan obat baru.");</script>';
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
    <div class="d-flex justify-content-around flex-lg-row w-100 align-items-center">
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
                <a href="../LandingPage.php" class="text-decoration-none text-black">Log Out</a>
            </div>
        </div>
    </div>
</nav>

<div class="d-flex justify-content-center align-items-center vh-100">
    <form class="bg2 bg-gradient col-sm-6 col-md-5 container rounded-4 d-flex flex-column" method="POST">
        <div class="text-center py-4">
            <h5 class="fw-semibold">Silahkan Masukan Obat</h5>
        </div>
        <div>
            <label for="exampleInputEmail1" class="form-label py-2">Nama Obat</label>
            <input class="form-control" name="nama_obat" />
            <label for="exampleInputEmail1" class="form-label py-2">Harga Obat</label>
            <input class="form-control" name="harga_obat" />
            <label for="exampleInputEmail1" class="form-label py-2">Stok</label>
            <input class="form-control" name="stok_obat" />
            <button type="submit" name="kirim" class="btn btn-primary my-3 col-12">Submit</button>
        </div>
    </form>
</div>

<div class="container mt-5">
    <h2>Data Obat</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>ID Pemasok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM obat";
            $result = $connect->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['kode_obat']}</td>
                        <td>{$row['nama_obat']}</td>
                        <td>{$row['stok']}</td>
                        <td>{$row['harga']}</td>
                        <td>{$row['id_pemasok']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data obat.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
