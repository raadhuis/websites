<?php echo $this->Element('title', array('icon' => 'web', 'title' => 'Hosting toevoegen')); ?>

<div class="websites form">
    <?php echo $this->Form->create('Hosting'); ?>
    <fieldset>
        <div class="row">
            <div class="col-md-6">
                <legend><?php echo __('Hosting details'); ?></legend>
                <p>Het is mogelijk om enkel met onderstaande informatie een volledige RAADHUIS hosting aan te maken. De
                    resultaten zijn na het opslaan beschikbaar.</p>
                <?php echo $this->Form->input('website_id', array('class' => 'form-control', 'label' => 'Koppel hosting aan een bestaande website')); ?>
                <p class="help-block">Domeinnaam zonder www, maar wel met de domeinextensie.</p>
                <?php echo $this->Form->input('hostingpackage_id', array('class' => 'form-control', 'label' => 'Kies een hostingpakket')); ?>
                <?php echo $this->Form->input('websitecategory_id', array('class' => 'form-control', 'label' => 'Kies type website')); ?>
                <p class="help-block"></p>
            </div>
    </fieldset>
    <?php echo $this->Form->submit(__('Opslaan'), array('class' => 'btn btn-primary')); ?>
    <?php echo $this->Form->end() ?>
</div>
