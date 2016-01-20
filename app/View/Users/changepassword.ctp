<?= $this->Element('title', array('icon' => 'lock', 'title' => 'Wachtwoord wijzigen')); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?= $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' => 'Nieuw wachtwoord')); ?>
            <?= $this->Form->input('cpassword', array('label' => false, 'type' => 'password', 'placeholder' => 'Bevestig nieuw wachtwoord')); ?>
            <?= $this->Form->submit('Wijzig wachtwoord', array('class' => 'btn btn-primary')) ?>
            <?php echo $this->Form->end(); ?>
        </fieldset>
    </div>
</div>