// Colby Gilbert
// Austin Weale
// CSE 154
// 6/01/15
// 

(function() {
	"use strict";

	window.onload = function() {
		if(window.location.search.indexOf("mode=cities")) {
			document.getElementById("search").onclick = ajax(cityNames, "mode=cities");
		} else if (window.location.search.indexOf("mode=cities")) {
			document.getElementById("search").onclick = ajax(rainData, "mode=cities&cities=");
		} else if(window.location.search.indexOf("mode=forecast")){
			document.getElementById("search").onclick = ajax(forecastData, "mode=forecast&city=");
		}

	}

	function ajax(func, type) {
		//document.getElementById("loadingnames").style.display = "inline";
		var city = document.getElementById("citiesinput").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = func;
		ajax.open("GET","https://webster.cs.washington.edu/cse154/weather.php?" + type + city, true);
		ajax.send();
	}

	function rainData() {
		//documnet.getElementById("loadingnames").style.display = "none";
		document.getElementById("resultsarea").style.display = "block";
		var loc = document.getElementById("location");
		var date = document.createElement("p");
		date.innerHTML ="";
		loc.innerHTML = "";

		var city = this.responseXML.querySelector("location name").textContent;
		var status = this.responseXML.querySelector("time symbol").getAttribute("name");
		var value = this.responseXML.querySelector("time temperature").getAttribute("value");
		
		var stats = document.createElement("p");
		stats.innerHTML = status;

		var cityName = document.createElement("p");
		cityName.innerHTML = city;
		cityName.className = "title";
		
		
		date.innerHTML = Date();

		document.getElementById("currentTemp").innerHTML = value + "&#8457";
	
		loc.appendChild(cityName);
		loc.appendChild(date);
		loc.appendChild(stats);
	
		document.getElementById("loadinglocation").style.display = "none";
	}

}());