<div class="customers form">
    <?php echo $this->Form->create('Customer'); ?>
    <fieldset>
        <legend><?php echo __('Toevoegen Organisatie'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('user_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>