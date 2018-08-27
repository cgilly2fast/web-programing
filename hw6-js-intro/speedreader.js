// Colby Gilbert
// Austin Weale
// CSE 154
// 5/20/15

(function() {
	"use strict";

	var speed;
	var words;
	var pos = 0;
	var timer;
	
	window.onload = function() {
		var startButton = document.getElementById("start");
		startButton.onclick = start;
		var stopButton = document.getElementById("stop");
		stopButton.onclick = stop;
		document.getElementById("stop").disabled = true;
		document.getElementById("start").disabled = false;
	};

	function start() {
		words = input();
		document.getElementById("start").disabled = true;
		document.getElementById("stop").disabled = false;
		speed = getSpeed();
		timer = setInterval(tick, speed);
	}

	function stop() {
		document.getElementById("stop").disabled = true;
		document.getElementById("start").disabled = false;
		clearInterval(timer);
		var displayWord = document.getElementById("display");
		displayWord.innerHTML = "";
		pos = 0;
	}
	
	function input() {
		var input = document.getElementById("text");
		input = "" + input.value;
		return input.split(/\s+/);
	}
	
	function tick() {
		var displayWord = document.getElementById("display");
		displayWord.style.fontSize = getSize();

		if(speed !== getSpeed()){
			clearInterval(timer);
			speed = getSpeed();
			timer = setInterval(tick, speed);
		}
		
		if(pos == words.length) {
			stop();
		} else if( words[pos].search(/[;:!?.,]/) > -1) {
			alert("change")
			words[pos] = words[pos].replace(/[;:!?.,]/,"");
			displayWord.innerHTML = words[pos];
		} else {
			displayWord.innerHTML = words[pos];	
			pos++;
		}
	}
	
	function getSpeed() {
		var speed = document.getElementById("speed").value;
		return speed;
	}

	function getSize() {
		var size = document.getElementsByName("size");
		
		for(var i = 0; 1 < size.length; i++) {
			if(size[i].checked) {
				return size[i].value;
			}
		}
	}
})();	