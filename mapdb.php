<?php 

$con=mysqli_connect ("localhost", 'root', '','redping');
if (!$con) {
    die('Not connected : ' . mysqli_connect_error());
}

if(isset($_GET['add_location'])) {
    add_location();
}

function add_location(){
    $con=mysqli_connect ("localhost", 'root', '','redping');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $location_id = $_GET['location'];
    $user_id = $_GET['user'];
    $time1 = $_GET['time1']*10000;
    $time2 = $_GET['time2'];

    $time = $time1 + $time2;
    // Inserts new row with place data.
    $query = sprintf("INSERT INTO my_pins " .
        " (location_id, user_id, time) " .
        " VALUES ('%s', '%s', '%s');",
        mysqli_real_escape_string($con, $location_id),
        mysqli_real_escape_string($con, $user_id),
        mysqli_real_escape_string($con, $time));

    $result = mysqli_query($con,$query);
    echo json_encode('Successfully inserted!');
    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
  }

  if(isset($_GET['del_location'])) {
    del_location();
}

function del_location(){
    $con=mysqli_connect ("localhost", 'root', '','redping');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $location_id = $_GET['location'];
    $user_id = $_GET['user'];


    $sql = "DELETE FROM my_pins WHERE user_id='" . $user_id . "' AND location_id='" . $location_id . "'";
    if (mysqli_query($con, $sql)) {
        echo json_encode('Successfully Deleted!');
    } else {
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
    $sqldata = mysqli_query($con,"select reading from readings ORDER BY location_id DESC LIMIT 4");

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

    function streets(){
        $con=mysqli_connect("localhost", 'root', '','redping');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // update location with location_status if admin location_status.
        $sqldata = mysqli_query($con,"select location_street_name from locations ");
        if (!$sqldata) {
        echo 'Could not run query: ' . mysql_error();
        exit;
        }
        $rows = array();
        while($r = mysqli_fetch_assoc($sqldata)) {
            $rows[] = $r;

        }
        $indexed = array_map('array_values', $rows);
        echo json_encode($indexed);
        if (!$rows) {
            return null;
        }
    }
    function get_location_id(){
        $con=mysqli_connect("localhost", 'root', '','redping');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // update location with location_status if admin location_status.
        $sqldata = mysqli_query($con,"select location_id from locations ");
        if (!$sqldata) {
        echo 'Could not run query: ' . mysql_error();
        exit;
        }
        $rows = array();
        while($r = mysqli_fetch_assoc($sqldata)) {
            $rows[] = $r;

        }
        $indexed = array_map('array_values', $rows);
        echo json_encode($indexed);
        if (!$rows) {
            return null;
        }
    }

    function get_location_id_pin(){
        $con=mysqli_connect("localhost", 'root', '','redping');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // update location with location_status if admin location_status.
        $sqldata = mysqli_query($con,"select location_id from my_pins ");
        if (!$sqldata) {
        echo 'Could not run query: ' . mysql_error();
        exit;
        }
        $rows = array();
        while($r = mysqli_fetch_assoc($sqldata)) {
            $rows[] = $r;

        }
        $indexed = array_map('array_values', $rows);
        echo json_encode($indexed);
        if (!$rows) {
            return null;
        }
    }

    function get_user_id_pin(){
        $con=mysqli_connect("localhost", 'root', '','redping');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // update location with location_status if admin location_status.
        $sqldata = mysqli_query($con,"select user_id from my_pins ");
        if (!$sqldata) {
        echo 'Could not run query: ' . mysql_error();
        exit;
        }
        $rows = array();
        while($r = mysqli_fetch_assoc($sqldata)) {
            $rows[] = $r;

        }
        $indexed = array_map('array_values', $rows);
        echo json_encode($indexed);
        if (!$rows) {
            return null;
        }
    }


    function get_time_pin(){
        $con=mysqli_connect("localhost", 'root', '','redping');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        if(isset($_SESSION['loggedin'])) {
            $data = $_SESSION['user_id'];
        }
        // update location with location_status if admin location_status.
        $q = "select time from my_pins";
        $sqldata = mysqli_query($con,$q);
        if (!$sqldata) {
        echo 'Could not run query: ' . mysql_error();
        exit;
        }
        $rows = array();
        while($r = mysqli_fetch_assoc($sqldata)) {
            $rows[] = $r;

        }
        $indexed = array_map('array_values', $rows);
        echo json_encode($indexed);
        if (!$rows) {
            return null;
        }
    }

    function get_date_time(){
    
        $con=mysqli_connect ("localhost", 'root', '','redping');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // update location with location_status if admin location_status.

        
        $sqldata = mysqli_query($con,"select cast(date_time as time) from readings ORDER BY location_id DESC LIMIT 4");
    
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