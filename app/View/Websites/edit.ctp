<div class="websites form">
    <?php echo $this->Form->create('Website'); ?>
    <fieldset>
        <h1>Website bewerken</h1>
        <?= $this->Form->input('id'); ?>
        <div class="row">
            <div
                class="col-md-6">
                <legend><?php echo __('Algemeen'); ?></legend>
                <?= $this->Form->input('customer_id', array('class' => 'form-control', 'label' => 'Organisatie, eigenaar van de website')); ?>
                <?= $this->Form->input('name', array('class' => 'form-control', 'label' => 'Hoofddomein van de website')); ?>
                <?= $this->Form->input('url', array('class' => 'form-control', 'label' => 'Exacte url van de website')); ?>
                <?= $this->Form->input('responsive', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Website Responsive?', 'options' => array('1' => '<i class=\'material-icons\'>done</i> Ja', '0' => '<i class=\'material-icons\'>report_problem</i> Nee'))); ?>
            </div>
            <div class="col-md-6">
                <legend><?php echo __('MODX gerelateerd'); ?></legend>
                <?= $this->Form->input('modxversion', array('class' => 'form-control', 'label' => 'MODX Versie')); ?>
                <?= $this->Form->input('note', array('class' => 'form-control', 'label' => 'Notitie voor update')); ?>
                <?= $this->Form->input('updatenoodzakelijk', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Update Noodzakelijk?', 'options' => array('0' => 'Onbekend', '1' => 'Ja', '2' => 'Nee'))); ?>
                <?= $this->Form->input('klantakkoord', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Update status', 'options' =>
                    array(
                        '0' => 'Nog niets gedaan',
                        '5' => 'Contact Opgenomen',
                        '7' => 'Contact Opgenomen (reminder)',
                        '1' => 'Klant Akkoord',
                        '2' => 'In Betty ingevoerd',
                        '6' => 'Update klaar nog niet gecommuniceerd',
                        '3' => 'Afgerond - uitgevoerd',
                        '4' => 'Afgerond - niet uitgevoerd'
                    )));
                ?>
            </div>
            <div class="col-md-6">
                <legend><?php echo __('Share add/this instellingen'); ?></legend>
                <?= $this->Form->input('shareaanwezig', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Share Aanwezig', 'options' => array('0' => 'Onbekend', '1' => 'Ja', '2' => 'Nee'))); ?>
                <?= $this->Form->input('soortshare', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Soort Share', 'options' => array('0' => 'Onbekend', '1' => 'share add/this', '2' => 'custom share'))); ?>
            </div>

        </div>
    </fieldset>
    <?php echo $this->Form->submit(__('Opslaan'), array('class' => 'btn btn-primary')); ?>
    <?php echo $this->Form->end() ?>
</div>
