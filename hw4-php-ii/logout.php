<?php
//	Colby Gilbert
//	CSE 154
//	Austin Weale
//	5/5/2014
//	Assignment #4
//	all extra features included

//user will be logged out by this page and the session variables will be deleted.
session_start();
session_destroy();
session_regenerate_id();
header("Location: start.php");
?>