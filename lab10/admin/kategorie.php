<section>
    <div style="width: 50%; float: left;">
        <form method="post">
        <label for="nazwa">Nazwa kategorii:</label>
        <input type="text" id="nazwa" name="nazwa">
        <input type="submit" name="dodaj" value="Dodaj kategorię">
        </form>

        <form method="post">
            <label for="id">ID kategorii:</label>
            <input type="text" id="id" name="id">
            <input type="submit" name="usun" value="Usuń kategorię">
        </form>

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

        $zarzadzajKategoriami = new ZarzadzajKategoriami($link);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['dodaj'])) {
                $zarzadzajKategoriami->DodajKategorie($_POST['nazwa']);
            } elseif (isset($_POST['usun'])) {
                $zarzadzajKategoriami->UsunKategorie($_POST['id']);
            } elseif (isset($_POST['edytuj'])) {
                $zarzadzajKategoriami->EdytujKategorie($_POST['id'], $_POST['nazwa']);
            }
        }
        
        echo '<div style="width: 50%; float: right;">';
        echo "<div class='category'><b><h1>Kategorie:</h1></b></div>";
        $zarzadzajKategoriami->PokazKategorie();
        echo '</div>';
        ?>



</section>
        