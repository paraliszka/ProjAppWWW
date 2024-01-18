<!DOCTYPE html>
<html>
<head>

    <?php
    session_start();
    require_once 'cfg.php';
    // sprawdzanie czy użytkownik jest zalogowany i czy jest adminem
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
        header('Location: ../user/login.php');
        exit();
    } 
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
        header('Location: ../index.php');
        exit();
    }
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Panel</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="jquery-3.7.1.min.js"></script>

</head>
<body>
    <header>
         <!-- link do strony głównej -->
        <a href="../index.php" style="text-decoration: none;">
            <h1>Strona Główna</h1>
        </a>
    </header>
<nav>     
    <ul>
        <?php 
            // Wyloguj użytkownika
            echo '<li><a href="../user/logout.php">Wyloguj</a></li>';
        ?>
        <!-- Formularz do wyświetlania kategorii -->
        <form method="post">
            <input type="submit" name="kat" value="Kategorie">  
        </form>
        <br/><br/>
        <!-- Formularz do wyświetlania produktów -->
        <form method="post">
            <input type="submit" name="prod" value="Produkty">
        </form>
    </ul>    
</nav>

    <?php

// Obsługa żądań POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['kat'])) {
        $_SESSION['include_file'] = 'kategorie.php';
    }
    if (isset($_POST['prod'])) {
        $_SESSION['include_file'] = 'produkty.php';
    }
}
// Jeśli istnieje plik do załączenia, załącz go
// aby po przeładowaniu strony nie trzeba było ponownie wybrać opcji
if (isset($_SESSION['include_file'])) {
    include_once $_SESSION['include_file'];
}

    ?>
</body>
</html>


