<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Prioriteiten')); ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;Toevoegen'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
                </div>
            </div>
            <!-- /.panel-heading -->
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($priorities as $priority): ?>
                    <tr>
                        <td><?php echo h($priority['Priority']['id']); ?>&nbsp;</td>
                        <td><?php echo h($priority['Priority']['name']); ?>&nbsp;</td>
                        <td><?php echo h($priority['Priority']['modified']); ?>&nbsp;</td>
                        <td><?php echo h($priority['Priority']['created']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $priority['Priority']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $priority['Priority']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $priority['Priority']['id']), array(), __('Are you sure you want to delete # %s?', $priority['Priority']['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->Element('pagination-footer') ?>
        </div>
    </div>
    <!-- end col md 9 -->
</div>