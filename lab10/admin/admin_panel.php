<!DOCTYPE html>
<html>
<head>

    <?php
    session_start();
    require_once 'cfg.php';

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
        <a href="../index.php" style="text-decoration: none;">
            <h1>Strona Główna</h1>
        </a>
    </header>
<nav>     
    <ul>
        <?php
            echo '<li><a href="../user/logout.php">Wyloguj</a></li>';
        ?>
        <form method="post">

        <input type="submit" name="kategorie" value="Kategorie">
        </form>
    </ul>    
</nav>
    <?php
        include_once 'kategorie.php';
    ?>
</body>
</html>





















<?php
// require_once 'admin/cfg.php';
        // ListaPodstron($link);

        // if (isset($_GET['message'])) {
        //     echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
        // }

        // $sql = "SELECT * FROM kategorie";
        // $result = $link->query($sql);
    
        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_assoc()) {
        //         $categoryId = $row["id"];
        //         echo "<div class='category' style='cursor:pointer;' onclick='toggleProducts(\"$categoryId\")'><b>" . $row["nazwa"]. "</b></div>";
        //         echo "<div class='products' id='products-$categoryId' style='display:none;'>";
        
        //         $sql2 = "SELECT * FROM produkty WHERE kategoria_id = " . $row["id"];
        //         $result2 = $link->query($sql2);
        
        //         if ($result2->num_rows > 0) {
        //             while($row2 = $result2->fetch_assoc()) {
        //                 echo "<div class='product'>";
        //                 echo "<h2>Product: " . $row2["nazwa"]. "</h2>";
        //                 echo "<p>Opis: " . $row2["opis"]. "</p>";
        //                 echo "<p>Cena: " . $row2["cena"]. "</p>";
        //                 echo "<p>Stan: " . $row2["stan"]. "</p>";
        //                 echo "</div>";
        //             }
        //         } else {
        //             echo "No products found in this category.<br>";
        //         }
        
        //         echo "</div>";
        //     }
        // } else {
        //     echo "No categories found.";
        // }
    
        // $link->close();
?>