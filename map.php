<?php

session_start();

include 'mapdb.php';

  


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

  <div class="reading" id='reading' style='
  position:absolute; 
  left: 800px; 
  top:80px; 
  width: 220px;
  height: 180px;
  background-color: white;
  '>  <h5><span id="streets"></span></h5>
          <p>Reading: <span id="readings"></span></p>


      <form action="" id="signupForm">     
         
          <input type="hidden" id="location" name="location">
          <input type="hidden" id="user" name="user" value="<?php echo  $_SESSION['user_id']; ?>">
          
          <div class="time_pin1" id='time_pin1'>
              
          <span>Select time:</span>
          <select id="time1">
            <?php for($x = 0 ;$x <  12; $x++){ ?>
              <option value="<?php echo $x + 1; ?>"><?php echo $x + 1;?></option>
            <?php } ?>
          </select>
          <select id="time2">
            <option value="0" >AM</option>
            <option value="120000">PM</option>
          </select>

            </div>

          <div class="time_pin2" id='time_pin2'>
          <span>Selected time:</span>
          <span id="time_span1"></span>

            </div>

            <input type="hidden" id="determine" name="determine">
          <input type="submit" id="pin" value="Pin" >
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
       var saved_streets = <?= streets() ?>;
       var readings =  <?= readings() ?>;
       var location_id =  <?= get_location_id() ?>;
       var location_id_pin = <?= get_location_id_pin() ?>;
       var user_id_pin = <?= get_user_id_pin() ?>;
      var user = <?php if(isset($_SESSION['loggedin'])) {echo $_SESSION['user_id'];}else{ echo 0;} ?>;
      var time_pin = <?= get_time_pin() ?>;
     

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
        var markers = new Array(saved_markers.length);
        
    
      

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
  
        

      
          var der = 0;

       map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');
     //  map.addControl(directions, 'bottom-left')


        for (let i = 0; i < saved_markers.length; i++) {
          var el = document.createElement('div');
          el.className = 'marker';
          var change = 0;
          for (let y = 0; y < location_id_pin.length; y++){
              if(Number(location_id[i]) ==  Number(location_id_pin[y]) && Number(user_id_pin[y]) == user){
              change = 1;
              }
          }
          if(change == 0){
          markers[i] = new mapboxgl.Marker(el)
          .setLngLat(saved_markers[i])
                .setPopup(popup[i],top) 
                .addTo(map);
           
          }else{
            markers[i] = new mapboxgl.Marker()
            .setLngLat(saved_markers[i])
                .setPopup(popup[i],top) 
                .addTo(map);
           
          }    
          
         
           markers[i].getElement().addEventListener('click', () => {
            //var lngLat = markers[i].getLngLat();
            
            der = 1;

            document.getElementById("streets").innerHTML = saved_streets[i];
            document.getElementById("readings").innerHTML = readings[i];
            document.getElementById("location").value = location_id[i];
           
            
          //  document.getElementById("lat").value = lngLat.lat;
           // document.getElementById("lng").value = lngLat.lng;
        
            for (let x = 0; x < location_id_pin.length; x++){
              if(Number(location_id[i]) ==  Number(location_id_pin[x]) && Number(user_id_pin[x]) == user){
                document.getElementById("pin").value = "Remove";
                document.getElementById("time_span1").innerHTML = time_pin[x];
                document.getElementById("determine").value = 1;
                $("#time_pin1").hide();
                $("#time_pin2").show();
               
                break;
              }else{
                document.getElementById("determine").value = 2;
                $("#time_pin1").show();
                $("#time_pin2").hide();
                document.getElementById("pin").value = "Pin";
               
              
              }
            }
           
            
        });
        


        
        }


      
        
        map.on('load', function() {
        // window.alert(location_id);
      
        });
        
        map.on('click', function (e) {
          //  $("#reading").show();
          
            if(der == 0){
              $("#reading").hide();
            }else{
              $("#reading").show();
              der = 0;
            }

        });

        $('#signupForm').submit(function(event){
          event.preventDefault();
          if($('#determine').val() == 2){
            <?php if(isset($_SESSION['loggedin'])) { ?>
              
              var location_id = $('#location').val();
              var user_id = $('#user').val();
              var time1 = $('#time1').val();
              var time2 = $('#time2').val();

              var url = 'mapdb.php?add_location&location=' + location_id 
              + '&user=' + user_id + '&time1=' + time1
              +  '&time2=' + time2;
              $.ajax({
                  url: url,
                  method: 'GET',
                  dataType: 'json',
                  success: function(data){
                      alert(data);
                      location.reload();
                  }
                
              });
            <?php  }else{ ?> alert("You need to loggin first!");  <?php } ?> 
          }else{
       
            var location_id = $('#location').val();
            var user_id = $('#user').val();
            var url = 'mapdb.php?del_location&location=' + location_id 
              + '&user=' + user_id;
              $.ajax({
                  url: url,
                  method: 'GET',
                  dataType: 'json',
                  success: function(data){
                      alert(data);
                      location.reload();
                  }
                
              });
            
          }
        });
        
      }

  </script>



</body>

</html>