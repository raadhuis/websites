<div class="checks view">
<h2><?php echo __('Check'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($check['Check']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checkcategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($check['Checkcategory']['name'], array('controller' => 'checkcategories', 'action' => 'view', $check['Checkcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($check['Check']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($check['Check']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priority'); ?></dt>
		<dd>
			<?php echo $this->Html->link($check['Priority']['name'], array('controller' => 'priorities', 'action' => 'view', $check['Priority']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Function'); ?></dt>
		<dd>
			<?php echo h($check['Check']['function']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($check['Check']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($check['Check']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Check'), array('action' => 'edit', $check['Check']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Check'), array('action' => 'delete', $check['Check']['id']), array(), __('Are you sure you want to delete # %s?', $check['Check']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Checks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Checkcategories'), array('controller' => 'checkcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Checkcategory'), array('controller' => 'checkcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Priorities'), array('controller' => 'priorities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Priority'), array('controller' => 'priorities', 'action' => 'add')); ?> </li>
	</ul>
</div>
