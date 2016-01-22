<div class="heading">
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>Wachtwoord vergeten</h1>

                <p class="lead">Wanneer je je wachtwoord vergeten bent is dat geen probleem. Vul hier je e-mailadres in en wij sturen je een bericht waarmee je je wachtwoord opnieuw kunt instellen.</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <div class="col-md-12">
                    <?php echo $this->Session->flash(); ?>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title">Wachtwoord vergeten</h1>
                        </div>
                        <div class="panel-body">
                            <div class="users form">
                                <?php echo $this->Form->create('User'); ?>
                                <fieldset>
                                    <?php echo $this->Form->input('email', array('label' => false, 'placeholder' => 'E-mailaddress')); ?>
                                    <?php echo $this->Form->submit('E-mail mij zodat ik mijn wachtwoord kan achterhalen', array('class' => 'btn btn-primary')) ?>
                                    <?php echo $this->Form->end(); ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="/" class="btn"><i class="fa fa-arrow-left"></i> Terug naar de frontpage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
