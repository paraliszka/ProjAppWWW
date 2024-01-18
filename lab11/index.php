<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="jquery-3.7.1.min.js"></script>

    <!-- po użyciu przycisku rozwinie się lista -->

    <script>
    function toggleProducts(categoryId) {
        var productsDiv = document.getElementById('products-' + categoryId);
        if (productsDiv.style.display === "none") {
            productsDiv.style.display = "block";
        } else {
            productsDiv.style.display = "none";
        }
    }
    </script>


</head>
<body>
    <header>
        <h1>Strona Główna</h1>
    </header>
<nav>     
    <ul>
    <li><a href="user/login.php">Zaloguj się</a></li>
    <!-- do zrobienia -->
    <li><a href="user/create_user.php">Załóż konto(do zrobienia)</a></li>
        <?php
        require_once 'admin/cfg.php';
        // jeśli użytkownik jest zalogowany, wyświetl przycisk wyloguj
        session_start();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo '<li><a href="user/logout.php">Wyloguj</a></li>';
        }
        // jeśli użytkownik jest administratorem, wyświetl przycisk panel administracyjny
            if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                echo '<li><a href="admin/admin_panel.php">Panel administracyjny</a></li>';
            }
        ?>
    </ul>    
</nav>
    <section>
        
    <div style='display: grid; grid-template-columns: 1fr 3fr 1fr;'>

    <div id="kategories" style='grid-column: 1;'>
        <?php
        include_once 'admin/admin.php';
        $zarzadzajKategoriami = new ZarzadzajKategoriami($link);
        $zarzadzajKategoriami->PokazKategorie();

        ?>
    </div>
    <div id="products" style='grid-column: 2;'>
    <form method="post">
        <label >Nazwa Kategorii:</label>
        <input type="text" name="id_name">
        <input type="submit" name="produky" value="pokaż kategorię">
    </form>


    
        <?php
        $zarzadzajProduktami = new ZarzadzajProduktami($link);

        if (isset($_POST['produky'])) {
            $wynik = $zarzadzajProduktami->PokazProduktyPoKategorii(null ,$_POST['id_name']);
            echo $wynik;
        }

        ?>
    </div>

    </section>
    
</body>
</html>