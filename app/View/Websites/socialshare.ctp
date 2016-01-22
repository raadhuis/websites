<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Social Share')); ?>

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
                    <th>Organisatie</th>
                    <th>MODX Versie</th>
                    <th class="text-center">Share Aanwezig</th>
                    <th class="text-center">Soort Share</th>
                    <th class="text-center">Share Status</th>
                    <th class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($websites as $website): ?>
                    <tr>
                        <td><a href="<?php echo h($website['Website']['url']); ?>" target="_blank"><i
                                    class='material-icons'>call_made</i></a></td>
                        <td><?php echo h($website['Website']['name']); ?>&nbsp;</td>
                        <td><?php echo h($website['Customer']['name']); ?>&nbsp;</td>
                        <td><?php echo h($website['Website']['modxversion']); ?>&nbsp;</td>
                        <td>
                            <?php if($website['Website']['shareaanwezig'] == '0') { echo 'onbekend';} ?>
                            <?php if($website['Website']['shareaanwezig'] == '1') { echo 'ja';} ?>
                            <?php if($website['Website']['shareaanwezig'] == '2') { echo 'nee';} ?>
                        </td>
                        <td>
                            <?php if($website['Website']['soortshare'] == '0') { echo 'onbekend';} ?>
                            <?php if($website['Website']['soortshare'] == '1') { echo 'share/add this';} ?>
                            <?php if($website['Website']['soortshare'] == '2') { echo 'custom share';} ?>
                        </td>
                        <td>
                            <?php if($website['Website']['sharestatus'] == '0') { echo 'Nog niets gedaan';} ?>
                            <?php if($website['Website']['sharestatus'] == '5') { echo 'Contact Opgenomen';} ?>
                            <?php if($website['Website']['sharestatus'] == '7') { echo 'Contact Opgenomen (reminder)';} ?>
                            <?php if($website['Website']['sharestatus'] == '1') { echo 'Klant Akkoord';} ?>
                            <?php if($website['Website']['sharestatus'] == '2') { echo 'In Betty ingevoerd';} ?>
                            <?php if($website['Website']['sharestatus'] == '6') { echo 'Update klaar nog niet gecommuniceerd';} ?>
                            <?php if($website['Website']['sharestatus'] == '8') { echo 'On Hold';} ?>
                            <?php if($website['Website']['sharestatus'] == '3') { echo 'Afgerond - uitgevoerd';} ?>
                            <?php if($website['Website']['sharestatus'] == '4') { echo 'Afgerond - niet uitgevoerd';} ?>
                            &nbsp;</td>

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
