<?php
error_reporting(E_ALL);

/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket, '127.0.0.1', 7963);

$in = "hello world";
$out = '';
socket_write($socket, $in, strlen($in));
$out = socket_read($socket, 1000);
socket_close($socket);
echo "OK.\n\n";
?>