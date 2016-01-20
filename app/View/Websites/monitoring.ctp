<?= $this->Element('title', array('icon' => 'network_check', 'title' => 'Monitoring')); ?>



<? if ($monitoring_inactive) { ?>
    <p>
        Waarom monitoring.
    </p>
<? } ?>


<?php echo $this->Form->create('Website'); ?>
<?php echo $this->Form->hidden('id'); ?>
<? if ($monitoring_inactive) { ?>
    <?php echo $this->Form->hidden('uptimerobot_id'); ?>
<? } ?>
<?php echo $this->Form->end(__('Activeer monitoring')); ?>


<? if (!$monitoring_inactive) { ?>

    <?
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

    echo ($speed / count($d)) / 1000 . ' seconden';


    $a .= ']';
    $l .= ']';
    ?>
    <div class="row">
        <div class="col-md-2">
            <canvas id="monitoringUptime"></canvas>
            Up
            Down
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <h2>Response Time</h2> last 24 hours
            Shows the "instant" that the monitor started returning a response (in ms).
            <canvas id="monitoringChart" height="100px"></canvas>
        </div>
    </div>


    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js" type="text/javascript"></script>

    <script>
        (function () {

            Chart.defaults.global.responsive = true;

            var data = {
                labels: <?=$l?>,
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: <?=$a?>,
                            showXLabels: 10
                    }
                ]
            };

            var ctx = Array();
            ctx[0] = $("#monitoringChart").get(0).getContext("2d");

            var myLineChart = new Chart(ctx[0]).Line(data);

            var data = [
                {
                    value: <?=$alltimeuptimeratio?>,
                    color: "green",
                    highlight: "#FF5A5E",
                    label: "Up"
                },
                {
                    value: <?=100-$alltimeuptimeratio?>,
                    color: "red",
                    highlight: "#5AD3D1",
                    label: "Down"
                }
            ];

            ctx[1] = $("#monitoringUptime").get(0).getContext("2d");

            var myDoughnutChart = new Chart(ctx[1]).Doughnut(data);

        })();
    </script>

<? } ?>