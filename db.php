<?php
session_start();

// initializing variables
$username = "";
$first_name = "";
$middle_name = "";
$last_name = "";
$city = "";
$provine = "";
$street = "";
$password_1 = "";
$password_2 = "";

$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'redping');

// REGISTER USER


if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
  $middle_name = mysqli_real_escape_string($db, $_POST['middle_name']);
  $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $province = mysqli_real_escape_string($db, $_POST['province']);
  $street = mysqli_real_escape_string($db, $_POST['street']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($first_name)) { array_push($errors, "First Name is required"); }
  if (empty($middle_name)) { array_push($errors, "Middle Name is required"); }
  if (empty($last_name)) { array_push($errors, "Last Name is required"); }
  if (empty($city)) { array_push($errors, "City is required"); }
  if (empty($province)) { array_push($errors, "Province is required"); }
  if (empty($street)) { array_push($errors, "Street is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, first_name, middle_name, last_name, city, province, street, password) 
  			  VALUES('$username', '$first_name', '$middle_name', '$last_name', '$city', '$province', '$street', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

?>