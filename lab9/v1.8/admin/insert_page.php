
<?php
// Załącz plik admin.php
require_once 'admin.php';
// Sprawdź czy metoda żądania to POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sprawdź czy formularz dodawania nowej podstrony został wysłany
    if (isset($_POST['title']) && isset($_POST['content'])) {
        // Zabezpiecz zmienne przed atakiem typu CODE INJECTION
        $title = mysqli_real_escape_string($link, $_POST['title']);
        $content = mysqli_real_escape_string($link, $_POST['content']);
        
        // Wykonaj zapytanie SQL typu INSERT, aby dodać nową podstronę do bazy danych
        $query = "INSERT INTO page_list (page_title, page_content) VALUES ('$title', '$content') LIMIT 1";
        $result = mysqli_query($link, $query);
        // Spradź czy zapytanie zostało wykonane pomyślnie
        if ($result) {
            echo 'Nowa podstrona została dodana.';
        } else {
            echo 'Wystąpił błąd podczas dodawania nowej podstrony.';
        }
    }
}
// Ustaw komunikat o sukcesie
$message = "Operacja zakończona sukcesem";
// Przekieruj do panelu admina z komunikatem
header("Location: admin_panel.php?message=" . urlencode($message));
exit;
?>