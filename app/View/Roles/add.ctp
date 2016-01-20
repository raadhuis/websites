<div class="roles form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Add Role'); ?></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Form->create('Role', array('role' => 'form')); ?>
            <?php echo $this->Form->input('displayname', array('class' => 'form-control', 'placeholder' => 'Displayname')); ?>
            <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
            <br><?php echo $this->Form->textarea('description', array('class' => 'form-control wysiwyg', 'rows' => '5')); ?><br>
            <?php echo $this->Form->input('max', array('class' => 'form-control', 'placeholder' => 'Max')); ?>
            <?php echo $this->Form->input('min', array('class' => 'form-control', 'placeholder' => 'Min')); ?>
            <?php echo $this->Form->input('inviteable', array('class' => 'form-control')); ?>
            <?php echo $this->Form->input('isteammember', array('class' => 'form-control')); ?>
            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>
