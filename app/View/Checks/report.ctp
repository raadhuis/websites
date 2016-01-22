<?php echo $this->Element('title', array('icon' => 'check', 'title' => 'Rapportage voor '. $website['Website']['name'])); ?>
<?

if($isadmin) {
    $action = 'addedit';
} else {
    $action = 'view';

}

?>

<div class="checks index">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Check</th>
            <th>Resultaat</th>
            <th>Omschrijving</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $oldcategory = '';
        foreach ($checks as $check): ?>
            <?php if ($oldcategory <> $check['Checkcategory']['name']) { ?>
                <tr>
                    <td colspan="4">
                        <h2><?php echo $this->Html->link($check['Checkcategory']['name'], array('controller' => 'checkcategories', 'action' => 'view', $check['Checkcategory']['id'])); ?></h2>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td width="20%"><h4><?php echo h($check['Check']['name']); ?></h4>
                    <p><?php echo$check['Check']['description']?></p>
                </td>
                <td>
                    <?php if ($check['Check']['function']) { ?>
                        <div id="result<?php echo h($check['Check']['id']); ?>"></div>
                        <script>
                            $(function () {
                                $.ajax({
                                    type: 'GET',
                                    async: true,
                                    cache: false,
                                    url: '<?php echo Router::Url(array('controller' => 'checks','action' => $check['Check']['function'].'/'.$website['Website']['id']), TRUE); ?>',
                                    success: function (response) {
                                        $('#result<?php echo h($check['Check']['id']); ?>').html(response);
                                    }
                                });
                            });
                        </script>
                    <?php } else { ?>

                    <?php } ?>
                </td>
                <td>
                    <div id="form<?php echo h($check['Check']['id']); ?>"><img src="/img/loading.gif" width="24px">
                    </div>
                    <script>
                        $(function () {
                            function formbuild<?php echo h($check['Check']['id']); ?>() {
                                $.ajax({
                                    type: 'GET',
                                    async: true,
                                    cache: false,
                                    url: '<?php echo Router::Url(array('controller' => 'reports','action' => $action .'/' . $website['Website']['id'].'/'.$check['Check']['id'].'/'), TRUE); ?>',
                                    success: function (response) {
                                        $('#form<?php echo h($check['Check']['id']); ?>').html(response);

                                        $("#form<?php echo h($check['Check']['id']); ?>>form").submit(function (event) {
                                            // Stop form from submitting normally
                                            event.preventDefault();
                                            // Send the data using post
                                            var posting = $.post($(this).attr("action"), $(this).serializeArray()).done(function (data) {
                                                $("#form<?php echo h($check['Check']['id']); ?>").empty().append('<img src="/img/loading.gif" width="24px">');
                                                if(data=='ok') {
                                                    formbuild<?php echo h($check['Check']['id']); ?>();
                                                } else {
                                                    $("#form<?php echo h($check['Check']['id']); ?>>form").empty().append('Something wend wrong');
                                                }
                                            });
                                        });

                                    }
                                });
                            }
                            formbuild<?php echo h($check['Check']['id']); ?>();
                        });
                    </script>
                </td>
            </tr>
            <?php
            $oldcategory = $check['Checkcategory']['name'];
        endforeach; ?>
        </tbody>
    </table>
</div>
