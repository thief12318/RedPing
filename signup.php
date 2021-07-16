<?php 
include('db.php')
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RedPing</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet" />
  <script src="https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.js"></script>


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

        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li class="disabled"><a href="#about">My pins</a></li>
            <li><a href="map.php">Map</a></li>

            <li class="get-started"><a href="login.php">Log in</a></li>
          </ul>
        </nav><!-- .nav-menu -->
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="register" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      
    <form method="post" action="db.php">
      <?php include('errors.php'); ?>
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
      </div>
      <div class="input-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>">
      </div>
      <div class="input-group">
        <label>Middle Name</label>
        <input type="text" name="middle_name" value="<?php echo $middle_name; ?>">
      </div>
      <div class="input-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
      </div>

      <div class="input-group">
        <label>City</label>
        <input type="text" name="city" value="<?php echo $city; ?>">
      </div>
      <div class="input-group">
        <label>Province</label>
        <input type="text" name="province" value="<?php echo $province; ?>">
      </div>
      <div class="input-group">
        <label>Street</label>
        <input type="text" name="street" value="<?php echo $street; ?>">
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
      </div>
      <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>
      <p>
        Already a member? <a href="login.php">Sign in</a>
      </p>
    </form>


    </div>
  </section><!-- End Hero -->

 


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

</body>

</html>