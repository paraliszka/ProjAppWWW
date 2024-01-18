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

        session_start();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo '<li><a href="user/logout.php">Wyloguj</a></li>';
        }
            if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                echo '<li><a href="admin/admin_panel.php">Panel administracyjny</a></li>';
            }
        ?>
    </ul>    
</nav>
    <section>
        


        <?php  

        $sql = "SELECT * FROM kategorie";
        $result = $link->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $categoryId = $row["id"];
                echo "<div class='category' style='cursor:pointer;' onclick='toggleProducts(\"$categoryId\")'><b>" . $row["nazwa"]. "</b></div>";
                echo "<div class='products' id='products-$categoryId' style='display:none;'>";
                
                // do zrobienia produktów
                if (false) {
                        echo "produkt";
                    }else {
                    echo "No products found in this category.<br>";
                }
        
                echo "</div>";
            }
        } else {
            echo "No categories found.";
        }
    
        $link->close();
        ?>



    </section>
    
</body>
</html>