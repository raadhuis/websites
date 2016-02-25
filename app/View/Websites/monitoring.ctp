<?php echo $this->Element('title', array('icon' => 'network_check', 'title' => 'Monitoring')); ?>



<?php if ($monitoring_inactive) { ?>
    <p>
        Waarom monitoring.
    </p>
<?php } ?>


<?php echo $this->Form->create('Website'); ?>
<?php echo $this->Form->hidden('id'); ?>
<?php if ($monitoring_inactive) { ?>
    <?php echo $this->Form->hidden('uptimerobot_id'); ?>
<?php } ?>
<?php echo $this->Form->end(__('Activeer monitoring')); ?>

<?php if (!$monitoring_inactive) { ?>
    <?php echo $this->Element('monitoring');?>
<?php } ?>