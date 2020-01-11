<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_database = 'db_lost';

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database.';charset=utf8', $db_user, $db_pass);


?>