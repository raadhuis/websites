<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Website Updates')); ?>

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
                    <th>link</th>
                    <th><?php echo $this->Paginator->sort('Website'); ?></th>
                    <th>Contactp.</th>
                    <th>Organisatie</th>
                    <th>Accountmanager</th>
                    <th>MODX versie</th>
                    <th class="text-center">Update Noodzakelijk</th>
                    <th class="text-center">Update Status</th>
                    <th class="text-center">Note</th>

                    <th class="actions"><?php echo __('Acties'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($websites as $website): ?>
                    <tr>
                        <td><a href="<?php echo h($website['Website']['url']); ?>" target="_blank"><i
                                    class='material-icons'>call_made</i></a></td>
                        <td><?php echo h($website['Website']['name']); ?>&nbsp;</td>
                        <td>
                            <?php echo $this->element('truefalse', array('status' => isset($website['Customer']['User'][0]))); ?>
                        </td>
                        <td><?php echo h($website['Customer']['name']); ?>&nbsp;</td>
                        <td><?php echo $website['Customer']['User']['name'] ?>&nbsp;</td>
                        <td><?php echo h($website['Website']['modxversion']); ?>&nbsp;</td>
                        <td class="text-center">
                            <?php if($website['Website']['updatenoodzakelijk'] == '0') { echo '?';} ?>
                            <?php if($website['Website']['updatenoodzakelijk'] == '1') { echo 'ja';} ?>
                            <?php if($website['Website']['updatenoodzakelijk'] == '2') { echo 'nee';} ?>
                            &nbsp;</td>
                        <td>
                            <?php if($website['Website']['klantakkoord'] == '0') { echo 'Nog niets gedaan';} ?>
                            <?php if($website['Website']['klantakkoord'] == '5') { echo 'Contact Opgenomen';} ?>
                            <?php if($website['Website']['klantakkoord'] == '7') { echo 'Contact Opgenomen (reminder)';} ?>
                            <?php if($website['Website']['klantakkoord'] == '1') { echo 'Klant Akkoord';} ?>
                            <?php if($website['Website']['klantakkoord'] == '2') { echo 'In Betty ingevoerd';} ?>
                            <?php if($website['Website']['klantakkoord'] == '6') { echo 'Update klaar nog niet gecommuniceerd';} ?>
                            <?php if($website['Website']['klantakkoord'] == '8') { echo 'On Hold';} ?>
                            <?php if($website['Website']['klantakkoord'] == '3') { echo 'Afgerond - uitgevoerd';} ?>
                            <?php if($website['Website']['klantakkoord'] == '4') { echo 'Afgerond - niet uitgevoerd';} ?>
                            &nbsp;</td>
                        <td class="text-center">
                            <?php if(!empty($website['Website']['note'])) { ?>
                                <i data-toggle="tooltip" data-placement="left" class="material-icons has-tip" title="<?php echo h($website['Website']['note']); ?>">comment</i>
                            <?php } ?>
                        </td>

                        <td class="actions">
                            <?php echo $this->Html->link(__('Bewerk'), array('action' => 'edit', $website['Website']['id']), array('class' => 'btn btn-default')); ?>
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