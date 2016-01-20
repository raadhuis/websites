<div class="userstatuses form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Edit Userstatus'); ?></h1>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-9">
            <?php echo $this->Form->create('Userstatus', array('role' => 'form')); ?>
            <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
            <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>
            <?php echo $this->Form->end() ?>
        </div>
        <!-- end col md 9 -->
    </div>
    <!-- end row -->
</div>
