<!-- produkty.php służy do obsługi curda klasy produkty -->
<section>
<div>
    <!-- wyświetlanie produktów -->
    <form method="post">
        <label >Id produktu:</label>
        <input type="number" name="id">
        <input type="submit" name="produkt" value="pokaż produkt">
    </form>
    <form method="post">
        <label >Produkty kategorii (Id kategorii):</label>
        <input type="number" name="id">
        <input type="submit" name="produky" value="pokaż produkty">
    </form>
</div>
<div style='display: grid; grid-template-columns: 3fr 2fr;'>

    
<?php

    require_once 'admin.php';
    // zarządzanie funcjami związanymi z produktami
    $zarzadzajProduktami = new ZarzadzajProduktami($link);

    echo '<div class="admin_panel" style="grid-column: 1;">';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['produkt'])) {
            $wynik = $zarzadzajProduktami->PokazProduktID($_POST['id']);
            echo $wynik;
        }
        if (isset($_POST['produky'])) {
            $wynik = $zarzadzajProduktami->PokazProduktyPoKategorii($_POST['id']);
            echo $wynik;
        }
        if (isset($_POST['usun_produkt'])) {
            $wynik = $zarzadzajProduktami->UsunProdukt($_POST['id']);
            echo $wynik;
        }
    }
    
    echo "</div>";
    echo '<div class="admin_panel" style="grid-column: 2;">';
    // wyświetlenie formularza dodawania i aktualizacji produktu
    echo '<form method="post">';
    echo '<input type="submit" name="add_produkt" value="dodaj produkt" >';
    echo "<br><br>";
    echo '<input type="number" name="id" value="">';
    echo '<input type="submit" name="update_produkt" value="Aktualizuj produkt">';
    echo '</form>';
    // dodanie produktu lub aktualizacja produktu
    if (isset($_POST['add_produkt'])){
        echo $zarzadzajProduktami->DodajProdukt();
    }
    $wynik = "";
    if (isset($_POST['update_produkt'])) {
        if ($_POST['id'] != "") {
            $wynik .= $zarzadzajProduktami->EdytujProdukt($_POST['id']);
        }else{
            $wynik .= "Nie podano id produktu";
        }
        echo $wynik;
    }
    echo "</div>";
    
?>
</div>
</section>