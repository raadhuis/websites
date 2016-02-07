<?php

include 'app/Vendor/directadmin/httpsocket.php';

$sock = new HTTPSocket;


echo "<h1>Alle gebruikers van web1.prod.raadhuis.cyso.net</h1>";
$sock->connect('web1.prod.raadhuis.cyso.net',2222);
$sock->set_login('raadhuis','XYKeQqzX2cstslR4');
$sock->query('/CMD_API_SHOW_ALL_USERS');
$result = $sock->fetch_parsed_body();
print_r($result);

echo "<h1>Alle gebruikers van web1.acc.raadhuis.cyso.net</h1>";
$sock->connect('web1.acc.raadhuis.cyso.net',2222);
$sock->set_login('raadhuis','XYKeQqzX2cstslR4');
$sock->query('/CMD_API_SHOW_ALL_USERS');
$result = $sock->fetch_parsed_body();
print_r($result);

?>
