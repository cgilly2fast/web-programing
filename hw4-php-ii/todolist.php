<!--
	Colby Gilbert
	CSE 154
	Austin Weale
	5/5/2014
	Assignment #4
	all extra features included
-->
<?php
include("common.php");
headers();
session_start();
unlogged_relay();


$username = $_SESSION["username"];
$password = $_SESSION["password"];

?>

		<h2><?= $username ?>'s To-Do List</h2>

		<ul id="todolist">
			<?php
				error_message();
				if (file_exists("todo-{$username}.txt")) {
					$list = file("todo-{$username}.txt", FILE_IGNORE_NEW_LINES);
					for ($i=0; $i<count($list); $i++) { ?>
						<li>
							<form method="post" action="submit.php">
								<input type="hidden" value="delete" name="action">
								<input type="hidden" value=<?= $i ?> name="index">
								<input type="submit" value="Delete">
							</form>
							<?= $list[$i] ?>
						</li>
				<?php
					}		
				}
			?>
			<li>
				<form method="post" action="submit.php">
					<input type="hidden" value="add" name="action">
					<input type="text" autofocus="autofocus" size="25" name="item">
					<input type="submit" value="Add">
				</form>
			</li>
		</ul>

		<div>
			<a href="logout.php">
			<strong>Log Out</strong>
			</a>
			<em>(logged in since <?=$_COOKIE["time"]?>)</em>
		</div>
<?php
footer();
?>