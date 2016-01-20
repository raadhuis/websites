<?= $this->Element('title', array('icon' => 'web', 'title' => 'Check Categorieeen')); ?>


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
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($checkcategories as $checkcategory): ?>
                    <tr>
                        <td><?php echo h($checkcategory['Checkcategory']['id']); ?>&nbsp;</td>
                        <td><?php echo h($checkcategory['Checkcategory']['name']); ?>&nbsp;</td>
                        <td><?php echo h($checkcategory['Checkcategory']['modified']); ?>&nbsp;</td>
                        <td><?php echo h($checkcategory['Checkcategory']['created']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $checkcategory['Checkcategory']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $checkcategory['Checkcategory']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $checkcategory['Checkcategory']['id']), array(), __('Are you sure you want to delete # %s?', $checkcategory['Checkcategory']['id'])); ?>
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
