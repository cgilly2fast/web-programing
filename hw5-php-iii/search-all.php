<?php
#	Colby Gilbert
#	Austin Weale
#	CSE 154
#	Assignment 5
#	5/10/2015

	include("common.php");
	headers();
	$first_name = $_GET['first_name'];
	$last_name = $_GET['last_name'];
	$db = new PDO("mysql:dbname=imdb;host=localhost;charset=utf8", "colbyg95", "wjhpJpIJxe");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$actor = actor_id($first_name, $last_name, $db);
	$full_name = $first_name . " " . $last_name;
?>
<!-- The main part of this page which displays the table of the movies which this actor has
    been in -->
<div id="main">
	<h1>Results for <?= $full_name ?></h1>
<?php
	if ($actor == null) {
?>
		<p>Actor <?= $full_name ?> not found</p>
<?php
	} else {
		$id = $db->quote($actor);
		$rows = $db->query("SELECT name, year FROM movies m JOIN roles r ON m.id = r.movie_id JOIN actors a ON a.id = r.actor_id WHERE a.id = $id ORDER BY m.year DESC, m.name");
		make_table($rows, "All Films");
	}
	footer();
?>