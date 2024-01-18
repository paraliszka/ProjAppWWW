
<?php
require_once 'admin.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sprawdź czy formularz dodawania nowej podstrony został wysłany
    if (isset($_POST['title']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        // Wykonaj zapytanie SQL typu INSERT, aby dodać nową podstronę do bazy danych
        $query = "INSERT INTO page_list (page_title, page_content) VALUES ('$title', '$content') LIMIT 1";
        $result = mysqli_query($link, $query);
        
        if ($result) {
            echo 'Nowa podstrona została dodana.';
        } else {
            echo 'Wystąpił błąd podczas dodawania nowej podstrony.';
        }
    }
}

$message = "Operacja zakończona sukcesem";
header("Location: admin_panel.php?message=" . urlencode($message));
exit;
?>