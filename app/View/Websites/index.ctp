<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Websites')); ?>

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
                    <th class="text-center">Respon.</th>
                    <th class="text-center">Monitoring</th>
                    <th class="actions" width="120px"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($websites as $website) { ?>


                    <tr>
                        <td><?php echo h($website['Website']['name']); ?>&nbsp;</td>
                        <td><?php echo h($website['Customer']['name']); ?>&nbsp;</td>
                        <td><?php echo $website['Customer']['User']['name'] ?>&nbsp;</td>
                        <td class="text-center"><?php echo $this->element('truefalse', array('status' => $website['Website']['responsive'])); ?>
                            &nbsp;</td>
                        <td class="text-center"><?php echo $this->element('truefalse', array('status' => ($website['Website']['uptimerobot_id'] != '0'))); ?>
                            &nbsp;</td>
                        <td class="actions" width="125px">
                            <!-- Split button -->
                            <div class="btn-group">
                                <?php echo $this->Html->link(__('Bekijk'), array('action' => 'view', $website['Website']['id']), array('class' => 'btn btn-default')); ?>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link(__('Rapportage'), array('controller' => 'checks', 'action' => 'report', $website['Website']['id'])); ?></li>
                                    <?php if ($isadmin) { ?>
                                        <li role="separator" class="divider"></li>
                                        <li><?php echo $this->Html->link(__('Bewerk'), array('action' => 'edit', $website['Website']['id'])); ?></li>
                                        <li><?php echo $this->Form->postLink(__('Verwijderen'), array('action' => 'delete', $website['Website']['id']), __('Are you sure you want to delete # %s?', $website['Website']['id'])); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php echo $this->Element('pagination-footer') ?>
        </div>
    </div>
    <!-- end col md 9 -->
</div>
