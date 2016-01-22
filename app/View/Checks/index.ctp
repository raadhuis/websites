<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Websites')); ?>


<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Check'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Checkcategories'), array('controller' => 'checkcategories', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Checkcategory'), array('controller' => 'checkcategories', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Priorities'), array('controller' => 'priorities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Priority'), array('controller' => 'priorities', 'action' => 'add')); ?> </li>
    </ul>
</div>


<?
$oldcategory = '';
?>
<div class="checks index">
    <h1><?php echo __('Checks'); ?></h1>

        <?php foreach ($checks as $check): ?>
                    <?php if($oldcategory <>  $check['Checkcategory']['name']) { ?>
                    <h2><?php echo $this->Html->link($check['Checkcategory']['name'], array('controller' => 'checkcategories', 'action' => 'view', $check['Checkcategory']['id'])); ?></h2>
                    <p class="intro"><?php echo $check['Checkcategory']['description']; ?></p>
                    <?php } ?>
                <h4>
                    <span class="actions">
                        <?php echo $this->Html->link('edit', array('action' => 'edit', $check['Check']['id']),array('class'=>'material-icons')); ?>
                        <?php echo $this->Html->link('search', array('action' => 'view', $check['Check']['id']),array('class'=>'material-icons')); ?>
                        <?php echo $this->Form->postLink('delete', array('action' => 'delete', $check['Check']['id']), array('class'=>'material-icons'), __('Are you sure you want to delete # %s?', $check['Check']['id'])); ?>
                    </span>

                    <?php echo h($check['Check']['name']); ?></h4>
                <p><?php echo nl2br($check['Check']['description']); ?></p>
<!--
                <td>
                    <?php echo $this->Html->link($check['Priority']['name'], array('controller' => 'priorities', 'action' => 'view', $check['Priority']['id'])); ?>
                </td>
                <td><?php echo h($check['Check']['function']); ?>&nbsp;</td>
                <td><?php echo h($check['Check']['modified']); ?>&nbsp;</td>
                <td><?php echo h($check['Check']['created']); ?>&nbsp;</td>
                <td class="actions">
                </td>
                -->
        <?
        $oldcategory = $check['Checkcategory']['name'];

        endforeach; ?>
</div>
