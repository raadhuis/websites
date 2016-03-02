<?php echo $this->Element('title', array('icon' => 'add', 'title' => 'Nieuwe Migratie Statussen')); ?>


<div class="checkcategories form">
    <?php echo $this->Form->create('Migration'); ?>
    <fieldset>
        <legend><?php echo __('Add Migration'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('sorting');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>