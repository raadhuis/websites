<div class="users index">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header"><?php echo __('Contactpersonen'); ?></h1>
            <? if ($notadmin) { ?>
                <p>Hier vind je een overzicht van alle contactpersonen binnen <?= $customer ?>. Het staat je vrij om
                    andere contactpersonen toegang te verlenen tot deze omgeving.</p>
            <? } ?>
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="btn-group col-md-4">
                            <?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;Contactpersoon uitnodigen'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right text-right">
                                        <?php echo $this->Form->create("Filter", array('role' => 'form', 'formStyle' => 'inline', 'url' => $base_url)); ?>
                                        <?php echo $this->Form->input("search", array('div' => false, 'label' => false, 'placeholder' => "Search...", 'style' => 'width:150px')); ?>
                                        <? echo $this->Form->submit("Search", array('div' => false, 'class' => 'btn btn-primary')); ?>
                                        <? echo $this->Form->end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <table cellpadding="0" cellspacing="0" class="table table-striped">
                    <thead>
                    <tr>
                        <? if (!$notadmin) { ?>
                            <th><?php echo $this->Paginator->sort('id'); ?></th>
                            <th><?php echo $this->Paginator->sort('userstatus_id'); ?></th>
                            <th><?php echo $this->Paginator->sort('customer_id'); ?></th>
                            <th><?php echo $this->Paginator->sort('role_id'); ?></th>
                        <? } ?>
                        <th><?php echo $this->Paginator->sort('title_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <? if (!$notadmin) { ?>
                            <th><?php echo $this->Paginator->sort('created'); ?></th>
                            <th><?php echo $this->Paginator->sort('modified'); ?></th>
                        <? } ?>
                        <th class="actions"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <? if (!$notadmin) { ?>
                                <td><?php echo h($user['User']['id']); ?>&nbsp;

                                </td>
                                <td>
                                    <?php echo $this->Html->link($user['Userstatus']['name'], array('controller' => 'userstatuses', 'action' => 'view', $user['Userstatus']['id'])); ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($user['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $user['Customer']['id'])); ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
                                </td>
                            <? } ?>
                            <td>
                                <?php echo $user['Title']['name'] ?>
                            </td>
                            <td><?php echo h($user['User']['name']); ?>&nbsp;
                                <?php if ($user['User']['id'] == $userId) { ?>
                                    <span class="label label-success">Dit ben jij!</span>
                                <? } ?>
                            </td>
                            <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                            <? if (!$notadmin) { ?>
                                <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                                <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                            <? } ?>
                            <td class="actions">
                                <?php if (!$notadmin || $user['User']['id'] == $userId) { ?>


                                    <?php echo $this->Html->link('<button class="btn btn-default"><span class="fa fa-pencil"></span> Bewerken</button>', array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
                                    <?php if ($user['User']['id'] <> $userId) { ?>
                                        <?php echo $this->Form->postLink('<button class="btn btn-default btn-sm"><span class="fa fa-times text-danger"></span> Verwijderen</button>', array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                                    <? } ?>
                                <? } ?>
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
    <?= $this->Element('accountmanager') ?>

    <!-- end row -->
</div><!-- end containing of content -->