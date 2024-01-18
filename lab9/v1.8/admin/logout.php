<?php
// Rozpoczęcie sesji
session_start();
// Czyszczenie wszystkich danych sesji
$_SESSION = array();
// Zniszczenie sesji
session_destroy();
// Przekierowanie użytkownika do strony głównej
header('Location: ../index.php');
exit;
?>
