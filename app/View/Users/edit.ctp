<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><i class="fa fa-user"></i> <?php echo __('Contactpersoon'); ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Contactgegevens bewerken</h1>
            </div>
            <div class="panel-body">
                <div class="users form">
                    <?php echo $this->Form->create('User', array('role' => 'form')); ?>
                    <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
                    <fieldset>
                        <legend>Algemeen</legend>
                        <div class="row">
                            <?php if ($role == 'admin' || $role == 'manager') { ?>
                                <div class="col-md-2">
                                    <?php echo $this->Form->input('role_id', array('class' => 'form-control', 'placeholder' => 'Role Id')); ?>
                                </div>
                                <div class="col-md-2">
                                    <?php echo $this->Form->input('userstatus_id', array('class' => 'form-control', 'placeholder' => 'Userstatus Id')); ?>
                                </div>
                            <?php } else { ?>
                                <?php echo $this->Form->hidden('role_id'); ?>
                                <?php echo $this->Form->hidden('userstatus_id'); ?>
                                <?php echo $this->Form->hidden('customer_id'); ?>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo $this->Form->input('customer_id', array('class' => 'form-control', 'placeholder' => 'Customer Id')); ?>
                            </div>
                        </div>

                        <div class="row">
                            <?php if ($role == 'admin' || $role == 'manager') { ?>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'E-mailadres')); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <?php echo $this->Form->input('title_id', array('class' => 'form-control', 'placeholder' => 'Title Id')); ?>
                            </div>

                            <div class="col-md-4">
                                <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'Voornaam')); ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $this->Form->input('middle_name', array('class' => 'form-control', 'placeholder' => 'Tussenvoegsel')); ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Achternaam')); ?>
                            </div>
                            <hr>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Extra contactgegevens</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo $this->Form->input('phone_number', array('class' => 'form-control', 'placeholder' => '072-12345667')); ?>
                            </div>
                            <div class="col-md-3">
                                <?php echo $this->Form->input('website_url', array('class' => 'form-control', 'placeholder' => 'http://example.com')); ?>
                            </div>
                            <div class="col-md-5">
                                <?php echo $this->Form->input('twitter_username', array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                            <div class="col-md-5">
                                <?php echo $this->Form->input('linkedin_username', array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                            <hr>
                        </div>
                    </fieldset>
                    <?php echo $this->Form->submit(__('Opslaan'), array('class' => 'btn btn-primary')); ?>
                    <?php echo $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>