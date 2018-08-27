// Colby Gilbert
// Austin Weale
// CSE 154
// 6/01/15
// it does the stuff

(function() {
	"use strict";
	var value;

	window.onload = function() {
		document.getElementById("loadingnames").style.display = "inline";
		document.getElementById("resultsarea").style.display = "none";
		ajaxCities();
		document.getElementById("search").onclick = recieveData;
		var slider = document.getElementById("slider");
		slider.value = 0;
		slider.onchange = tempFill;
		document.getElementById("temp").onclick = tempData;
		document.getElementById("precip").onclick = precipData;
	};

	function precipData() {
		document.getElementById("slider").style.display = "none";
		document.getElementById("loadinggraph").style.display = "inline";
		ajaxRain(precipitation);
	}

	function tempData() {
		document.getElementById("loadinggraph").style.display = "inline";
		document.getElementById("graph").style.display = "none";
		document.getElementById("slider").style.display = "block";
		document.getElementById("loadinggraph").style.display = "none";
	}

	function recieveData() {
		document.getElementById("resultsarea").style.display = "none";
		document.getElementById("location").innerHTML = "";
		document.getElementById("resultsarea").style.display = "block";
		document.getElementById("currentTemp").innerHTML = "";
		document.getElementById("graph").innerHTML = "";
		document.getElementById("slider").style.display = "inline";
		document.getElementById("forecast").innerHTML = "";
		document.getElementById("loadingforecast").style.display = "block";
		document.getElementById("loadinggraph").style.display = "block";
		document.getElementById("loadinglocation").style.display = "block";
		ajaxRain(rainData);
	}
	function ajaxCities() {
		var ajax = new XMLHttpRequest();
		ajax.onload = cityNames;
		ajax.open("GET","https://webster.cs.washington.edu/cse154/weather.php?mode=cities", true);
		ajax.send();
	}

	function ajaxRain(func) {
		var city = document.getElementById("citiesinput").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = func;
		ajax.open("GET","https://webster.cs.washington.edu/cse154/weather.php?mode=rain&city=" + city, true);
		ajax.send();
	}

	function ajaxForecast() {
		var city = document.getElementById("citiesinput").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = forecastData;
		ajax.open("GET","https://webster.cs.washington.edu/cse154/weather.php?mode=forecast&city=" + city, true);
		ajax.send();
	}
	function cityNames() {
		var cities = this.responseText.split("\n");
		for(var i = 0 ; i < cities.length; i++) {
			var element = document.createElement("option");
			element.innerHTML = cities[i];
			document.getElementById("cities").appendChild(element);
		}
		document.getElementById("loadingnames").style.display = "none";
	}

	function forecastData() {
		var request = JSON.parse(this.responseText);

		var row1 = document.createElement("tr");
		var graph = document.getElementById("forecast");
		forecast.innerHTML = "";
		for( var i = 0; i < 7; i++) {
			var id = request.list[i].weather[0].icon;
			var td = document.createElement("td");
			var img = document.createElement("img");
			img.src = "https://openweathermap.org/img/w/" + id + ".png";
			td.appendChild(img);
			row1.appendChild(td);
		}
		graph.appendChild(row1);

		var row2 = document.createElement("tr");
		for(var i = 0; i < 7; i++){
			var temp = value[i].getElementsByTagName("temperature");
			var td = document.createElement("td");
			var div = document.createElement("div");
			div.innerHTML = Math.round(parseInt(temp[0].getAttribute("value"))) + "&#8457";
			td.appendChild(div);
			row2.appendChild(td);
		}
		graph.appendChild(row2);
		document.getElementById("loadingforecast").style.display = "none";
	}

	function rainData() {
		value = this.responseXML.getElementsByTagName("time");
		ajaxForecast();
		var loc = document.getElementById("location");
		var date = document.createElement("p");
		loc.innerHTML = "";

		var city = this.responseXML.querySelector("location name").textContent;
		var status = this.responseXML.querySelector("time symbol").getAttribute("name");
		
		var stats = document.createElement("p");
		stats.innerHTML = status;

		var cityName = document.createElement("p");
		cityName.innerHTML = city;
		cityName.className = "title";
		
		
		date.innerHTML = Date();
		var temp = value[0].getElementsByTagName("temperature");
		document.getElementById("currentTemp").innerHTML = temp[0].getAttribute("value") + "&#8457";
	
		loc.appendChild(cityName);
		loc.appendChild(date);
		loc.appendChild(stats);

		document.getElementById("loadinglocation").style.display = "none";
		document.getElementById("loadinggraph").style.display = "none";
	}

	function precipitation() {
		document.getElementById("graph").style.display = "block";
		var time = this.responseXML.getElementsByTagName("time");
		var row = document.createElement("tr");
		var graph = document.getElementById("graph");
		graph.innerHTML = "";
		for( var i = 0; i < 7; i++) {
			var td = document.createElement("td");
			var div = document.createElement("div");
			var percent = time[i].getElementsByTagName("clouds");
			div.style.height = percent[0].getAttribute("all") + "px";
			div.innerHTML = percent[0].getAttribute("all") + "%";
			td.appendChild(div);
			row.appendChild(td);
		}
		graph.appendChild(row);
		document.getElementById("loadinggraph").style.display = "none";
	}

	function tempFill() {
		document.getElementById("loadinggraph").style.display = "inline";
		var temp = value[(this.value / 3)].getElementsByTagName("temperature");
		document.getElementById("currentTemp").innerHTML = temp[0].getAttribute("value") + "&#8457";
		document.getElementById("loadinggraph").style.display = "none";
	}
		
}());