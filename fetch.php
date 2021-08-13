<?php
$con=mysqli_connect ("localhost", 'root', '','redping');
if (!$con) {
    die('Not connected : ' . mysqli_connect_error());
}

if(isset($_POST['view'])){
 if($_POST["view"] != '')
 {
    $update_query = "UPDATE notifications SET noti_status = 1 WHERE noti_status = 0";
    mysqli_query($con, $update_query);
}
$query = "SELECT * FROM notifications ORDER BY id DESC LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
    $hours = date("g:i a", strtotime($row["time"]));


  $output .= '
  <li>
  <a href="#">
  <strong>'.$row["location"].'</strong><br />
  <small><em>'.$row["warning"].'</em></small><br />
  <small><em>'.$hours.'</em></small>
  </a>
  </li>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Notifications</a></li>';
}
$status_query = "SELECT * FROM notifications WHERE noti_status = 0";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>