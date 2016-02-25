<?php

$alltimeuptimeratio = $monitoring->monitors->monitor[0]->alltimeuptimeratio;

$d = $monitoring->monitors->monitor[0]->responsetime;
asort($d);
$a = '[';
$l = '[';
$speed = 0;
foreach ($d as $f) {
    $speed += $f->value;
    if ($a == '[') {
        $a .= $f->value;
    } else {
        $a .= ',' . $f->value;
    }

    if ($l == '[') {
        $l .= '"' . date("j M H:i", (strtotime($f->datetime))) . '"';
    } else {
        $l .= ',"' . date("j M H:i", (strtotime($f->datetime))) . '"';
    }
}

// ($speed / count($d)) / 1000 . ' seconden'

$a .= ']';
$l .= ']';
?>
<div class="row">
    <div class="col-md-2 col-sm-4">
        <div class="well">
            <h2>Online</h2>
            <canvas id="monitoringUptime"></canvas>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="well">
            <h2>Snelheid <small>Laatste 24 uur</small></h2>
            Wij monitoren uw website elke 5 minuten in de afgelopen 24 uur. Hier ziet u exact de snelheid van het downloaden van een pagina van uw website. Het aantal wordt in milliseconden weergegeven.
            <canvas id="monitoringChart" height="100px"></canvas>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js" type="text/javascript"></script>
<script>
    (function () {

        Chart.defaults.global.responsive = true;

        var data = {
            labels: <?php echo$l?>,
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $a?>,
                    showXLabels: 10
                }
            ]
        };

        var ctx = Array();
        ctx[0] = $("#monitoringChart").get(0).getContext("2d");

        var myLineChart = new Chart(ctx[0]).Line(data);

        var data = [
            {
                value: <?php echo $alltimeuptimeratio?>,
                color: "green",
                highlight: "#FF5A5E",
                label: "Percentage online"
            },
            {
                value: <?php echo 100-$alltimeuptimeratio?>,
                color: "red",
                highlight: "#5AD3D1",
                label: "Percentage offline"
            }
        ];

        ctx[1] = $("#monitoringUptime").get(0).getContext("2d");

        var myDoughnutChart = new Chart(ctx[1]).Doughnut(data);

    })();
</script>