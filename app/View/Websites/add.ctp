<div class="websites form">
    <?php echo $this->Form->create('Website'); ?>
    <fieldset>
        <legend><?php echo __('Add Website'); ?></legend>
        <div class="row">
            <div
                class="col-md-6"><?= $this->Form->input('customer_id', array('class' => 'form-control', 'label' => 'Organisatie, eigenaar van de website')); ?></div>
        </div>
        <div class="row">
            <div
                class="col-md-6"><?= $this->Form->input('name', array('class' => 'form-control', 'label' => 'Hoofddomein van de website')); ?></div>
            <div
                class="col-md-6"><?= $this->Form->input('note', array('class' => 'form-control', 'label' => 'Notitie bij deze website')); ?></div>
            <div
                class="col-md-6"><?= $this->Form->input('url', array('class' => 'form-control', 'label' => 'Exacte url van de website')); ?></div>
            <div
                class="col-md-4"><?= $this->Form->input('modxversion', array('class' => 'form-control', 'label' => 'MODX Versie')); ?></div>
            <div
                class="col-md-3"><?= $this->Form->input('responsive', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Website Responsive?', 'options' => array('1' => '<i class=\'material-icons\'>done</i> Ja', '0' => '<i class=\'material-icons\'>report_problem</i> Nee'))); ?></div>
            <div
                class="col-md-3"><?= $this->Form->input('updatenoodzakelijk', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Update Noodzakelijk?', 'options' => array('1' => '<i class=\'material-icons\'>done</i> Ja', '0' => '<i class=\'material-icons\'>report_problem</i> Nee'))); ?></div>
            <div
                class="col-md-3"><?= $this->Form->input('klantakkoord', array('class' => 'form-control form-control-inline', 'type' => 'radio', 'label' => 'Klant Akkoord?', 'options' => array('1' => '<i class=\'material-icons\'>done</i> Ja', '0' => '<i class=\'material-icons\'>report_problem</i> Nee'))); ?></div>



        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Websites'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
    </ul>
</div>
