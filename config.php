<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Company_Software';


$link = new mysqli($servername, $username, $password, $dbname);
if (!$link) {
    echo 'connection failed';
}
?>