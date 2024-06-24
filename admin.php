<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Apotek</title>
    <link
      rel="stylesheet"
      href="./bootstrap-5.3.0-dist/css/bootstrap.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

    <style>
      body {
        font-family: "montserrat";
        width: 100%;      
        background: white;
      }
      .jumbotron{
        height: 100vh;
        
      }
      .cfont{
        font-family: 'lato';
      }
      .cfont1{
        font-family: 'Great Vibes';
      }
      .bg1 {
        background-color: #adb5bd;
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


    .carousel-item.active {
      opacity: 1;
    }

    .carousel-item img {
      animation: zoomIn 6s ease-in-out;
    }


    @keyframes zoomIn {
      0% {
        transform: scale(1);
      }
      100% {
        transform: scale(1.1);
      }
    }
      

@media screen and (max-width: 768px) {

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

@media (max-width : 991px){
          .sidebar{
            background-color: #adb5bd;
            backdrop-filter: blur(5px);
          }
        }
    </style>
  </head>
  <body>
    

  <header>

    
  <nav class="navbar navbar-expand-lg cfont container">
      
      <div class="d-flex justify-content-around flex-lg-row w-100 align-items-center">
        <img src="../img/sehati-removebg-preview.png" alt="" class=" animation1" style="width: 65px;">
        <a class="navbar-brand cfont2 border-bottom animation1 " href="LandingPage.php">Apotek Sehati Farma</a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title cfont2" id="offcanvasNavbarLabel">Apotek Sehati Farma</h5>
            <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
            </div>
          </div>
        </nav>

  </header>


<main>
        <div class="d-flex vh-100 justify-content-center align-items-center">
          <div class="d-flex flex-column align-items-center gap-4 bg1 p-5 rounded-5 ">
            <h3 class=" border-bottom border-dark">Edit Data Apotek Sehati</h3>
            <div class="d-flex">
              <ul class="list-group list-group-flush">
                <li class="list-group-item bg1"><a href="./admin/editApoteker.php" class="text-white text-decoration-none hover-text">Edit data Apoteker</a></li>
                <li class="list-group-item bg1"><a href="./Admin/editObat.php" class="text-white text-decoration-none">Edit Data Obat</a></li>
                <li class="list-group-item bg1"><a href="./Admin/editPasien.php" class="text-white text-decoration-none">Edit Data Pasien</a></li>
                <li class="list-group-item bg1"><a href="./Admin/editPemasok.php" class="text-white text-decoration-none">Edit Data Pemasok</a></li>
                <li class="list-group-item bg1"><a href="./Admin/editTransaksi.php" class="text-white text-decoration-none">Edit Data Transaksi</a></li>
              </ul>
            </div>
          </div>
        </div>
</main>


    <script src="./bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

