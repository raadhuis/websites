<?= $this->Element('title', array('icon' => 'work', 'title' => 'Organisaties')); ?>

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
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('user'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo h($customer['Customer']['id']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['name']); ?>&nbsp;</td>
                        <td><?php echo h($customer['User']['name']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['created']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['modified']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $customer['Customer']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $customer['Customer']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $customer['Customer']['id']), array(), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->Element('pagination-footer') ?>
        </div>
    </div>
    <!-- end col md 9 -->
</div>
<!-- end row -->
</div><!-- end containing of content -->