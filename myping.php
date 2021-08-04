<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'redping';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, first_name FROM user WHERE user_id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($password, $first_name);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
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
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body class="loggedin" id="hero" class="d-flex align-items-center">

          <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center">
        <div class="logo mr-auto">      
          <h1 class="text-light"><a href="index.php"><span>RedPing</span></a></h1>
        </div>
        <?php if(isset($_SESSION['loggedin'])) { ?>
        
        <nav class="nav-menu d-none d-lg-block">
            
          <ul>
           <li class="active" style="margin-right: 37vw; padding-left: 10px"> <p>Hello, <?=$_SESSION['name']?>!</p> </li>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="map.php">Map</a></li>
            <li class="active"><a href="mypin.php">My Pings</a></li>
            <li class="get-started"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
          </ul>
        </nav><!-- .nav-menu -->
        <?php } else{ ?>

         <nav class="nav-menu d-none d-lg-block">

          <ul>
            <li  class="active"><a href="index.php">Home</a></li>
            <li class="active"><a href="map.php">Map</a></li>
            <li style=" @media (max-width: 768px) { margin: 20px;}" class="get-started"><a href="login.php"><i class="fas fa-sign-out-alt"></i>Log In</a></li>
            <li style=" @media (max-width: 768px) { margin: 20px;}" class="get-started"><a href="signup.php"><i class="fas fa-sign-out-alt"></i>Sign Up</a></li>
          </ul>
        </nav><!-- .nav-menu -->
        <?php } ?>






      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

         <div class="content" style=" background-color: white; color: black;  position: absolute; width: 80%; margin-left: 10%; margin-top: 15%; padding: 30px">
            <p>My Pings</p>
            <div>
             
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><?=$_SESSION['name']?></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><?=$password?></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?=$first_name?></td>
                    </tr>
                </table>
            </div>
        </div>

 
          <!-- The core Firebase JS SDK is always required and must be listed first -->
        <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyB29s8bQq_JYV77GLhp6dQ8Qyenjo7iDf0",
    authDomain: "redping-2d6f3.firebaseapp.com",
    projectId: "redping-2d6f3",
    storageBucket: "redping-2d6f3.appspot.com",
    messagingSenderId: "5242866335",
    appId: "1:5242866335:web:13ceaa2499ec7c646f70aa",
    measurementId: "G-6RTZ5K249S"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
    </body>
</html>
