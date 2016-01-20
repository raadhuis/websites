<div class="users form">
    <?= $this->Element('notloggedin_header', array('active' => 'products')); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 bottom2">
            <h2 class="page-header text-center"><?php echo __('Please to meet you!'); ?></h2>

            <p class="text-center">Once you have activated your account you can fully purchase the packages you just configured.</p>
        </div>
        <!-- end col md 12 -->
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 bottom2">
            <?= $this->Element('shop_header', array('step' => 2)); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default packages">
                <div class="panel-heading">
                    <h1 class="panel-title">Sign Up</h1>
                </div>
                <div class="panel-body">
                    <?php echo $this->Form->create('User'); ?>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $this->Form->input('title_id', array('class' => 'form-control', 'placeholder' => 'Userstatus Id')); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'label' => 'First Name', 'placeholder' => '')); ?>
                            </div>
                            <div class="col-md-3">
                                <?php echo $this->Form->input('middle_name', array('class' => 'form-control', 'label' => 'Middle Name', 'placeholder' => '')); ?>
                            </div>
                            <div class="col-md-5">
                                <?php echo $this->Form->input('last_name', array('class' => 'form-control', 'label' => 'Last Name', 'placeholder' => '')); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $this->Form->input('email', array('label' => 'Email Address', 'placeholder' => '')); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $this->Form->submit('Send Activation Email', array('class' => 'btn btn-primary btn-lg btn-block')) ?>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </fieldset>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>