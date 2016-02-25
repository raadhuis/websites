<h3>Organisatie</h3>


<address>
    <strong><?php echo $customer['Customer']['name']?></strong><br>
    <?php if(!empty($customer['Customer']['address1'])) { ?>
    <?php echo $customer['Customer']['address1']?><br>
    <?php } ?>
    <?php if(!empty($customer['Customer']['address2'])) { ?>
    <?php echo $customer['Customer']['address2']?><br>
    <?php } ?>
    <?php if(!empty($customer['Customer']['phone'])) { ?>
    <abbr title="Phone">t:</abbr> <?php echo $customer['Customer']['phone']?>
    <?php } ?>
</address>
<small>Laatst bewerkt: <?php echo $customer['Customer']['modified']?></small>
