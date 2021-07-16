<?php

  function add_location(){
    $con=mysqli_connect ("localhost", 'root', '','redping');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $location_id = $_GET['location'];
    $user_id = $_GET['user'];
    $time = $_GET['time'];
    // Inserts new row with place data.
    $query = sprintf("INSERT INTO my_pins " .
        " (location_id, user_id, time) " .
        " VALUES ('%s', '%s', '%s');",
        mysqli_real_escape_string($con, $location_id),
        mysqli_real_escape_string($con, $user_id),
        mysqli_real_escape_string($con, $time));

    $result = mysqli_query($con,$query);
    echo json_encode("Inserted Successfully");
    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
  }
  
  function get_saved_locations(){
    
    $con=mysqli_connect ("localhost", 'root', '','redping');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($con,"select longitude,latitude from locations ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
    $indexed = array_map('array_values', $rows);

    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
  }

  function readings(){
    
    $con=mysqli_connect ("localhost", 'root', '','redping');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($con,"select reading from readings ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
    $indexed = array_map('array_values', $rows);

    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
  }



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

  <style type="text/css">
    
    .marker {
      background-image: url('tower.png');
      background-size: cover;
      width: 40px;
      height: 40px;
      border-raduis: 50%;
      cursor:pointer;
    }
 
  </style>


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



  <div id='map' style='height:100%;width:100%;'></div>

  <div class="reading" style='
  position:absolute; 
  left: 650px; 
  top:80px; 
  width: 180px;
  height: 110px;
  background-color: white;
  '>
      <form action="" id="signupForm">
          <h5>Street</h5>
          <p>Readings: </p>
          <input type="hidden" id="lat" name="lat" >
          <input type="hidden" id="lng" name="lng">

          <input type="submit" value="Pin" >
      </form>
  </div>



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
  <!--<script src="mapbox.js" defer></script> -->


  <script type="text/javascript">


$(function(){
    $("#reading").hide();
    $("#").on("click", function(){
        $("#div1, #div2").toggle();
    });
});




        mapboxgl.accessToken = 'pk.eyJ1IjoidGhpZWYxMjMxOCIsImEiOiJja3B1azZkbW0xYnB5MnVxY3Fva3ZxN3liIn0.AtpmrQgGaofQmeNWyMTp2Q'


    navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
        enableHighAccuracy: true
    })

    function successLocation(position){
        console.log(position)
        //setupMap([position.coords.longitude, position.coords.latitude])
       setupMap([125.65980, 7.14931])
    }

    function errorLocation(){
        setupMap([125.65999,7.14931])
    }

    function setupMap(center){

       var saved_markers = <?= get_saved_locations() ?>;
     

        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: center,
        zoom: 17
        })

        var directions = new MapboxDirections({
          accessToken: mapboxgl.accessToken
        })

        var popup = new Array(saved_markers.length);

    
       var readings =  <?= readings() ?>;

        var counter = 1;
   

        for (let i = 0; i < saved_markers.length; i++) {
          popup[i] = new mapboxgl.Popup({ 
            offset: 20, 
            anchor: 'top-left', 
            closeButton: false, 
            focusAfterOpen: true,
            maxWidth: '55px',
            }).setText( 
            'Tower' + counter + "\n" + readings[i]
            );
            counter++;
        }
        

      
        

       map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');
     //  map.addControl(directions, 'bottom-left')


        for (let i = 0; i < saved_markers.length; i++) {
          var el = document.createElement('div');
          el.className = 'marker';
          var markerss = new mapboxgl.Marker(el)
           .setLngLat(saved_markers[i])
           .setPopup(popup[i],top) 
           .addTo(map)
        }

        markers.on('click', function (e) {
        window.alert('test');


        });


   
        
     
        


      



      }


  </script>



</body>

</html>