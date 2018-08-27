(function() {
	window.onload = function() {
		document.getElementById("lookup").onclick = fetchData;
	}	
	
	function fetchData() {
		var phrase = document.getElementById("term").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = define;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/labs/9/urban.php?term="+ phrase + "&all=true", true);
 		ajax.send();
	}
	
	function define() {
		var defination = this.responseText;
		var list = document.createElement("ol");
		list.id = "list"
		for(var i = 0; i < defination.length; i++) {
			var line = createElement("li");
			line.innerHTML = defination[i];
			document.getElementById("list").appendChild(line)
		}	
	}
}());	