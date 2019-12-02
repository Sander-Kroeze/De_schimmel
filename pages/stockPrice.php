<div class="title">
    <h5>Tijdlijn van de prijs per bakje</h5>
</div>

<script type="text/javascript" loading="lazy" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    // load current chart package
    google.charts.load("current", {
        packages: ["corechart", "line"]
    });
    // set callback function when api loaded
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        // create data object with default value



        var data = google.visualization.arrayToDataTable([
            ["Datum", "Prijs per bakje"],
            [0, 0]
        ]);
        // create options object with titles, colors, etc.
        var options = {
            title: "Prijs per bakje",
            hAxis: {
                title: "Tijd in seconden"
            },
            vAxis: {
                title: "Euro's"
            }
        };
        // draw chart on load
        var chart = new google.visualization.LineChart(
            document.getElementById("chart_div")
        );
        chart.draw(data, options);


        // interval for adding new data every 250ms
        var index = 0;
        var price = 0.32;
        var seconds = 30;


        var d = new Date();
        var n = d.getSeconds();
        setInterval(function() {
            // instead of this random, you can make an ajax call for the current cpu usage or what ever data you want to display

            var random = Math.random() * 30 + 20;

            seconds  += 30;
            data.addRow([seconds , price]);
            chart.draw(data, options);

            if (price >=0.50) {
                price = 0.31;
            } else if (price <= 0.35) {
                alert('de prijs is lager dan €0,35');
                price += 0.05;
            } else {
                price += 0.05;
            }

            if (seconds === 600) {
                location.reload();
            }
        }, 30000);
    }

</script>

<div class="CenterRow">
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
</div>
