<?php

session_start();

include 'mapdb.php';
include 'fetch.php';
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

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


  <!-- Mao ning maka guba sa font, need ni sya para sa glyphicons bell icon -->
    
  <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>







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
      border-radius: 50%;
      cursor:pointer;
    }
 
  </style>


</head>

<body onload="realtimeClock()">

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
            <li class="active" style="margin-right: 28vw; padding-left: 0px"> <p>Hello, <?=$_SESSION['name']?>!</p>
            <div class="active"  id="clock"></div> </li>
            <li class="active"><a href="index.php">Home</a></li>
            <li class="active"> <a href="map.php">Map</a></li>
            <li class="get-started"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> 
      <span class="iconify" data-icon="il:bell" data-width="20" data-height="22"></span></a>
      <ul class="dropdown-menu"></ul>
     </li>
          </ul>



  
          
     

        </nav><!-- .nav-menu -->
        <?php } else{ ?>

         <nav class="nav-menu d-none d-lg-block">
          <ul>
            <div id="clock"></div>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="map.php">Map</a></li>
            <li class="get-started"><a href="login.php"><i class="fas fa-sign-out-alt"></i>Log In</a></li>
            <li class="get-started"><a href="signup.php"><i class="fas fa-sign-out-alt"></i>Sign Up</a></li>
            
          </ul>
        </nav><!-- .nav-menu -->
        <?php } ?><!-- .nav-menu -->
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->



   <?php if(isset($_SESSION['loggedin'])) { ?>

  <div id='map' style='height:100%;width:100%;'></div>

  <div class="reading" id='reading' style='
  position:absolute; 
  text-align: center;
  left: 800px; 
  top:100px; 
  width: auto;
  height: auto;
  background-color: darkred;
  color: white;
  margin-top: 30px;
  padding: 15px;
  border-radius: 8px;
  '>  <h5><span id="streets"></span></h5>
          <p>Flood level: <span id="readings"></span> cm.</p>
          <p>Updated on <span id="date_time"></span></p>
          <span id="wading"></span>


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
          <select id="time3">
            <?php for($x = 0 ;$x <  60; $x++){ ?>
              <option value="<?php echo $x; ?>"><?php echo $x;?></option>
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
          <input style="margin-top: 10px; margin-bottom: 10px; border-radius: 5px" type="submit" id="pin" value="Pin" >


      </form>
 
  </div>



                            

  <div class="notif" id='notif' style='
  position:absolute; 
  text-align: center;
  left: 1500px; 
  top:780px; 
  width: auto;
  height: auto;
  background-color: darkred;
  color: white;
  margin-top: 20px;
  padding: 25px;
  border-radius: 8px;
  '>  <h2><span id="notif_location"></span></h2>
          <h4<span id="notif_warning"></span> </h4>
         

  </div>








  <?php } else{ ?>
     <div id='map' style='height:100%;width:100%;'></div>

  <div class="reading" id='reading' style='
  position:absolute; 
  text-align: center;
  left: 800px; 
  top:100px; 
  width: auto;
  height: auto;
  background-color: darkred;
  color: white;
  margin-top: 30px;
  padding: 15px;
  border-radius: 8px;
  '>  <h5><span id="streets"></span></h5>
          <p>Flood level: <span id="readings"></span> cm.</p>
          <p>Updated on <span id="date_time"></span></p>
          <span id="wading"></span>


      <form action="" id="signupForm">     
         
          <input type="hidden" id="location" name="location">
          <input type="hidden" id="user" name="user" value="<?php echo  $_SESSION['user_id']; ?>">
          
          <div class="time_pin1" id='time_pin1'>
              
         



      </form>
 
  </div>

  <?php } ?>



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

      var saved_markers = <?= get_saved_locations() ?>;
      var saved_streets = <?= streets() ?>;
      var readings =  <?= readings() ?>;
      var location_id =  <?= get_location_id() ?>;
      var location_id_pin = <?= get_location_id_pin() ?>;
      var user_id_pin = <?= get_user_id_pin() ?>;
      var user = <?php if(isset($_SESSION['loggedin'])) {echo $_SESSION['user_id'];}else{ echo 0;} ?>;
      var time_pin = <?= get_time_pin() ?>;
      var date_time = <?= get_date_time() ?>;

      var cur_time;
      var atime;
      var btime;

      $(function(){
    $("#reading").hide();
    $("#notif").hide();
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

       


    

        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: center,
        zoom: 16
        })
        

        var directions = new MapboxDirections({
          accessToken: mapboxgl.accessToken
        })

        var popup = new Array(saved_markers.length);
        var markers = new Array(saved_markers.length);
        var wading = new Array(saved_markers.length);
        
    
      

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

            if(readings[i] <=10){
              wading[i] = "Road is clear, drive ahead";
            }
            else if( readings[i] <=20){
              wading[i] = "Unsafe for motor bikes and smaller vehicles"
            }
            else if(readings[i] <= 60){
              wading[i] = "Unsafe for Taxi's and smaller vehicles"
            }
            else if(readings[i] <= 90){
              wading[i] = "Unsafe for Jeepneys, large SUV's, and smaller vehicles"
            }
            else if(readings[i]>90){
              wading[i] = "High flood water. Unsafe for pick-up trucks and smaller vehicles"
            }
         

           atime = new Date('1997-07-25T' + date_time[i] + 'Z')
            .toLocaleTimeString({},
              {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric',second:'numeric'}
            );


           
            document.getElementById("streets").innerHTML = saved_streets[i];
            document.getElementById("readings").innerHTML = readings[i];
            document.getElementById("location").value = location_id[i];
            document.getElementById("wading").innerHTML = wading[i];
            document.getElementById("date_time").innerHTML = atime;
           
            
          //  document.getElementById("lat").value = lngLat.lat;
           // document.getElementById("lng").value = lngLat.lng;
        
            for (let x = 0; x < location_id_pin.length; x++){
              if(Number(location_id[i]) ==  Number(location_id_pin[x]) && Number(user_id_pin[x]) == user){
                document.getElementById("pin").value = "Remove";

     

                btime = new Date('1997-07-25T' + time_pin[x] + 'Z')
                .toLocaleTimeString({},
                  {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                );



                document.getElementById("time_span1").innerHTML = btime;
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
              var time3 = $('#time3').val();


              var url = 'mapdb.php?add_location&location=' + location_id 
              + '&user=' + user_id + '&time1=' + time1 + '&time3=' + time3
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



      $(document).ready(function(){
 
      function load_unseen_notification(view = '')
      {
       
        $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
          $('.dropdown-menu').html(data.notification);
          if(data.unseen_notification > 0)
          {
          $('.count').html(data.unseen_notification);
          }
        }
        });
      }
 
        load_unseen_notification();
        
  

        
        $(document).on('click', '.dropdown-toggle', function(){
          $('.count').html('');
          load_unseen_notification('yes');
        });
        
        setInterval(function(){ 
          load_unseen_notification();; 
        }, 1000);
        
        });
        var counter = 0;

     
     
        function realtimeClock(){
         

          var rtClock = new Date();

          var hours = rtClock.getHours();
          var minutes = rtClock.getMinutes();
          var seconds = rtClock.getSeconds();

          var amPm = ( hours < 12 ) ? "AM" : "PM";

          var hours2 = hours;
          hours = (hours > 12 ) ? hours - 12: hours;

          hours = ("0" + hours).slice(-2);
          hours2 = ("0" + hours).slice(-2);
          minutes = ("0" + minutes).slice(-2);
          seconds = ("0" + seconds).slice(-2);
          cur_time = hours2 + ":" + minutes + ":" + seconds;
          

          document.getElementById('clock').innerHTML = 
            hours + " : " + minutes + " : " + seconds + " " + amPm;
            //alert(time_pin[4] + " = " + cur_time + " = " + user_id_pin[1] + " = " + user);
        
         
          for (let x = 0; x < location_id_pin.length; x++){
           if(counter == 1){
            counter = 0;
             break;
           }
             
            
            if(time_pin[x] == cur_time && Number(user_id_pin[x]) == user){
              counter++;
             
              for(let i = 0; i < saved_markers.length; i++) {
                if(Number(location_id[i]) == Number(location_id_pin[x])){
           
                 
              
                  if(readings[i] <=10){
                    wading[i] = "Road is clear, drive ahead";
                  }
                  else if( readings[i] <=20){
                    wading[i] = "Unsafe for motor bikes and smaller vehicles"
                  }
                  else if(readings[i] <= 60){
                    wading[i] = "Unsafe for Taxi's aand smaller vehicles"
                  }
                  else if(readings[i] <= 90){
                    wading[i] = "Unsafe for Jeepneys, large SUV's, and smaller vehicles"
                  }
                  else if(readings[i]>90){
                    wading[i] = "High flood water. Unsafe for pick-up trucks and smaller vehicles"
                  }

                  var location = saved_streets[i];
                  var reading = readings[i];
                  var warning = wading[i];
                  var time = time_pin[x];


                  document.getElementById("notif_location").innerHTML = location;
                  document.getElementById("notif_warning").innerHTML = warning;
                  $("#notif").show();

                  
               
                  setInterval(function(){ $("#notif").hide(); }, 5000);
      
                  var url = 'mapdb.php?add_notif&location=' + location
                    + '&reading=' + reading + '&warning=' + warning + '&time=' + time;
                  $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data){
                       
                    }
                  });
                  
                break;
                
                 
                
                } 
              }
              
            }
          }

          



          var t = setTimeout(realtimeClock, 500);
        
        }
        //setInterval(function(){ alert(counter) }, 10000);


  </script>



</body>

</html>