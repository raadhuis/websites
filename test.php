<?php

include 'app/Vendor/directadmin/httpsocket.php';

$sock = new HTTPSocket;

$sock->connect('localhost',2222);
$sock->set_login('raadhuis','XYKeQqzX2cstslR4');

$sock->query('/CMD_API_SHOW_ALL_USERS');
$result = $sock->fetch_parsed_body();

print_r($result);

?>
