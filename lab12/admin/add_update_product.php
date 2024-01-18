<?php
// Dodanie parametrów z pliku cfg.php w celu połączenia z bazą danych
require('cfg.php');


// Sprawdzenie czy pola odpowiadające kolumnom zostały ustawione
try {
if (isset($_POST['name']) && isset($_POST['opis']) && isset($_POST['data']) && isset($_POST['netto']) && isset($_POST['vat']) && isset($_POST['number']) && isset($_POST['category'])) {
    $nazwa = htmlspecialchars($_POST['name']);
    $opis = htmlspecialchars($_POST['opis']);
    $data_utworzenia = date('Y-m-d');
    $data_modyfikacji = date('Y-m-d');
    $data_wygasniecia = htmlspecialchars($_POST['data']);
    $cena_netto = htmlspecialchars($_POST['netto']);
    $podatek_vat = htmlspecialchars($_POST['vat']);
    $ilosc = htmlspecialchars($_POST['number']);
    if ($ilosc > 0 && $data_wygasniecia >= date('Y-m-d')) {
        $dostepnosc = true;
    } else {
        $dostepnosc = false;
    }
    $kategoria = htmlspecialchars($_POST['category']);

    


    if (isset($_POST['create']) && isset($_FILES['photo'])) {
        // Dodanie nowego produktu do bazy danych
        $zdjecie = file_get_contents($_FILES['photo']['tmp_name']);
        $stmt = $link->prepare("INSERT INTO produkty (nazwa, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, cena_netto, podatek_vat, ilosc, dostepnosc, kategoria_id, zdjecie) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssssiss', $nazwa, $opis, $data_utworzenia, $data_modyfikacji, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc, $dostepnosc, $kategoria, $zdjecie);
    } elseif (isset($_POST['update']) && isset($_POST['id'])) {
        
        // Aktualizacja produktu w bazie danych
        $id = $_POST['id'];
        if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['error'] == 0) {
            // Nowy plik został przesłany, więc aktualizuj zdjęcie
            $zdjecie = file_get_contents($_FILES['zdjecie']['tmp_name']);
        } else {
            // Nie przesłano nowego pliku, więc zachowaj obecne zdjęcie
            // Pobierz obecne zdjęcie z bazy danych
            $stmt = $link->prepare("SELECT zdjecie FROM produkty WHERE id = ?");
            $stmt->bind_param('i', $_POST['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $zdjecie = $row['zdjecie'];
        }
        
        // Aktualizuj rekord w bazie danych
        $stmt = $link->prepare("UPDATE produkty SET nazwa = ?, opis = ?, data_utworzenia = ?, data_modyfikacji = ?, data_wygasniecia = ?, cena_netto = ?, podatek_vat = ?, ilosc = ?, dostepnosc = ?, kategoria_id = ?, zdjecie = ? WHERE id = ?");
        $stmt->bind_param('ssssssssissi', $nazwa, $opis, $data_utworzenia, $data_modyfikacji, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc, $dostepnosc, $kategoria, $zdjecie, $id);
        }   
    if ($stmt->execute()) {
        echo "Pomyślnie dodano/zaktualizowano produkt";
        header("Location: admin_panel.php");
    } else {
        echo "Błąd podczas dodawania produktu";
    }
}

} catch (Exception $e) {
    // Handle the exception
    echo 'Error: ' . $e->getMessage();
}
?>