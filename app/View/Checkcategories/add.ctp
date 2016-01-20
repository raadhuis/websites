<?= $this->Element('title', array('icon' => 'add', 'title' => 'Nieuwe Check Categorie')); ?>


<div class="checkcategories form">
    <?php echo $this->Form->create('Checkcategory'); ?>
    <fieldset>
        <legend><?php echo __('Add Checkcategory'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('icon');
        echo $this->Form->input('description');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Checkcategories'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Checks'), array('controller' => 'checks', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Check'), array('controller' => 'checks', 'action' => 'add')); ?> </li>
    </ul>
</div>
