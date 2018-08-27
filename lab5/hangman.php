<?php
$MAX_GUESSES  = 6;                           # max guesses that can be made before game ends
$guesses   = $MAX_GUESSES;                   # number of guesses the player has left
$available = "abcdefghijklmnopqrstuvwxyz";   # letters available to be guessed


# pick a random word from the dictionary file
$words = file("/www/html/cse154/labs/5/words.txt", FILE_IGNORE_NEW_LINES);
$word  = $words[rand(0, count($words))];
	
$clue = "???";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hangman</title>
    <link href="https://webster.cs.washington.edu/cse154/labs/5/hangman.css" type="text/css" rel="stylesheet" />
  </head>
  
  <body>
    <h1>Hangman Step by Step</h1>
    
    <div>
      <img src="https://webster.cs.washington.edu/cse154/labs/5/hangman<?= $guesses ?>.gif" alt="hangman" /> <br />
      (<?= $guesses ?> guesses remaining)
    </div>
    
    <div id="clue"> <?= $clue ?> </div>
    
		<form action="hangman.php">
			<input name="guess" type="text" size="1" maxlength="1" autofocus="autofocus" />
			<input type="submit" value="Guess" />
		</form>
    
		<form action="hangman.php" method="post">
			<input name="newgame" type="hidden" value="true" />
			<input type="submit" value="New Game" />
		</form>

    <div id="hint">
    	HINT: The word is: <code>"<?= $word ?>"</code> <br />
    	The letters available are: <code>"<?= $available ?>"</code>
    </div>
  </body>
</html>
