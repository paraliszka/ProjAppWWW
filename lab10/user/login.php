<?php

session_start();
require_once('../admin/cfg.php');

function FormularzLogowania() {
    $wynik = '
    <div class="login-wrapper">
    <h1 class="heading">Panel CMS:</h1>
    <form class="formularz_logowania" method="POST" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"
    <table class="logowanie">
    <tr><td class="log4_t">[login]</td><td><input type="text" name="login_email" class="logowanie"/></td></tr>
    <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie"/></td></tr>
    <tr><td><br/></td><td><input type="submit" name="xl_submit" class="logowanie" value="Zaloguj"/></td></tr>
    </table>-
    </form>
    </div>
    
    ';
    return $wynik;
}

if (isset($_POST['login_email']) && isset($_POST['login_pass'])) {

    $login = $_POST['login_email'];
    $login_pass = $_POST['login_pass'];

    $sql = "SELECT id, nazwa, email, haslo, czy_admin FROM users WHERE nazwa = '$login'";

    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        $nazwa = $row["nazwa"];
        $email = $row["email"];
        $pass = $row["haslo"];
        $is_admin = $row["czy_admin"];
    
        // Sprawdzenie poprawności logowania
        if ($nazwa == $login || $email == $login && $login_pass == $pass) {
            // Poprawne logowanie
            $_SESSION['logged_in'] = true;
            $_SESSION['is_admin'] = $is_admin;
            // Przekierowanie na stronę administracyjną
            header('Location: ../index.php');
            exit();
        } else {
            // Niepoprawne logowanie
            throw new Exception('Błędne dane logowania. Spróbuj ponownie.');
        }
    }
    $link->close();
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Użytkownik nie jest zalogowany, wyświetl formularz logowania
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    echo FormularzLogowania();
}else
{
    header('Location: ../index.php');
}



?>