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
    height: 200px;
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
      
      <div class="d-flex justify-content-around flex-row w-100 align-items-center">
        <img src="../img/sehati-removebg-preview.png" alt="" class=" animation1" style="width: 65px;">
        <a class="navbar-brand cfont2 border-bottom animation1 " href="../LandingPage.php">Apotek Sehati Farma</a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title cfont2" id="offcanvasNavbarLabel">Apotek Sehati Farma</h5>
            <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          
          <div class="sidebar flex-lg-row p-lg-0 offcanvas-body gap-4 d-flex flex-column justify-content-lg-end">
                  <a href="#menu" class="text-decoration-none text-black">Menu</a>
                  <a href="../LandingPage.php" class="text-decoration-none text-black">Log Out</a>
              </div>
            </div>
          </div>
        </nav>

  
  <div class="d-flex flex-column mt-5 animation1 vh-100 justify-content-lg-center" id="menu" >
    <h2 class="col- fw-bold text-center">MENU</h2>
    <div class="d-flex flex-row">
      <div class="col-sm-3 mb-3 mb-sm-0 mx-auto">
        <div class="card">
          <div class="card-body">
            <img src="../img/obat-removebg-preview.png" alt="" class="img-fluid">
          <h5 class="card-title text-center fw-bold">Beli Obat</h5>
        <p class="card-text fw-medium text-center">Silahkan menekan tombol di bawah untuk membeli obat</p>
          <a href="../menu/beliobat.php" class="btn btn-primary col-12 fw-semibold">Beli Obat Disini!</a>
        </div>
      </div>
    </div>
  <div class="col-sm-3 mx-auto">
    <div class="card">
      <div class="card-body">
          <img src="../img/apoteker-removebg-preview.png" alt="" class="img-fluid" style="width: 83%;">
        <h5 class="card-title text-center fw-bold">Konsultasi dengan Apoteker</h5>
          <p class="card-text fw-medium text-center">Silahkan menekan tombol di bawah untuk berkonsultasi</p>
        <a href="../menu/konsultasi.php" class="btn btn-primary col-12 fw-semibold">Konsultasi Disini!</a>
      </div>
    </div>
  </div>
</div>
</div>
</div>



    <script src="../bootstrap-5.3.0-dist/js/bootstrap.bundle.js"></script>
  </body>
</html>
