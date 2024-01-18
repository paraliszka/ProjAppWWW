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
            <!-- linki do odpowiednich podstron -->
            <li><a href="logout.php">Logout</a></li>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="contact.php">Kontakt</a></li>
        </ul>
    </nav>
    <!-- Tutaj umieszczamy zawartość panelu admina -->
    <section>
        <!-- Your admin panel content goes here -->
         <?php 
          // Importujemy funkcje admina z pliku admin.php
         require_once 'admin.php'; 
        // Wywołujemy funkcję ListaPodstron, która wyświetla listę dostępnych podstron
        ListaPodstron($link);
        // Sprawdzamy, czy istnieje parametr GET 'message' i jeśli tak, wyświetlamy go
        if (isset($_GET['message'])) {
            echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
        }


         ?> <!-- Importuj funkcje admina z pliku admin.php --> 
    </section>

</body>
</html>
