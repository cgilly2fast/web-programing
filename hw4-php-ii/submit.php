<?php
//	Colby Gilbert
//	CSE 154
//	Austin Weale
//	5/5/2014
//	Assignment #4
//	all extra features included

//setting up the page.
session_start();
include("common.php");
unlogged_relay();
$username = $_SESSION["username"];
//deletes passed item 
if ($_POST["action"] == "delete") {
	$list = file("todo-{$username}.txt");
	$index = $_POST["index"];
	if (!preg_match("/\d/", '$index' || $list[$index] == null)) {
		send_error("Invalid operation", "todolist.php");
	}
	$list[$index] = "";
	file_put_contents("todo-{$username}.txt", $list);
//adds passed item in item
} else if ($_POST["action"] == "add") {
	$item = $_POST["item"];
	if (preg_match("/^\s$/", subject)) {
		send_error("You must write something down!", "todolist.php");
	}
	$item = htmlspecialchars($item, ENT_QUOTES);
	file_put_contents("todo-{$username}.txt", $item . "\n", FILE_APPEND);
//send error message to todolist.php
} else {
	send_error("Invalid operation", "todolist.php");
}
//relay to todolist after completing taskes
header("Location: todolist.php");
?>