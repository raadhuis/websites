<div class="heading">
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>Activeren</h1>

                <p class="lead">Je bent uitgenodigd om in te loggen en inzicht te krijgen in de kwaliteitsscan van uw
                    website.</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>
                <?php echo $this->Session->flash(); ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">Activeer uw account</h1>
                    </div>
                    <div class="panel-body">
                        <div class="users form">
                            <?php echo $this->Form->create('User'); ?>
                            <fieldset>
                                <?php if ($role <> 'icgvisitor') { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php echo $this->Form->input('title_id', array('class' => 'form-control', 'label' => 'Aanhef')); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $this->Form->input('first_name', array('label' => 'Voornaam', 'placeholder' => '')); ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo $this->Form->input('middle_name', array('label' => 'Tussenvoegsel', 'placeholder' => '')); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php echo $this->Form->input('last_name', array('label' => 'Achternaam', 'placeholder' => '')); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $this->Form->input('email', array('label' => 'E-mailaddress', 'placeholder' => '')); ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <?php echo $this->Form->hidden('email', array('label' => 'E-mailaddress', 'placeholder' => '')); ?>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo $this->Form->input('password', array('type' => 'password', 'label' => 'Wachtwoord')); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $this->Form->input('cpassword', array('type' => 'password', 'label' => 'Bevestig wachtwoord')); ?>
                                    </div>
                                </div>
                                <?php if (!isset($ident)) {
                                    $ident = '';
                                }
                                if (!isset($activate)) {
                                    $activate = '';
                                } ?>
                                <?php echo $this->Form->hidden('oldemail') ?>
                                <?php echo $this->Form->hidden('ident', array('value' => $ident)) ?>
                                <?php echo $this->Form->hidden('activate', array('value' => $activate)) ?>
                                <?php echo $this->Form->submit('Uw Account activeren', array('class' => 'btn btn-primary btn-block')) ?>
                                <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                    </fieldset>
                </div>
                <p>&nbsp;</p>

                <p>&nbsp;</p>

            </div>
        </div>
    </div>
</div>