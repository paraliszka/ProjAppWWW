<?php
// Rozpoczęcie sesji
session_start();
// Załączenie pliku konfiguracyjnego
require_once('cfg.php');

function FormularzLogowania() {
    // Tworzenie HTML formularza
    $wynik = '
    <div class="login-wrapper">
        <h1 class="heading">Panel CMS:</h1>
        <form class="formularz_logowania" method="POST" name="LoginForm" enctype="multipart/form-data" action="'.htmlspecialchars($_SERVER['REQUEST_URI']).'"
        <table class="logowanie">
            <tr>
                <td class="log4_t">[login]</td>
                <td><input type="text" name="login_email" class="logowanie"/></td>
            </tr>
            <tr>
                <td class="log4_t">[haslo]</td>
                <td><input type="password" name="login_pass" class="logowanie"/></td>
            </tr>
            <tr>
                <td><br/></td>
                <td><input type="submit" name="xl_submit" class="logowanie" value="Zaloguj"/></td>
            </tr>
        </table>
        </form>
    </div>
    ';
    return $wynik;
}
// Sprawdzenie, czy formularz logowania został wysłany
if (isset($_POST['login_email']) && isset($_POST['login_pass'])) {
    // Oczyszczenie danych wejściowych chroni przed atakami typu SQL Injection
    $login_email = filter_input(INPUT_POST, 'login_email', FILTER_SANITIZE_EMAIL);
    $login_pass = filter_input(INPUT_POST, 'login_pass', FILTER_SANITIZE_STRING);

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
// ListaPodstron - funkcja wyświetlająca listę podstron
function ListaPodstron() {
    // Używamy zmiennej globalnej $link do połączenia z bazą danych
    global $link;

    // Dodajemy link do dodawania nowej podstrony
    $wynik = '<h3>Podstrony:</h3>'.'<table class="tabela_akcji">'.'<tr><th>ID</th><th>Tytuł podstrony</th><th>Akcje</th></tr>';
    $wynik .= '<a href="'.$_SERVER['PHP_SELF'].'?action=dodaj">Dodaj podstronę</a> <br /> <br />';

    // Tworzymy zapytanie SQL do pobrania listy podstron
    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($link, $query);

    // Jeżeli zapytanie zwróciło wyniki, dodajemy je do naszej zmiennej wynikowej
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $page_title = $row['page_title'];

            $wynik .= '<tr>'.'<td>' . $id . '</td>'.'<td>' . $page_title . '</td>'.'<td><a href="'.$_SERVER['PHP_SELF'].'?action=edytuj&id='.$id.'">Edytuj</a> | <a href="'.$_SERVER['PHP_SELF'].'?action=usun&id='.$id.'">Usuń</a></td>'.'</tr>';
        }
    } else {
        $wynik .= '<tr><td colspan="3">Brak podstron do wyświetlenia.</td></tr>';
    }
    // Dodajemy zamknięcie tabeli do naszej zmiennej wynikowej i wyświetlamy wynik
    $wynik .= '</table>';

    echo $wynik;
    // Sprawdzamy, czy została przekazana jakaś akcja
    if (isset($_GET['action'])){
        if ($_GET['action'] === 'dodaj') {
            echo DodajNowaPodstrone();
        }
        // Sprawdzamy, czy zostało przekazane ID podstrony
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

// EdytujPodstrone - funkcja do edycji podstrony
function EdytujPodstrone($id, $link) {
    // Zabezpieczamy ID podstrony przed atakami typu Code Injection
    $id = mysqli_real_escape_string($link, $id);

    if (isset($_POST['title']) && isset($_POST['content'])) {
        // Przetwarzamy dane formularza
        $title = mysqli_real_escape_string($link, $_POST['title']);
        $content = mysqli_real_escape_string($link, $_POST['content']);

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
        // Przetwarzamy dane pobrane z bazy danych
        $row = mysqli_fetch_assoc($result);
        $title = htmlspecialchars($row['page_title']);
        $content = htmlspecialchars($row['page_content']);

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

// DodajNowaPodstrone - funkcja do dodawania nowej podstrony
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

// UsunPodstrone - funkcja do usuwania podstrony
function UsunPodstrone($id, $link) {
    // Zabezpieczamy ID podstrony przed atakami typu Code Injection
    $id = mysqli_real_escape_string($link, $id);
    
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
