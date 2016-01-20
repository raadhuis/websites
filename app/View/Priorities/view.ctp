<div class="priorities view">
<h2><?php echo __('Priority'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Priority'), array('action' => 'edit', $priority['Priority']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Priority'), array('action' => 'delete', $priority['Priority']['id']), array(), __('Are you sure you want to delete # %s?', $priority['Priority']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Priorities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Priority'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Checks'), array('controller' => 'checks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check'), array('controller' => 'checks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Checks'); ?></h3>
	<?php if (!empty($priority['Check'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Checkcategory Id'); ?></th>
		<th><?php echo __('Function'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Priority Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($priority['Check'] as $check): ?>
		<tr>
			<td><?php echo $check['id']; ?></td>
			<td><?php echo $check['checkcategory_id']; ?></td>
			<td><?php echo $check['function']; ?></td>
			<td><?php echo $check['name']; ?></td>
			<td><?php echo $check['description']; ?></td>
			<td><?php echo $check['priority_id']; ?></td>
			<td><?php echo $check['modified']; ?></td>
			<td><?php echo $check['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'checks', 'action' => 'view', $check['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'checks', 'action' => 'edit', $check['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'checks', 'action' => 'delete', $check['id']), array(), __('Are you sure you want to delete # %s?', $check['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Check'), array('controller' => 'checks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
