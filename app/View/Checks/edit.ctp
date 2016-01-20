<div class="checks form">
<?php echo $this->Form->create('Check'); ?>
	<fieldset>
		<legend><?php echo __('Edit Check'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('checkcategory_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('priority_id');
		echo $this->Form->input('function');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Check.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Check.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Checks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Checkcategories'), array('controller' => 'checkcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Checkcategory'), array('controller' => 'checkcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Priorities'), array('controller' => 'priorities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Priority'), array('controller' => 'priorities', 'action' => 'add')); ?> </li>
	</ul>
</div>
