<?php
$con=mysqli_connect ("localhost", 'root', '','redping');
if (!$con) {
    die('Not connected : ' . mysqli_connect_error());
}


$sql = "DELETE FROM my_pins WHERE user_id='" . $_GET["userid"] . "' AND location_id='" . $_GET["locationid"] . "'";
if (mysqli_query($con, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($conn);
?>