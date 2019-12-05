<?php
//  function checkTemperature($input){
//  	if ($input > 16 && $input < 22 ) {
//  		return "Correct";
//  	}
//  	return "Afwijkend";
//  }
// echo checkTemperature(22.4);
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

	setInterval(function(){ start(); }, 1000);

	function start(){
		const date = Date.now();
		document.getElementById("demo").innerHTML = date;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
		    var myObj = JSON.parse(this.responseText);
		    var temp1 = myObj.temp1;
		    var temp2 = myObj.temp2;
		    var temp3 = myObj.temp3;
		    getTemperature(temp1, temp2, temp3);
		  }
		};
		xmlhttp.open("GET", "schimmel.json", true);
		xmlhttp.send();
  }

  function getTemperature(temp1, temp2, temp3){
  	google.charts.load('current', {'packages':['gauge']});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {

	    var data = google.visualization.arrayToDataTable([
	      ['Label', 'Value'],
	      ['meting 1', temp1],
	      ['Meting 2', temp2],
	      ['Meting 3', temp3]
	    ]);

	    var options = {
	      width: 400, height: 120,
			  yellowColor:"#f21505",
			  redFrom: 0, redTo: 15,
			  greenFrom: 16, greenTo: 22,
			  yellowFrom:23, yellowTo: 100,
			  minorTicks: 10
	    };

	    var chart = new google.visualization.Gauge(document.getElementById('chart_div2'));

	    chart.draw(data, options);
	  }
  }
</script>
<div class="col-md-12 title">
	<h3>temperatuur</h3>
</div>
<div class="col-md-12">
	<hr>
</div>
<div class="row">
	<div class="col-md-12">meting is genomen op :<label id="demo"></label> </div>
</div><br>
<!-- <div class="row">
	<div class="col-md-2">meting</div>
	<div class="col-md-5">temperatuur</div>
	<div class="col-md-5">Juiste waarde</div>
</div><br>
<div class="row">
	<div class="col-md-2">meting 1:</div>
	<div class="col-md-5"></div>
	<div class="col-md-5"></div>
</div><br>
<div class="row">
	<div class="col-md-2">meting 2:</div>
	<div class="col-md-5"></div>
	<div class="col-md-5"></div>
</div><br>
<div class="row">
	<div class="col-md-2">meting 2:</div>
	<div class="col-md-5"></div>
	<div class="col-md-5"></div>
</div><br> -->
    <div id="chart_div2" style="width: 400px; height: 120px;"></div>