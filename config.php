<?php
include 'db_connect.php';



//=============================== User login ==============================================
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$query = "SELECT * FROM `register` WHERE email='$email' AND password='$password' ";
	$results = mysqli_query($con, $query);
	$r = mysqli_fetch_assoc($results);
	if (mysqli_num_rows($results) == 1) {

		$_SESSION['name'] = $r['name'];
		$_SESSION['userid'] = $r['id'];

		if (!empty($redirection)) {
			echo '<script>alert("Login Success... ");window.location.href="dashboard.php"; </script> ';
		} else {
			echo '<script>alert("Login Success... ");window.location.href="./dashboard.php"; </script> ';
		}
	} else {
		echo ' <script>alert("Invalid Credential"); window.location.href="./";</script> ';
	}
}


//=============================== User Register / Sign up ==============================================
if (isset($_POST['signup'])) {
	// $name = mysqli_real_escape_string($con, $_POST['name']);
	// $phone = mysqli_real_escape_string($con, $_POST['phone']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$confirm = mysqli_real_escape_string($con, $_POST['cpassword']);

	$query = "SELECT * FROM `register` WHERE email='$email' OR phone='$phone' ";
	$results = mysqli_query($con, $query);
	$r = mysqli_fetch_assoc($results);
	if (mysqli_num_rows($results) > 0) {
		echo ' <script>alert("User Already Exist !"); window.location.href="";</script> ';
	} elseif ($password == $confirm) {
		mysqli_query($con, "INSERT INTO `register`(`email`, `password`) VALUES ('$email', '$password')");

		$r = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `register` WHERE email='$email' AND password='$password'"));
		$_SESSION['name'] = $r['name'];
		$_SESSION['userid'] = $r['id'];

		echo ' <script>alert("Registration Successful."); window.location.href="./";</script> ';
	} else {
		echo ' <script>alert("Password does not matched !!"); window.location.href="./signup12.html";</script> ';
	}
}

