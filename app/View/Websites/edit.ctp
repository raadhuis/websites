<div class="websites form">
    <?php echo $this->Form->create('Website'); ?>
    <fieldset>
        <h1>Website bewerken</h1>
        <?php echo $this->Form->input('id'); ?>
        <div class="row">


            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?php echo __('Algemeen'); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php echo $this->Form->input('customer_id', array('class' => 'form-control', 'label' => 'Organisatie, eigenaar van de website')); ?>
                            <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Hoofddomein van de website')); ?>
                            <?php echo $this->Form->input('url', array('class' => 'form-control', 'label' => 'Exacte url van de website')); ?>
                            <?php echo $this->Form->input('responsive', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Website Responsive?', 'options' => array('1' => '<i class=\'material-icons\'>done</i> Ja', '0' => '<i class=\'material-icons\'>report_problem</i> Nee'))); ?>
                            <?php echo $this->Form->input('domainhostedbyus', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Is het primaire domein bij ons gehost?', 'options' => array('1' => '<i class=\'material-icons\'>done</i> Ja', '2' => '<i class=\'material-icons\'>report_problem</i> Nee','3' => '<i class=\'material-icons\'>help</i> Onbekend'))); ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <?php echo __('Migratie'); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <?php echo $this->Form->input('migrationnotes', array('class' => 'form-control', 'label' => 'Notitie voor migratie')); ?>
                            <?php echo $this->Form->input('migration_id', array('class' => 'form-control', 'label' => 'Migratie status')); ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <?php echo __('MODX gerelateerd'); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <?php echo $this->Form->input('modxversion', array('class' => 'form-control', 'label' => 'MODX Versie')); ?>
                            <?php echo $this->Form->input('note', array('class' => 'form-control', 'label' => 'Notitie voor update')); ?>
                            <?php echo $this->Form->input('updatenoodzakelijk', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Update Noodzakelijk?', 'options' => array('0' => 'Onbekend', '1' => 'Ja', '2' => 'Nee'))); ?>
                            <?php echo $this->Form->input('klantakkoord', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Update status', 'options' =>
                                array(
                                    '0' => 'Nog niets gedaan',
                                    '5' => 'Contact Opgenomen',
                                    '7' => 'Contact Opgenomen (reminder)',
                                    '1' => 'Klant Akkoord',
                                    '2' => 'In Betty ingevoerd',
                                    '6' => 'Update klaar nog niet gecommuniceerd',
                                    '8' => 'On Hold',
                                    '3' => 'Afgerond - uitgevoerd',
                                    '4' => 'Afgerond - niet uitgevoerd'
                                )));
                            ?>                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <?php echo __('Share add/this instellingen'); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <?php echo $this->Form->input('shareaanwezig', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Share Aanwezig', 'options' => array('0' => 'Onbekend', '1' => 'Ja', '2' => 'Nee'))); ?>
                            <?php echo $this->Form->input('soortshare', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Soort Share', 'options' => array('0' => 'Onbekend', '1' => 'share add/this', '2' => 'custom share'))); ?>
                            <?php echo $this->Form->input('sharestatus', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Share status', 'options' =>
                                array(
                                    '0' => 'Nog niets gedaan',
                                    '5' => 'Contact Opgenomen',
                                    '7' => 'Contact Opgenomen (reminder)',
                                    '1' => 'Klant Akkoord',
                                    '2' => 'In Betty ingevoerd',
                                    '6' => 'Update klaar nog niet gecommuniceerd',
                                    '8' => 'On Hold',
                                    '3' => 'Afgerond - uitgevoerd',
                                    '4' => 'Afgerond - niet uitgevoerd'
                                )));
                            ?>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->submit(__('Opslaan'), array('class' => 'btn btn-primary')); ?>
    <?php echo $this->Form->end() ?>
</div>




