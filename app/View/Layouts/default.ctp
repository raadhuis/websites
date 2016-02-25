<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$isloggedin = false;
$isadmin = false;
$ismanager = false;
$isclient = false;

if (isset($_SESSION['Auth']['User'])) {
    $isloggedin = true;
    $isadmin = ($_SESSION['Auth']['User']['Role']['name'] == 'admin');
    $ismanager = ($_SESSION['Auth']['User']['Role']['name'] == 'admin');
    $isclient = ($_SESSION['Auth']['User']['Role']['name'] == 'admin');
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,500,500italic" rel="stylesheet"
          type="text/css"/>
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <?php

    echo $this->Html->css('/dist/css/app');
    echo $this->Html->css('/dist/css/dashboard');
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">RAADHUIS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav ">
                <li><a href="/checks/publicview">Kwaliteitscriteria</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($isloggedin) { ?>
                    <li class=dropdown><a class=dropdown-toggle data-toggle=dropdown
                                          href=#><?php echo $my_displayname ?><i
                                class="fa fa-user fa-fw fa-lg"></i> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu dropdown-user"><?php if (isset($_SESSION['Auth']['Admin']['id']) && $_SESSION['Auth']['Admin']['id'] > 0) { ?>
                                <li><a href="/users/loginasuser/<?php echo $_SESSION['Auth']['Admin']['id']; ?>"><i
                                        class="fa fa-sign-in fa-fw fa-lg"></i> Go Back</a></li><?php } ?>
                            <li><a href=/users/changepassword><i class="fa fa-lock fa-fw fa-lg"></i> Wachtwoord wijzigen</a>
                            </li>
                            <li class=divider></li>
                            <li><a href=/users/logout><i class="fa fa-sign-out fa-fw fa-lg"></i> Uitloggen</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="/users/login/">Inloggen</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<?php if ($isloggedin) { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li <?php if ($this->params->base . $this->params->url == '/websites') { ?>class="active"<?php } ?>>
                        <a
                            href="/websites">Websites</a></li>
                    <?php if ($isadmin) { ?>
                        <li <?php if ($this->params->base . $this->params->url == '/websites/migratie') { ?>class="active"<?php } ?>>
                            <a
                                href="/websites/migratie">Website migratie</a></li>

                        <li <?php if ($this->params->base . $this->params->url == '/websites/updates') { ?>class="active"<?php } ?>>
                            <a
                                href="/websites/updates">Website updates</a></li>
                        <li <?php if ($this->params->base . $this->params->url == '/websites/updates') { ?>class="active"<?php } ?>>
                            <a
                                href="/hosting">Hosting</a></li>
                        <li <?php if ($this->params->base . $this->params->url == '/mailbox') { ?>class="active"<?php } ?>>
                            <a
                                href="/mailbox">Help</a></li>
                        <li <?php if ($this->params->base . $this->params->url == '/reportcategories') { ?>class="active"<?php } ?>>
                            <a href="/reportcategories">Criteria Cat</a></li>
                    <?php } ?>
                    <?php if ($ismanager || $isadmin) { ?>
                        <li <?php if ($this->params->base . $this->params->url == '/checks') { ?>class="active"<?php } ?>>
                            <a
                                href="/checks">Checks</a></li>
                    <?php } ?>
                    <?php if ($isadmin) { ?>
                        <li <?php if ($this->params->base . $this->params->url == '/checkcategories') { ?>class="active"<?php } ?>>
                            <a href="/checkcategories">Check Categorie&euml;n</a></li>
                    <?php } ?>
                    <?php if ($isadmin) { ?>
                        <li <?php if ($this->params->base . $this->params->url == '/priorities') { ?>class="active"<?php } ?>>
                            <a
                                href="/priorities">Check Prioriteiten</a></li>
                    <?php } ?>
                    <?php if ($isadmin) { ?>
                        <li <?php if ($this->params->base . $this->params->url == '/roles') { ?>class="active"<?php } ?>>
                            <a
                                href="/roles">Rollen</a></li>
                    <?php } ?>
                </ul>
                <?php if ($ismanager || $isadmin) { ?>
                    <hr>
                <?php } ?>

                <ul class="nav nav-sidebar">
                    <li <?php if ($this->params->base . $this->params->url == '/users') { ?>class="active"<?php } ?>><a
                            href="/users">Contactpersonen</a></li>
                    <?php if ($ismanager || $isadmin) { ?>
                        <li <?php if ($this->params->base . $this->params->url == '/customers') { ?>class="active"<?php } ?>>
                            <a
                                href="/customers">Organisaties</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
<?php } ?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>

<?php if (!$isadmin) { ?>
    <script>
        (function () {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://raadhuis.groovehq.com/widgets/a2f6de3d-04d5-4e5c-b277-ae22bc3848f0/ticket.js';
            var q = document.getElementsByTagName('script')[0];
            q.parentNode.insertBefore(s, q);

        })();
    </script>
<?php } ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
