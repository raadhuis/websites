<div class="heading">
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>Login</h1>

                <p class="lead">Een website van RAADHUIS voldoet aan onze
                    kwaliteitscriteria. Door hierdoor in te loggen krijgt u inzicht in de kwaliteitsscan van uw
                    website! </p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>
                <?php echo $this->Session->flash(); ?>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <?php echo $this->Session->flash(); ?>
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h1 class="panel-title">Wachtwoord instellen</h1>
                            </div>
                            <div class="panel-body">
                                <div class="users form">
                                    <?php echo $this->Form->create('User'); ?>
                                    <fieldset>
                                        <?= $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' => 'Wachtwoord')); ?>
                                        <?= $this->Form->input('cpassword', array('label' => false, 'type' => 'password', 'placeholder' => 'Herhaal wachtwoord')); ?>
                                        <?php if (!isset($ident)) {
                                            $ident = '';
                                        }
                                        if (!isset($activate)) {
                                            $activate = '';
                                        } ?>
                                        <?php echo $this->Form->hidden('ident', array('value' => $ident)) ?>
                                        <?php echo $this->Form->hidden('activate', array('value' => $activate)) ?>
                                        <?= $this->Form->submit('Reset my password', array('class' => 'btn btn-primary')) ?>
                                        <?php echo $this->Form->end(); ?>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <a href="/" rel="nofollow" class="btn"><i class="fa fa-arrow-left"></i> Terug naar de voorpagina</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>