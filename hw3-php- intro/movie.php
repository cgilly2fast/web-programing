<!--  Colby Gilbert
	Austin Weale
	Assignment 3
	1362877
	4/21/15

	the sturture of rancid3 tomatos website
-->

<?php
function banner($info) {
	if ($info[2] > 60) {
		?>
		<img src="https://webster.cs.washington.edu/images/freshlarge.png" alt="fresh" />		
	<?php	
	}else {
	?>
		<img src="https://webster.cs.washington.edu/images/rottenlarge.png" alt="rotten" />
	<?php
	}
	?>
		<span class="rating"><?= $info[2] ?>%</span>
	<?php
}

function footer() {
	?>
	<div class="banner">
    	<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="rancidbanner" />
	</div>
	<?php
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="https://webster.cs.washington.edu/students/colbyg95/hw3/movie.css" type="text/css" rel="stylesheet" />
		<link rel="icon" type="image/gif" href="images/rotten.gif">
	</head>

	<?php
		$movie = $_GET["film"];
		$info = file("$movie/info.txt", FILE_IGNORE_NEW_LINES);
		$overview = file("$movie/overview.txt", FILE_IGNORE_NEW_LINES);
		$reviews = glob("$movie/review*.txt");
		$num_reviews = count($reviews)
	?>

	<body>
		<?php footer()?>

		<h1><?= $info[0] ?> (<?= $info[1] ?>)</h1>
		<div id="main">
			<div class="rate">
				<?php
					banner($info)
				?>	
			</div>

			<div id="overview">
				<div>
					<img id="cover" src="<?= $movie ?>/overview.png" alt="general overview" />
				</div>
				<dl>
					<?php
                    foreach ($overview as $line) {
                    $defineIndex = strpos($line, ":");
                    $defineLength = strlen($line);
                    ?>

					<dt>
					<?= substr($line, 0, $defineIndex); ?> 
					</dt>
					<dd>
					<?= substr($line, $defineIndex + 1, $defineLength); ?> 
					</dd>
					<?php
						}
					?>

				</dl>
			</div>

			<div id="critic">
				<div id="reviews">
					<?php
					for ($i = 0; $i < count($reviews); $i++) {
						$review = file("$reviews[$i]", FILE_IGNORE_NEW_LINES);
					?>
					<p class="note">

					<?php
						if ($review[1] == "FRESH") {
					?>
							<img src="https://webster.cs.washington.edu/images/fresh.gif" alt="fresh" />
					<?php
						} else if ($review[1] == "ROTTEN") {
					?>
							<img src="https://webster.cs.washington.edu/images/rotten.gif" alt="rotten" />
					<?php
							}
					?>

					<?= $review[0] ?>

					</p>			
					<p class="id">
						<img src="https://webster.cs.washington.edu/images/critic.gif" alt="critic" />
					<?php
						if (count($review) == 4) {
					?>
							<q><?=$review[2]?></q>
							<br />
							<q><?=$review[3]?></q>
					<?php		
						}else{
					?>		
							<q><?=$review[2]?><q>
					<?php
						}
					?>
					</p>
					<?php
						}
					?>
				</div>	
			</div>

			<p id="page">(1-<?= $num_reviews ?>) of <?= $num_reviews ?></p>
			<div class="rate">
				<?php
					banner($info);
				?>	
			</div>
		</div>	
		<div>
				<a class="validators" href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
				<a class="validators" href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
		</div>	
		<?php footer()?>
	</body>
</html>	
