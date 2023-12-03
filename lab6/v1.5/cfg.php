<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$baza = 'moja_strona';

$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
    die('Nie można połączyć: ' . mysqli_error());
}
if (!mysqli_select_db($baza)) {
    die('Nie można wybrać bazy danych: ' . mysqli_error());
}


?>