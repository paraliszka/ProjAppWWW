<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$baza = 'sklep';

// Połączenie z serwerem MySQL
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
    die('Nie można połączyć: ' . mysqli_error());
}
if (!mysqli_select_db($link, $baza)) {
    die('Nie można wybrać bazy danych: ' . mysqli_error($link));
}


?>