<?php

$server = '127.0.0.1'; //name of the server
$username = 'student'; //server username
$password = 'student'; //server password

$schema = 'kitchen'; //name of the schema
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' .$server, $username, $password ,
            [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION ]);
?>