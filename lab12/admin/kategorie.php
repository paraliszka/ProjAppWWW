<!-- kategorie.php obzługują klasę kategorie (crud kategorii)-->
<section>
    <!-- furmularze do obsługi cruda -->
    <div style='display: grid; grid-template-columns: 3fr 2fr;'>

    <div class="admin_panel" style='grid-column: 1;'>

        <form method="post">
        <label for="nazwa">Nazwa kategorii:</label>
        <input type="text" id="nazwa" name="nazwa">
        <input type="submit" name="dodaj" value="Dodaj kategorię">
        </form>
        <br><br>
        <form method="post">
            <label for="id">ID kategorii:</label>
            <input type="text" id="id" name="id">
            <input type="submit" name="usun" value="Usuń kategorię">
        </form>
        <br><br>
        <form method="post">
            <label for="id">ID kategorii:</label>
            <input type="text" id="id" name="id">
            <label for="nazwa">Nowa nazwa:</label>
            <input type="text" id="nazwa" name="nazwa">
            <input type="submit" name="edytuj" value="Edytuj kategorię">
        </form>
    </div>
        <?php  
        
        require_once 'admin.php';
        
        // Utwórz nowy obiekt ZarzadzajKategoriami
        $zarzadzajKategoriami = new ZarzadzajKategoriami($link);
        
        // obsługa formularzy do obsługi cruda i uruchomienie odpowiedniej metody
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['dodaj'])) {
                $zarzadzajKategoriami->DodajKategorie($_POST['nazwa']);
            } elseif (isset($_POST['usun'])) {
                $zarzadzajKategoriami->UsunKategorie($_POST['id']);
            } elseif (isset($_POST['edytuj'])) {
                $zarzadzajKategoriami->EdytujKategorie($_POST['id'], $_POST['nazwa']);
            }
        }
         // Wyświetl kategorie
        echo '<div class="admin_panel" style="grid-column: 2;">';
        echo "<div class='category'><b><h1>Kategorie:</h1></b></div>";
        $zarzadzajKategoriami->PokazKategorie();
        echo '</div>';
        ?>



</section>
        