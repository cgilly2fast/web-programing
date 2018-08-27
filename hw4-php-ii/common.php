<?php
//	Colby Gilbert
//	CSE 154
//	Austin Weale
//	5/5/2014
//	Assignment #4
//	all extra features included

// the head of start.php and todolist.php
function headers() { ?>	
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Remember the Cow</title>
			<link rel="stylesheet" type="text/css" href="https://webster.cs.washington.edu/css/cow-provided.css">
			<link rel="stylesheet" type="text/css" href="cow.css">
			<link rel="shortcut icon" type="image/ico" href="https://webster.cs.washington.edu/images/todolist/favicon.ico">
		</head>
		<body>
			<div class="headfoot">
				<h1>
					<img alt="logo" src="https://webster.cs.washington.edu/images/todolist/logo.gif">
					Remember
					<br>
					the Cow
				</h1>
			</div>
<?php		
}

//code for the headers and footers for website
function footer() {
?>
			<div class="headfoot">
				<p>
					"Remember The Cow is nice, but it's a total copy of another site." - PCWorld
					<br>
					All pages and content © Copyright CowPie Inc.
				</p>
				<div id="w3c">
					<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/w3c-html.png" alt="Valid HTML" /></a>
					<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/w3c-css.png" alt="Valid CSS" /></a>
				</div>
			</div>
		</body>
	</html>
<?php
}

//shows error message of error in the website.
function error_message() {
	if (isset($_SESSION["error"])) {
?>
		<p id="error">
			<?= $_SESSION["error"] ?>
		</p>
<?php
		unset($_SESSION["error"]);
	}
}

//relays error message of the passed in location parameter.
function send_error($message, $location) {
	$_SESSION["error"] = $message;
	header("Location: $location");
	die();
}
//checks to see if username or password session isset. if true relayed to todolist.php

function logged_relay() {
	if (isset($_SESSION["username"]) || isset($_SESSION["password"])) {
		header("Location: todolist.php");
		die();
	}
}

//checks to see if username or password session is not set. if false relayed to start.php
function unlogged_relay() {
	if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
		header("Location: start.php");
		die();
	}
}
?>