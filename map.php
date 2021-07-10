

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">

  <title>RedPing</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="rp144.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">






  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <link rel="manifest"  href="manifest.json">
  <meta name="theme-color" content="#ffffff">
  <link rel="apple-touch-icon"  href="rp144.png">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center">
        <div class="logo mr-auto">
          <h1 class="text-light"><a href="index.php"><span>RedPing</span></a></h1>

        </div>

       <?php if(isset($_SESSION['loggedin'])) { ?>

        <nav class="nav-menu d-none d-lg-block">
             <p>&nbsp;&nbsp;&nbsp;&nbsp;Hello, <?=$_SESSION['name']?>!</p>
          <ul>

            <li class="active"><a href="#header">Home</a></li>
            <li class="active"><a href="profile.php">My pins</a></li>
            <li><a href="map.php">Map</a></li>
            <li class="get-started"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
          </ul>
        </nav><!-- .nav-menu -->
        <?php } else{ ?>

         <nav class="nav-menu d-none d-lg-block">

          <ul>

            <li class="active"><a href="#header">Home</a></li>
            <li class="active"><a href="profile.php">My pins</a></li>
            <li><a href="map.php">Map</a></li>
            <li class="get-started"><a href="login.php"><i class="fas fa-sign-out-alt"></i>Log In</a></li>
             <li class="get-started"><a href="signup.php"><i class="fas fa-sign-out-alt"></i>Sign Up</a></li>
          </ul>
        </nav><!-- .nav-menu -->
        <?php } ?><!-- .nav-menu -->
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

  <div id='map' style='width: 100%; height: 100%;'></div>




  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="mapbox.js" defer></script>



</body>

</html>
