<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Website Migratie')); ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <?php if ($isadmin) { ?>
                <div class="panel-heading">
                    <div class="btn-group">
                        <?php echo $this->Html->link(__('Toevoegen'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
                    </div>
                </div>
            <?php } ?>
            <!-- /.panel-heading -->
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Website'); ?></th>
                    <th>Organisatie</th>
                    <th>Accountmanager</th>
                    <th>Status</th>
                    <th class="text-center">Domein van ons</th>
                    <th class="text-center">Note</th>
                    <th class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($websites as $website): ?>
                    <tr>
                        <td><?php echo h($website['Website']['name']); ?></td>
                        <td><?php echo h($website['Customer']['name']); ?></td>
                        <td><?php echo $website['Customer']['User']['name'] ?></td>
                        <td><?php echo $website['Migration']['name'] ?></td>
                        <td class="text-center">
                            <?php if($website['Website']['domainhostedbyus']==1) { ?><i class='material-icons'>done</i><?php } ?>
                            <?php if($website['Website']['domainhostedbyus']==2) { ?><i class='material-icons'>report_problem</i><?php } ?>
                            <?php if($website['Website']['domainhostedbyus']==3) { ?><i class='material-icons'>help</i><?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($website['Website']['migrationnotes'])) { ?>
                                <i data-toggle="tooltip" data-placement="left" class="material-icons has-tip"
                                   title="<?php echo h($website['Website']['migrationnotes']); ?>">comment</i>
                            <?php } ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('Bekijk'), array('action' => 'view', $website['Website']['id']), array('class' => 'btn btn-sm btn-default')); ?>
                            <?php echo $this->Html->link(__('Bewerk'), array('action' => 'edit', $website['Website']['id']), array('class' => 'btn btn-sm btn-primary')); ?>
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
