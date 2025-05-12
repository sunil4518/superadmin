<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Company_Software_2.0';


$link = new mysqli($servername, $username, $password, $dbname);
if (!$link) {
    echo 'connection failed';
}
?>