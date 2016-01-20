<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><i class="fa fa-user"></i> <?php echo __('Contactpersoon'); ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Contactgegevens bewerken</h1>
            </div>
            <div class="panel-body">
                <div class="users form">
                    <?php echo $this->Form->create('User', array('role' => 'form')); ?>
                    <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
                    <div class="row">

                        <? if ($role == 'admin' || $role == 'manager') { ?>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('role_id', array('class' => 'form-control', 'placeholder' => 'Role Id')); ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('userstatus_id', array('class' => 'form-control', 'placeholder' => 'Userstatus Id')); ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('customer_id', array('class' => 'form-control', 'placeholder' => 'Customer Id')); ?>
                            </div>
                        <? } else { ?>
                            <?php echo $this->Form->hidden('role_id'); ?>
                            <?php echo $this->Form->hidden('userstatus_id'); ?>
                            <?php echo $this->Form->hidden('customer_id'); ?>
                        <? } ?>

                        <div class="col-md-4">
                            <?php echo $this->Form->input('title_id', array('class' => 'form-control', 'placeholder' => 'Title Id')); ?>
                        </div>
                        <? if ($role == 'admin' || $role == 'manager') { ?>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
                            </div>
                        <? } else { ?>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'E-mailadres')); ?>
                            </div>
                        <? } ?>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'Voornaam')); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $this->Form->input('middle_name', array('class' => 'form-control', 'placeholder' => 'Tussenvoegsel')); ?>
                        </div>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Achternaam')); ?>
                        </div>
                        <hr>
                    </div>
                    <?php echo $this->Form->submit(__('Opslaan'), array('class' => 'btn btn-primary')); ?>
                    <?php echo $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>