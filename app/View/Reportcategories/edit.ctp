<div class="reportcategories form">
    <?php echo $this->Form->create('Reportcategory'); ?>
    <fieldset>
        <legend><?php echo __('Edit Reportcategory'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('icon');
        echo $this->Form->input('description');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
