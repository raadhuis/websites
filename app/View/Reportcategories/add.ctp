<?= $this->Element('title', array('icon' => 'add', 'title' => 'Toevoegen Rapportage Categorie')); ?>

<div class="checkcategories form">
    <?php echo $this->Form->create('Reportcategory'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('icon');
        echo $this->Form->input('description');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>