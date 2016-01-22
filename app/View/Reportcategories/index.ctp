<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Rapportage Categorieën')); ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('Toevoegen'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
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
                <?php foreach ($reportcategories as $Reportcategory): ?>
                    <tr>
                        <td><?php echo h($Reportcategory['Reportcategory']['id']); ?>&nbsp;</td>
                        <td><?php echo h($Reportcategory['Reportcategory']['name']); ?>&nbsp;</td>
                        <td><?php echo h($Reportcategory['Reportcategory']['modified']); ?>&nbsp;</td>
                        <td><?php echo h($Reportcategory['Reportcategory']['created']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $Reportcategory['Reportcategory']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Reportcategory['Reportcategory']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Reportcategory['Reportcategory']['id']), array(), __('Are you sure you want to delete # %s?', $Reportcategory['Reportcategory']['id'])); ?>
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
