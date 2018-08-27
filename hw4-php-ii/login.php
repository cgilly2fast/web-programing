<?php
//	Colby Gilbert
//	CSE 154
//	Austin Weale
//	5/5/2014
//	Assignment #4
//	all extra features included

session_start();
include("common.php");

logged_relay();

$username = $_POST["username"];
$password = $_POST["password"];
//check to see if nothing is passed. user must fill in feilds
if ($username == "" || $password == "") {
	send_error("Please Fill the Information to Register", "start.php");
}

//check to see if password contains username. user's password cannot conatin username
if (preg_match("/$username/", $password)) {
	send_error("Password cannot contain username", "start.php");
}

//taverses users.txt and puts contents into an array.
$database = array();
$contents = file("users.txt", FILE_IGNORE_NEW_LINES);
foreach ($contents as $match) {
	$userinfo = explode(":", $match);
	$database[$userinfo[0]] = $userinfo[1];
}

//check to see if the username or password is in the creect form
if (!array_key_exists($username, $database)) {
	$check_username = preg_match("/^[a-z][a-z0-9]{2,8}$/", $username);
	$check_password = preg_match("/^[a-z][a-z0-9]{2,8}$/", $password);
	if ($check_username && $check_password) {
		file_put_contents("users.txt", $username . ":" . $password . "\n" , FILE_APPEND);
		$database[$username] = $password;
	} else if (!$check_username) {
		send_error("Invalid Username Form", "start.php");
	} else {
		send_error("Invalid Password Form", "start.php");
	}
}

//check to see if password is matches.
if ($password == $database[$username]) {
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	date_default_timezone_set("America/Los_Angeles");
	setcookie("time", date("D y M d, g:i:s a"), time()+ 7 * 24 * 3600);
	header("Location: todolist.php");
} else {
	send_error("Password Incorrect", "start.php");
}
?>