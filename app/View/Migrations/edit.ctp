<div class="checkcategories form">
<?php echo $this->Form->create('Migration'); ?>
	<fieldset>
		<legend><?php echo __('Edit Migration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sorting');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Opslaan')); ?>
</div>
