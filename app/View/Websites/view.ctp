<div class="websites view">
<h2><?php echo __('Website'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($website['Website']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($website['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $website['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($website['Website']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($website['Website']['url']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Website'), array('action' => 'edit', $website['Website']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Website'), array('action' => 'delete', $website['Website']['id']), array(), __('Are you sure you want to delete # %s?', $website['Website']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Websites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Website'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
