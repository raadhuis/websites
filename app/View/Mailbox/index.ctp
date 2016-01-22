<?php echo $this->Element('title', array('icon' => 'mail', 'title' => 'Help')); ?>


<div class="container-fluid">

    <?php if ($total_count == 0) { ?>
        <h3>Geen bestaande conversaties aanwezig</h3>
    <?php } else {
        ?>
        <!-- end row -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="btn-toolbar" role="toolbar" aria-label="...">

                            <div class="btn-group" role="group" aria-label="...">
                                <?php for ($i = 1; $i < $total_pages + 1; $i++) { ?>
                                    <a type="button"
                                       class="btn btn-default<?php if ($current_page == $i) { ?> active<?php } ?>"
                                       href="/mailbox/index/<?php echo $i ?>"><?php echo $i ?></a>
                                <?php } ?>
                            </div>

                            <div class="btn-group">
                                <?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;Nieuw bericht'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Laatste reactie</th>
                            <th>Samenvatting</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tickets as $t):

                            ?>
                            <tr>
                                <td><?php echo h($this->Time->timeAgoInWords($t['updated_at'])) ?>&nbsp;</td>
                                <td><h4> <span class="label label-info"><?php echo$t['closed_by']?></span></h4><br />

                                    <strong><?php echo h($t['title']) ?></strong> <?php echo h($t['summary']) ?>&nbsp;</td>
                                <td><span class="label label-default">#<?php echo h($t['number']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="panel-footer">

                        <div class="btn-toolbar" role="toolbar" aria-label="...">

                            <div class="btn-group" role="group" aria-label="...">
                                <?php for ($i = 1; $i < $total_pages + 1; $i++) { ?>
                                    <a type="button"
                                       class="btn btn-default<?php if ($current_page == $i) { ?> active<?php } ?>"
                                       href="/mailbox/index/<?php echo $i ?>"><?php echo $i ?></a>
                                <?php } ?>
                            </div>

                            <div class="btn-group">
                                <?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;Nieuw bericht'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col md 9 -->
        </div>
    <?php } ?>
    <!-- end row -->
</div>