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
    been in with Kevin Bacon-->
<div id="main">
	<h1>The One Degree of Kevin Bacon</h1>
<?php
	if ($actor == null) {
?>
		<p>Actor <?= $full_name ?> not found</p>
<?php
	} else {
		$id = $db->quote($actor);
		$id_kevin = $db->quote(actor_id('Kevin', 'Bacon', $db));
		$rows = $db->query("SELECT name, year FROM movies m JOIN roles r1 ON m.id = r1.movie_id JOIN actors a1 ON a1.id = r1.actor_id JOIN roles r2 ON m.id = r2.movie_id JOIN actors a2 ON a2.id = r2.actor_id WHERE a1.id = $id AND a2.id = $id_kevin ORDER BY m.year DESC, m.name");
		if ($rows->rowCount() == 0) {
?>
			<p><?= $full_name ?> wasn't in any films with Kevin Bacon.</p>
<?php
		} else {
			make_table($rows, "Films with <?= $fullname ?> and Kevin Bacon");
		}
	}
	footer();
?>