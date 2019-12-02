<?php
//function weightCheck()
//{
////Gets the date of today
//    $dateNowWeight = date('Y-m-d h:i:sa');
//
//    //Gets the right json file
//    $jsonWeight = file_get_contents('pages/schimmel.json');
//    $jsonDataWeight = json_decode($jsonWeight, true);
//
//    //selects from the json file the right data
//    $load1 = $jsonDataWeight['load1'];
//    $load1 = $jsonDataWeight['load1'];
//
//
//    echo '<br>Tijd op het punt van meten: '.$dateNowWeight.'';
//}
//weightCheck();

?>

<html>
<head>
    <script type="text/javascript" src="schimmel.json"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        refresh();


        function refresh() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var myObj = JSON.parse(this.responseText);
                    //Puts the data in the variable's
                    var weightLoad1 = myObj.load1;
                    var weightLoad2 = myObj.load2;
                    var weightLoad3 = myObj.load3;

                    getWeight(weightLoad1, weightLoad2, weightLoad3);

                    //If the load is not right give error message
                    if (weightLoad1 < 79 && weightLoad1 > 96 ){
                        alert("Waarde van Load 1 niet goed")
                    }
                    if (weightLoad2 < 79 && weightLoad1 > 96 ){
                        alert("Waarde van Load 2 niet goed")
                    }
                    if (weightLoad3 < 79 && weightLoad1 > 96 ){
                        alert("Waarde van Load 3 niet goed")
                    }
                }
            };
            xmlhttp.open("GET", "pages/schimmel.json", true);
            xmlhttp.send();
        }

        //Refreshing page after one minute
        setInterval(refresh, 60000);

        function getWeight(load1 , load2, load3) {
            google.charts.load('current', {'packages': ['gauge']});
            google.charts.setOnLoadCallback(drawChart);

            //loads the data into the page
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Meetpunt 1', load1],
                    ['Meetpunt 2', load2],
                    ['Meetpunt 3', load3]
                ]);

                //Right options for the indicators
                var options = {
                    width: 300, height: 120,
                    yellowColor: "#f21505",
                    redFrom: 0, redTo: 79,
                    greenFrom: 80, greenTo: 95,
                    yellowFrom: 96, yellowTo: 100,
                    minorTicks: 10
                };

                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
                chart.draw(data, options);

            }
        }
    </script>
</head>
<body>
<div id="chart_div" style="width: 400px; height: 120px;"></div>
</body>
</html>
