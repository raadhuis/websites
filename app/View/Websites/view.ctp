<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Website details')); ?>

<div class="row">
    <div class="col-sm-3 col-md-5">
        <div class="well">
            <img
                src="/websites/display/<?php echo $website['Website']['id'] ?>/1920"
                class="img-thumbnail" width="100%"></div>
    </div>
    <div class="col-md-3 col-sm-6">
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
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="well">
            <?php echo $this->element('customer', array('customer' => $customer)) ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="well">
            <?php echo $this->element('accountmanager', array('user_data' => $website['Customer']['User'])) ?>
        </div>
    </div>
    <div class="col-md-7 col-sm-12">
        <div class="well">
            <h3>Hosting</h3>
            <?php pr($website) ?>
        </div>
    </div>
    <?php if ($website['Website']['uptimerobot_id'] != '0') { ?>
        <div class="col-md-12 col-sm-12">
            <?php echo $this->Element('monitoring'); ?>
        </div>
    <?php } ?>
</div>
