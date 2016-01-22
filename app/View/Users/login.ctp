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
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Inloggen</h1>
                    </div>
                    <div class="panel-body">
                        <div class="users form">
                            <?php echo $this->Form->create('User'); ?>
                            <?php echo $this->Form->input('email', array('label' => false, 'placeholder' => 'E-mailaddress')); ?>
                            <?php echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Wachtwoord')); ?>
                            <?php echo $this->Form->submit('Log In', array('div' => false, 'class' => 'btn btn-primary')) ?> &nbsp;&nbsp;<a
                                href="/users/forgotpassword/" rel="nofollow">Wachtwoord vergeten?</a>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>

        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
</div>
