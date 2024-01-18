<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="jquery-3.7.1.min.js"></script>

</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <nav>
        <ul>
            <li><a href="logout.php">Logout</a></li> <!-- Dodaj link do wylogowania -->
        </ul>
    </nav>
    <section>
        <!-- Your admin panel content goes here -->
         <?php 
         require_once 'admin.php'; 

        ListaPodstron($link);

        if (isset($_GET['message'])) {
            echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
        }


         ?> <!-- Importuj funkcje admina z pliku admin.php --> 
    </section>

</body>
</html>
