<div class="panel-footer">
    <div class="row">
        <div class="col-md-6">
            <p>
                <small><?php echo $this->Paginator->counter(array('format' => __('Pagina {:page} van {:pages}, getoond worden {:current} regels van de {:count} in totaal, startend op regel {:start}, eindigend op {:end}'))); ?></small>
            </p>
        </div>
        <?php  if(isset($export) && $export==true){ ?>
            <div class="col-md-4 text-right">
        <? } else { ?>
            <div class="col-md-6 text-right">
        <? } ?>
            <?php
                $params = $this->Paginator->params();
                if ($params['pageCount'] > 1) {
                    ?>
                    <ul class="pagination pagination-sm">
                        <?php
                            echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                            echo $this->Paginator->next('Next &rarr;', array('class' => 'next', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
                        ?>
                    </ul>
                <?php } ?>
        </div>
        <?php  if(isset($export) && $export == true){ ?>
        <div class="col-md-2 text-right">
                <a href="/export/index/<?php echosubstr($this->request->params['controller'],0,-1)?>" class="btn btn-default"><i class="fa fa-download"></i> Download CSV</a>
        </div>
        <?php } ?>
    </div>
</div>