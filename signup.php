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
            <li class="active"><a href="#header">Home</a></li>
            <li class="disabled"><a href="#about">My pins</a></li>
            <li><a href="#services">Map</a></li>

            <li class="get-started"><a href="login.php">Log in</a></li>
          </ul>
        </nav><!-- .nav-menu -->
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

<?php
    include("authenticate.php");

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $user = $_POST['username'];
        $pass = $_POST['password'];

        if($user == "" || $pass == "" || $name == "" || $email == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
            echo "<br/>";
            echo "<a href='register.php'>Go back</a>";
        } else {
            mysqli_query($mysqli, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
            or die("Could not execute the insert query.");

            echo "Registration successfully";
            echo "<br/>";
            echo "<a href='login.php'>Login</a>";
        }
    } else {
?>
        <p><font size="+2">Register</font></p>
        <form name="form1" method="post" action="">
            <table width="75%" border="0">
                <tr>
                    <td width="10%">Full Name</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td> </td>
                    <td><input type="submit" name="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>




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
