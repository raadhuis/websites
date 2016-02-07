<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Hosting')); ?>

    <a href="/hosting/add" class="btn btn-primary">Toevoegen</a>

<?php foreach ($results as $key => $result) { ?>
    <h2><?php echo $key?> gebruikers</h2>
    <?php if (isset($result[0]['list'])) { ?>
        <ul>
            <?php foreach ($result[0]['list'] as $u) { ?>
                <li><a href="hosting/user/<?php echo $key?>/<?php echo $u; ?>"><?php echo $u; ?></a></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        geen
    <?php } ?>
<?php } ?>