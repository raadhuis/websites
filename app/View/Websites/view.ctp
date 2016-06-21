<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Website details')); ?>

<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="well">
            <h3>Website</h3>
            <dl>
                <dt>Naam</dt>
                <dd><a href="<?php echo $website["Website"]['url']; ?>"
                       target="_blank"><?php echo $website["Website"]['name']; ?></a></dd>
                <?php if (!empty($website["Website"]['note'])) { ?>
                    <dt>Notitie</dt>
                    <dd><?php echo $website["Website"]['note']; ?></dd>
                <?php } ?>
                <?php if (!empty($website["Website"]['modxversion'])) { ?>
                    <dt>MODX Versie</dt>
                    <dd><?php echo $website["Website"]['modxversion']; ?></dd>
                <?php } ?>
            </dl>
            <img
                src="/websites/display/<?php echo $website['Website']['id'] ?>/1920"
                class="img-thumbnail" width="100%">
            <a class="btn" href="/websites/generate/<?php echo $website['Website']['id'] ?>">Afbeelding verversen</a>
        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="well">
            <h3>Hosting Details</h3>
            <?php if (count($website["Hosting"]) > 0) { ?>
                <h4>Pakket: <?php echo $website['Hosting'][0]['Hostingpackage']['name'] ?></h4>
                <p>Aangemaakt op <?php echo $website["Hosting"][0]['created']; ?>
                    door <?php echo $website['Hosting'][0]['User']['name']; ?>.</p>
                <div class="row">

                    <? foreach ($website["Hosting"] as $key => $h) { ?>
                        <div class="col-md-6 col-sm-12">
                            <h4><?php echo $h['Server']['name'] ?></h4>
                            <? if (isset($server_data[$h['hostname']])) { ?>
                                <dl>
                                    <dt>Ipadres</dt>
                                    <dd><?php echo $server_data[$h['hostname']]['config']['ip'] ?></dd>
                                    <dt>Dataverkeer gebruik en limiet per maand</dt>
                                    <dd>Huidig gebruik is <? echo round($server_data[$h['hostname']]['usage']['bandwidth'],2, PHP_ROUND_HALF_UP);?>MB en limiet is
                                        <? echo $server_data[$h['hostname']]['config']['bandwidth']?>MB.
                                        <?
                                        $percentage = round((100 / $server_data[$h['hostname']]['config']['bandwidth']) * $server_data[$h['hostname']]['usage']['bandwidth'], 2, PHP_ROUND_HALF_UP);
                                        ?>
                                        <div class="progress">
                                            <? if ($percentage < 75) { ?>
                                                <div class="progress-bar progress-bar-success"
                                                     style="width: <?= $percentage + 10 ?>%">
                                                    <span><?= $percentage ?>%</span>
                                                </div>
                                                <div class="progress-bar progress-bar-default"
                                                     style="width: <?= 100-$percentage-10 ?>%">
                                                    <span><?= 100-$percentage ?>%</span>
                                                </div>
                                            <? } elseif ($percentage > 75 && $percentage < 100) { ?>
                                                <div class="progress-bar progress-bar-danger"
                                                     style="width: <?= $percentage ?>%">
                                                    <span><?= $percentage ?>%</span>
                                                </div>
                                                <div class="progress-bar progress-bar-default"
                                                     style="width: <?= 100-$percentage ?>%">
                                                    <span><?= 100-$percentage ?>%</span>
                                                </div>
                                            <? } else { ?>
                                                <div class="progress-bar progress-bar-danger"
                                                     style="width: <?= $percentage ?>%">
                                                    <span><?= $percentage ?>%</span>
                                                </div>
                                            <? } ?>
                                        </div>
                                    </dd>
                                    <dt>Schijfruimte gebruik en limiet per maand</dt>
                                    <dd>Huidig gebruik is <? echo round($server_data[$h['hostname']]['usage']['quota']+($server_data[$h['hostname']]['usage']['db_quota']/1024/1024),2, PHP_ROUND_HALF_UP);?>MB en limiet is
                                        <? echo $server_data[$h['hostname']]['config']['quota']?>MB.
                                        <?
                                        $percentage = round((100 / $server_data[$h['hostname']]['config']['quota']) * $server_data[$h['hostname']]['usage']['quota']+($server_data[$h['hostname']]['usage']['db_quota']/1024/1024), 2, PHP_ROUND_HALF_UP);
                                        ?>
                                        <div class="progress">
                                            <? if ($percentage < 75) { ?>
                                                <div class="progress-bar progress-bar-success"
                                                     style="width: <?= $percentage + 10 ?>%">
                                                    <span><?= $percentage ?>%</span>
                                                </div>
                                                <div class="progress-bar progress-bar-default"
                                                     style="width: <?= 100-$percentage-10 ?>%">
                                                    <span><?= 100-$percentage ?>%</span>
                                                </div>
                                            <? } elseif ($percentage > 75 && $percentage < 100) { ?>
                                                <div class="progress-bar progress-bar-danger"
                                                     style="width: <?= $percentage ?>%">
                                                    <span><?= $percentage ?>%</span>
                                                </div>
                                                <div class="progress-bar progress-bar-default"
                                                     style="width: <?= 100-$percentage ?>%">
                                                    <span><?= 100-$percentage ?>%</span>
                                                </div>
                                            <? } else { ?>
                                                <div class="progress-bar progress-bar-danger"
                                                     style="width: <?= $percentage ?>%">
                                                    <span><?= $percentage ?>%</span>
                                                </div>
                                            <? } ?>
                                        </div>
                                    </dd>
                                </dl>
                            <?php } ?>
                            <div class="panel-group" id="accordion<?php echo $key ?>">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse"
                                               data-parent="#accordion<?php echo $key ?>"
                                               href="#collapseOne<?php echo $key ?>">
                                                SSH / SFTP gegevens
                                            </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="collapseOne<?php echo $key ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <dl>
                                                <dt>Gebruikersnaam</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['username'] ?>"
                                                               placeholder="Gebruikersnaam"
                                                               id="copy-input1">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button1"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
        <i class="fa fa-clipboard"></i>
      </button>
    </span>
                                                    </div>

                                                </dd>
                                                <dt>Wachtwoord</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['password'] ?>"
                                                               placeholder="Wachtwoord"
                                                               id="copy-input2">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button2"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
        <i class="fa fa-clipboard"></i>
      </button>
    </span>
                                                    </div>

                                                </dd>
                                                <dt>Webserver</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['hostname'] ?>"
                                                               placeholder="Server adres"
                                                               id="copy-input3">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button3"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
        <i class="fa fa-clipboard"></i>
      </button>
    </span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse"
                                               data-parent="#accordion<?php echo $key ?>"
                                               href="#collapseTwo<?php echo $key ?>">
                                                Database gegevens
                                            </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo<?php echo $key ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <dl>
                                                <dt>Database naam</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['database_name'] ?>"
                                                               placeholder="Database naam"
                                                               id="copy-input4">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button4"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
        <i class="fa fa-clipboard"></i>
      </button>
    </span>
                                                    </div>
                                                </dd>
                                                <dt>Gebruikersnaam</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['database_username'] ?>"
                                                               placeholder="Gebruikersnaam"
                                                               id="copy-input5">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button5"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
                <i class="fa fa-clipboard"></i>

      </button>
    </span>
                                                    </div>
                                                </dd>
                                                <dt>Wachtwoord</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['database_password'] ?>"
                                                               placeholder="Wachtwoord"
                                                               id="copy-input6">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button6"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
        <i class="fa fa-clipboard"></i>
      </button>
    </span>
                                                    </div>
                                                </dd>
                                                <dt>Database server</dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $h['database_host'] ?>"
                                                               placeholder="Hostname"
                                                               id="copy-input7">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" id="copy-button7"
              data-toggle="tooltip" data-placement="bottom"
              title="Kopieer naar klembord">
        <i class="fa fa-clipboard"></i>
      </button>
    </span>
                                                    </div>
                                                </dd>
                                                </dd>

                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                    <div class="col-md-12 col-sm-12">
                        <a class="btn btn-default" href="/websites/ftppass/<?php echo $h['id'] ?>" target="_blank">download
                            .ftppass</a>
                    </div>
                </div>

            <?php } else { ?>
                <p>Er is nog geen hosting aanwezig bij deze website.</p><a href="/hosting/add"
                                                                           class="btn btn-primary">Hosting
                    Toevoegen</a>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-5 col-sm-6">

        <div class="well">
            <h3>Account</h3>
            <?php echo $this->element('customer', array('customer' => $customer)) ?>
            <?php echo $this->element('accountmanager', array('user_data' => $website['Customer']['User'])) ?>
        </div>
    </div>

    <?php if ($website['Website']['uptimerobot_id'] != '0') { ?>
        <?php echo $this->Element('monitoring'); ?>
    <?php } ?>
</div>

<script>

    $(document).ready(function () {

        copyDing('#copy-button1', '#copy-input1');
        copyDing('#copy-button2', '#copy-input2');
        copyDing('#copy-button3', '#copy-input3');
        copyDing('#copy-button4', '#copy-input4');
        copyDing('#copy-button5', '#copy-input5');
        copyDing('#copy-button6', '#copy-input6');
        copyDing('#copy-button7', '#copy-input7');

        function copyDing(button, input) {
            $(button).tooltip();
            $(button).bind('click', function () {
                $(input).select();
                try {
                    var success = document.execCommand('copy');
                    if (success) {
                        $(button).trigger('copied', ['Joe!']);
                    } else {
                        $(button).trigger('copied', ['Kopieer met Ctrl-c']);
                    }
                    $(input).select();
                } catch (err) {
                    $(button).trigger('copied', ['Kopieer met Ctrl-c']);
                }
            });

            // Handler for updating the tooltip message.
            $(button).bind('copied', function (event, message) {
                $(this).attr('title', message)
                    .tooltip('fixTitle')
                    .tooltip('show')
                    .delay(1000)
                    .attr('title', "Kopieer naar klembord")
                    .tooltip('fixTitle');
            });

        }

        function toggleChevron(e) {
            $(e.target)
                .prev('.panel-heading')
                .find("i.indicator")
                .toggleClass('glyphicon-chevron-up glyphicon-chevron-down');
        }

        $('#accordion').on('show.bs.collapse', toggleChevron);
        $('#accordion').on('hidden.bs.collapse', toggleChevron);

    });
</script>