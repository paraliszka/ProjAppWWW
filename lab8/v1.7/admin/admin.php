<?php

session_start();
require_once('cfg.php');

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
    $login_email = $_POST['login_email'];
    $login_pass = $_POST['login_pass'];

    // Sprawdzenie poprawności logowania
    if ($login_email == $login && $login_pass == $pass) {
        // Poprawne logowanie
        $_SESSION['logged_in'] = true;
        // Przekierowanie na stronę administracyjną
        header('Location: admin_panel.php');
        exit();
    } else {
        // Niepoprawne logowanie
        $error_message = 'Błędne dane logowania. Spróbuj ponownie.';
    }
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Użytkownik nie jest zalogowany, wyświetl formularz logowania
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    echo FormularzLogowania();
}

function ListaPodstron() {
    global $link;

    $wynik = '<h3>Podstrony:</h3>'.'<table class="tabela_akcji">'.'<tr><th>ID</th><th>Tytuł podstrony</th><th>Akcje</th></tr>';
    $wynik .= '<a href="'.$_SERVER['PHP_SELF'].'?action=dodaj">Dodaj podstronę</a> <br /> <br />';

    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($link, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $page_title = $row['page_title'];

            $wynik .= '<tr>'.'<td>' . $id . '</td>'.'<td>' . $page_title . '</td>'.'<td><a href="'.$_SERVER['PHP_SELF'].'?action=edytuj&id='.$id.'">Edytuj</a> | <a href="'.$_SERVER['PHP_SELF'].'?action=usun&id='.$id.'">Usuń</a></td>'.'</tr>';
        }
    } else {
        $wynik .= '<tr><td colspan="3">Brak podstron do wyświetlenia.</td></tr>';
    }

    $wynik .= '</table>';

    echo $wynik;

    if (isset($_GET['action'])){
        if ($_GET['action'] === 'dodaj') {
            echo DodajNowaPodstrone();
        }
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($_GET['action'] === 'edytuj') {
                echo EdytujPodstrone($id, $link);
            } else if ($_GET['action'] === 'usun') {
                echo UsunPodstrone($id, $link);
            }
        }
    }
}

function EdytujPodstrone($id, $link) {
    if (isset($_POST['title']) && isset($_POST['content'])) {
        // Przetwarzaj dane formularza
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Aktualizuj dane podstrony w bazie danych
        $query = "UPDATE page_list SET page_title = '$title', page_content = '$content' WHERE id = $id";
        $result = mysqli_query($link, $query);
        if ($result === false) {
            echo "Error: " . mysqli_error($link);
            return;
        }

        echo 'Podstrona została zaktualizowana.';
    } else {
        // Pobierz dane podstrony z bazy danych
        $query = "SELECT page_title, page_content FROM page_list WHERE id = $id LIMIT 1";
        $result = mysqli_query($link, $query);
        if ($result === false) {
            echo "Error: " . mysqli_error($link);
            return;
        }

        $row = mysqli_fetch_assoc($result);
        $title = $row['page_title'];
        $content = $row['page_content'];

        // Wyświetl formularz edycji podstrony
        echo '<form method="POST">';
        echo '<input type="hidden" name="page_id" value="' . $id . '">';

        echo '<label for="title">Tytuł:</label>';
        echo '<input type="text" name="title" value="' . $title . '">';

        echo '<label for="content">Treść:</label>';
        echo '<textarea name="content">' . $content . '</textarea>';

        echo '<input type="submit" value="Zapisz">';
        echo '</form>';
    }
} 

function DodajNowaPodstrone() {
    // Wyświetl formularz dodawania nowej podstrony
    echo '<form method="POST" action="insert_page.php">';
    
    echo '<label for="title">Tytuł:</label>';
    echo '<input type="text" name="title">';
    
    echo '<label for="content">Treść:</label>';
    echo '<textarea name="content"></textarea>';
    
    echo '<input type="submit" value="Dodaj">';
    echo '</form>';
}

function UsunPodstrone($id, $link) {
    if (isset($_POST['confirm'])) {
    // Wykonaj zapytanie SQL typu DELETE, aby usunąć podstronę o podanym ID z bazy danych
    $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
    $result = mysqli_query($link, $query);
    
    if ($result) {
        $message = 'Podstrona została usunięta.';
        header('Location: admin_panel.php?message=' . urlencode($message));
    } else {
        echo 'Wystąpił błąd podczas usuwania podstrony.';
    }
    
    } else {
     // Wyświetl formularz potwierdzenia
     echo '<form method="POST">';
     echo '<p>Czy na pewno chcesz usunąć tę podstronę?</p>';
     echo '<input type="hidden" name="confirm" value="1">';
     echo '<input type="submit" value="Usuń" action="admin.php">';
     echo '</form>';
    }
}
?>
