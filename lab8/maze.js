(function() {
	"usestrict";
	var flag = true;

	window.onload = function() {
		var b1 = document.querySelectorAll(".boundary");
		for(var i = 0; i < b1.length; i++) {
			b1[i].onmouseover = lose;
		}
		var c = document.getElementById("end");
		c.onmouseover = win;

		var d = document.getElementById("start");
		d.onclick = reset;
	};

	function lose() {
		flag = false;
		var b2 = document.querySelectorAll(".boundary");
		for(var i = 0; i < b2.length; i++) {
			b2[i].style.backgroundColor = "red";
		}
		var b3 = document.getElementById("status");
		b3.innerHTML = "you lose, try again"		
	}

	function win() {
		if(flag) {
		var b3 = document.getElementById("status");
		b3.innerHTML = "YOU WIN!!!!!";
		}
	}

	function reset() {
		flag = true;
		var c1 =  document.querySelectorAll(".boundary");
		for(var i = 0; i <c1.length; i++) {
			c1[i].style.backgroundColor = "white";
		}
		var b3 = document.getElementById("status");
		b3.innerHTML = "Move your mouse over the 'S' to begin."	
	}	
})();