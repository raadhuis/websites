<div class="users form">
    <div class="row">
        <div class="col-md-8">
            <div class="page-header">
                <h1><?php echo __('Contactpersoon Uitnodigen'); ?></h1>
                <p>Wanneer je een contactpersoon uitnodigd dan zal er een bericht naar de nieuwe contactpersoon verzonden worden.
                Hierin staat een activatie link waar op geklikt moet worden.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
    <?php echo $this->Form->create('User', array('role' => 'form')); ?>
    <?php echo $this->Form->hidden('userstatus_id', array('value' => 8)); ?>
    <?php if ($isadmin) { ?>
        <div class="row">
            <div class="col-md-6">
                <?php echo $this->Form->input('customer_id', array('class' => 'form-control', 'placeholder' => 'Customer Id')); ?>
            </div>
            <div class="col-md-6">
                <?php echo $this->Form->input('role_id', array('class' => 'form-control', 'placeholder' => 'Role Id')); ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-3">
            <?php echo $this->Form->input('title_id', array('class' => 'form-control', 'placeholder' => 'Title Id')); ?>
        </div>
        <div class="col-md-9">
            <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'E-mailadres')); ?>
        </div>

        <div class="col-md-4">
            <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'First Name')); ?>
        </div>
        <div class="col-md-4">
            <?php echo $this->Form->input('middle_name', array('class' => 'form-control', 'placeholder' => 'Middle Name')); ?>
        </div>
        <div class="col-md-4">
            <?php echo $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Last Name')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $this->Form->submit(__('Toevoegen'), array('class' => 'btn btn-primary')); ?>
    </div>

    <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>
