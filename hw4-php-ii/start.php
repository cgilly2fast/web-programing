<!--
	Colby Gilbert
	CSE 154
	Austin Weale
	5/5/2014
	Assignment #4
	all extra features included

	this is the homepage (start.php) User can log in/register through this page.
-->
<?php
session_start();
include("common.php");
logged_relay();
headers();
?>
		<div id="main">
			<p>
				The best way to manage your tasks.
				<br>
				Never forget the cow (or anything else) again!
			</p>
			<p>
				Log in now to manage your to-do list.
				<br>
				If you do not have an account, one will be created for you.
			</p>
			<?php
				error_message();
			?>
			<form id="loginform" method="post" action="login.php">
				<div>
					<input type="text" autofocus="autofocus" size="8" name="username">
					<strong>User Name</strong>
				</div>
				<div>
					<input type="password" size="8" name="password">
					<strong>Password</strong>
				</div>
				<div>
					<input type="submit" value="Log in">
				</div>
			</form>
			<?php
				if (isset($_COOKIE["time"])) {
			?>
					<p>
						<em>(last login from this computer was <?=$_COOKIE["time"]?>)</em>
					</p>
			<?php
				}
			?>
		</div>	
<?php
footer()
?>