<h4>Contactpersoon</h4>
<h5><?php echo $user_data['name'] ?>
    <?php if (!empty($user_data['title'])) { ?>
        <small><?php echo $user_data['title'] ?></small>
    <?php } ?>
</h5>
<ul class="list-unstyled">
    <li>
        <i class="fa fa-envelope"></i>
        <a href="mailto:<?php echo $user_data['email'] ?>" target="_blank"><?php echo $user_data['email'] ?></a></li>
    <?php if (!empty($user_data['phone_number'])) { ?>
        <li><i class="fa fa-phone"></i>
            <a href="call:<?php echo $user_data['phone_number'] ?>"
               target="_blank"><?php echo $user_data['phone_number'] ?></a></li>
    <?php } ?>
    <?php if (!empty($user_data['website_url'])) { ?>
        <li><i class="fa fa-link"></i>
            <a href="<?php echo $user_data['website_url'] ?>"
               target="_blank">website</a></li>
    <?php } ?>
    <?php if (!empty($user_data['twitter_username'])) { ?>
        <li><i class="fa fa-twitter"></i>
            <a href="//twitter.com/<?php echo $user_data['twitter_username'] ?>" target="_blank">Twitter</a></li>
    <?php } ?>
    <?php if (!empty($user_data['linkedin_username'])) { ?>
        <li><i class="fa fa-linkedin"></i>
            <a href="https://www.linkedin.com/in/<?php echo $user_data['linkedin_username'] ?>"
               target="_blank">LinkedIn</a></li>
    <?php } ?>
</ul>