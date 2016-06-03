<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Hosting')); ?>

<a href="/hosting/add" class="btn btn-primary">Toevoegen</a>
<br>
<br>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php $count = 0; ?>
    <?php foreach ($results as $key => $result) {
        $count++;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?= $count ?>">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $count ?>"
                       aria-expanded="false" aria-controls="collapse<?= $count ?>">
                        <h3><?php echo $key ?></h3>
                    </a>
                </h4>
            </div>
            <div id="collapse<?= $count ?>" class="panel-collapse collapse" role="tabpanel"
                 aria-labelledby="heading<?= $count ?>">
                <div class="panel-body">
                    <?php if (isset($result[0]['list'])) {

                        $firstLetter = '0';
                        $desiredColumns = 20;  //you can change this!
                        echo "<table border='0' width='100%'><tr><td>";
                        foreach ($result[0]['list'] as $k => $u) {
                            if ($k != 0 && $k % $desiredColumns == 0) echo "</td><td>";
                            if (substr($u,0,1) !== $firstLetter) {
                                echo "<strong>".substr($u,0,1)."</strong> <br />";
                                $firstLetter = substr($u,0,1);
                            }
                            echo "<a href='hosting/user/".$key."/".$u."'>". $u."</a><br/>";
                        }
                    }
                    echo "</td><tr></table>";
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
