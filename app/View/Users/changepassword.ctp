<?php echo $this->Element('title', array('icon' => 'lock', 'title' => 'Wachtwoord wijzigen')); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?php echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' => 'Nieuw wachtwoord')); ?>
            <?php echo $this->Form->input('cpassword', array('label' => false, 'type' => 'password', 'placeholder' => 'Bevestig nieuw wachtwoord')); ?>
            <?php echo $this->Form->submit('Wijzig wachtwoord', array('class' => 'btn btn-primary')) ?>
            <?php echo $this->Form->end(); ?>
        </fieldset>
    </div>
</div>