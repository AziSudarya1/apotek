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
      
<div class="d-flex justify-content-around flex-lg-row w-100">
  <img src="./img/sehati-removebg-preview.png" alt="" class=" animation1" style="width: 65px;">
  <a class="navbar-brand cfont2 border-bottom animation1 " href="#">Apotek Sehati Farma</a>
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
            <div class="dropdown d-flex flex-column">
              <a class="btn bg1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login Sebagai
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./login/loginAsPasien.php">Pasien</a></li>
                <li><a class="dropdown-item" href="./login/loginAsPemasok.php">Pemasok</a></li>
              </div>
            <div class="dropdown d-flex flex-column">
              <a class="btn bg1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sign Up Sebagai
              </a>
            
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./SignUp/signUpAsPasien.php">Pasien</a></li>
                <li><a class="dropdown-item" href="./SignUp/signUpAsPemasok.php">Pemasok</a></li>
            </div>
              </ul>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  </header>


<main>

        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
              <img src="./img/Desain tanpa judul (12).png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
              <img src="./img/Desain tanpa judul (10).png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
              <img src="./img/Desain tanpa judul (13).png" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>



  <div class="d-flex flex-column flex-lg-row  align-items-center vh-100 pt-5">
    <img src="img/landd.gif" alt="" class="iimg-fluid w-50" />
    <div class="align-self-center">
      <h4 class="fw-bold px-2">WELCOME TO APOTEK SEHATI FARMA</h4>
      <p style="text-align: justify;" class="px-3">
        Toko kesehatan yang menyediakan obat, layanan konsultasi, edukasi,
        produk kesehatan, dan pemeriksaan ringan, menjaga keamanan obat serta
        berkolaborasi dalam sistem perawatan kesehatan.
      </p>
    </div>
  </div>
</main>


    <script src="./bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

