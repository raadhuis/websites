<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Migratie Statussen')); ?>


<!-- end row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;Toevoegen'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
                </div>
            </div>
            <!-- /.panel-heading -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('sorting'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($migrations as $migration): ?>
                    <tr>
                        <td><?php echo h($migration['Migration']['name']); ?></td>
                        <td><?php echo h($migration['Migration']['sorting']); ?></td>
                        <td><?php echo h($migration['Migration']['modified']); ?></td>
                        <td><?php echo h($migration['Migration']['created']); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $migration['Migration']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $migration['Migration']['id']), array(), __('Are you sure you want to delete # %s?', $migration['Migration']['id'])); ?>
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
<!-- end row -->
