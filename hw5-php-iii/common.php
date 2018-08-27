<?php
#	Colby Gilbert
#	Austin Weale
#	CSE 154
#	Assignment 5
#	5/10/2015

#common parts of all webpages in assignment.
function headers() {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>
<?php
}

#footer for all webpages in assingment.
function footer() {
?>
				<!-- form to search for every movie by a given actor -->
				<form action="search-all.php" method="get">
					<fieldset>
						<legend>All movies</legend>
						<div>
							<input name="first_name" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
							<input name="last_name" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="submit" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="first_name" type="text" size="12" placeholder="first name" /> 
							<input name="last_name" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="submit" />
						</div>
					</fieldset>
				</form>
			</div> <!-- end of #main div -->

			<div id="validators">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div> <!-- end of #frame div -->
	</body>
</html>
<?php
}

#REURNS: actor's id via actor's name.
function actor_id($first_name, $last_name, $db) {
	$first_name = $db->quote($first_name  . '%');
	$last_name = $db->quote($last_name);
	$rows = $db->query("SELECT id FROM actors WHERE last_name = $last_name AND first_name LIKE $first_name ORDER BY film_count DESC, id LIMIT 1");
	return $rows->fetch()["id"];
}

#makes the table for search data.
function make_table($rows, $cap) {
?>
<table>
	<caption><?= $cap ?></caption>
	<tr>
		<th>#</th>
		<th id="title">Title</th>
		<th>Year</th>
	</tr>
<?php
	for ($i=1; $i<=$rows->rowCount(); $i++) {
?>
	<tr>
		<?php
			$row = $rows->fetch();
		?>
		<td><?=$i ?></td>
		<td><?=$row["name"] ?></td>
		<td><?=$row["year"] ?></td>
	</tr>
<?php
		}
?>
</table>
<?php
}
?>