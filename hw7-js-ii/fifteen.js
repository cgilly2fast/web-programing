// Colby Gilbert
// CSE 154
// Austin Weale
// 5/23/15

// Script for creating Fifteen Puzzle for HW 7 in CSE 154. Games shuffles pieces,
// and moves pieces on clicks. This a game consisting of a 4x4 grid of numbered 
// squares with one square missing. The object of the game is to arrange the tiles into 
// numerical order by repeatedly sliding a square that neighbors the missing square
// into its empty space.

(function() {
	"use strict";
	
	var empX = "300px";
	var empY = "300px";
	
	// After window has load necessary function set up.
	window.onload = function() {
		createPieces();
		placeIt();
		var shuf =document.getElementById("shufflebutton");
		shuf.onclick = shuffle;
	};
	
	// Creates 15 empty pieces for the puzzle.
	function createPieces() {
		for(var i = 0; i < 15; i++) {
			var rect = document.createElement("div");
			rect.innerHTML = i + 1;
			rect.className = "piece";
			document.getElementById("puzzlearea").appendChild(rect);
			rect.onclick = move;
		}
	}
	
	// Verifies if piece is in a legal position to move, return true/false.
	function check(pieceX, pieceY) { 
		// gets necessary data to make verification.
		var pieceX = parseInt(pieceX);
		var pieceY = parseInt(pieceY);
		
		var empIntX = parseInt(empX);
		var empIntY = parseInt(empY);
		
		// Checks all possible cases(up, down, left, right) of legal position to move.
		// If postion DNE, false in returned
		return ((empIntX == pieceX && (pieceY - 100) == empIntY) || 
		(empIntX == pieceX && (pieceY + 100) == empIntY) || 
		(empIntX == (pieceX - 100) && pieceY  == empIntY) || 
		(empIntX == (pieceX + 100) && pieceY  == empIntY) );
	}
	
	// Function to move piece selected by user.	
	function move() {
		var oldX = this.style.left;
		var oldY = this.style.top;
		if(check(oldX, oldY)){
			helpMove(this);	
		}
	}
	
	// Helper move that actually makes move of a piece to empty space.
	function helpMove(sqr) {
		var oldX = sqr.style.left;
		var oldY = sqr.style.top;
		
		sqr.style.left = empX;
		sqr.style.top = empY;
			
		empX = oldX;
		empY = oldY;		
	}
	
	// Shuffles pieces on game board, guaranteed to be solvable puzzle after shuffle
	function shuffle() {
		// Get all pieces.
		var rects = document.querySelectorAll("#puzzlearea .piece");
		// Make a 1000 moves to shuffle board.
		for(var i = 0; i < 1000; i++) {
			var nieghbors = [];
			// Find all pieces that can be moved.
			for(var j = 0; j < rects.length; j++) {
				var x = parseInt(rects[j].style.left);
				var y = parseInt(rects[j].style.top);
			
				if(check(x,y)) {
					nieghbors.push(rects[j]);
				}
			}
			// Randomly pick one of the possible choices.
			var rand = Math.floor(Math.random() * nieghbors.length);
			
			// Move piece.
			helpMove(nieghbors[rand]);
		}	
	}
	
	// Positions all the pieces, in solved order.
	function placeIt() {
		var rects = document.querySelectorAll("#puzzlearea .piece");
		// For each piece define postion, and image portion.
		for(var i  = 0; i < rects.length; i++) {
			var leftSpot = 100 * (i % 4) + "px";
			rects[i].style.left = leftSpot;
			var topSpot = 100 * Math.floor(i / 4) + "px";
			rects[i].style.top = topSpot;
			rects[i].style.backgroundPosition = "-" + leftSpot + " " + "-" + topSpot;
		}
	}
}());	