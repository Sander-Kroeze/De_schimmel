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
                    width: 350, height: 220,
                    yellowColor: "#f21505",
                    redFrom: 0, redTo: 79,
                    greenFrom: 80, greenTo: 95,
                    yellowFrom: 96, yellowTo: 100,
                    minorTicks: 10
                };

                var chart = new google.visualization.Gauge(document.getElementById('chart_div1'));
                chart.draw(data, options);

            }
        }
    </script>
</head>
<body>

<div class="col-md-12 title">
    <h3>Gewicht</h3>
</div>

<div id="chart_div1" style="width: 400px; height: 120px;"></div>
</body>
</html>
