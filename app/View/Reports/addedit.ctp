<?php



echo $this->Form->create('Report', array(
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    )));
echo $this->Form->hidden('id');
echo $this->Form->hidden('website_id', array('value' => $website_id));
echo $this->Form->hidden('check_id', array('value' => $check_id));
echo $this->Form->hidden('user_id', array('value' => $user_id));
?>
<div class="row">
    <div class="col-md-6">
        <?php echo $this->Form->input('reportcategory_id', array('class' => 'form-control', 'placeholder' => 'Status')); ?>
        <?= $this->Form->input('comment', array('class' => 'form-control', 'placeholder' => 'Opmerking aan klant')); ?>
    </div>
    <div class="col-md-6">
        <?= $this->Form->input('internalcomment', array('class' => 'form-control', 'placeholder' => 'Interne opmerking')); ?>
        <?php echo $this->Form->submit(__('Opslaan'), array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?php echo $this->Form->end() ?>
