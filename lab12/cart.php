<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href=""> -->
    <title>Produkty | Sklep</title>
</head>
<body>
<a href="index.php">strona główna</a>
<?php
session_start();
error_reporting(0);
$full_price = 0;
if (isset($_POST['id']) && isset($_POST['cart'])) {
    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 1;
    } else {
        $_SESSION['count']++;
    }
    // pobranie id produktu
    $id = $_POST['id'];
    require_once('admin/cfg.php');
    // pobranie danych produktu od id
    $query = "SELECT * FROM produkty WHERE id = '$id'";
    $result = $link->query($query);
    $link->close();
    // deklaracja zmiennych z bazy danych
    $cena = 0;
    if ($result) {
        $row = $result->fetch_assoc();
        $nazwa = $row['nazwa'];
        $cena_netto = $row['cena_netto'];
        $podatek_vat = $row['podatek_vat'];
        $ilosc = $row['ilosc'];
        $zdjecie = $row['zdjecie'];
        // Obliczenie ceny brutto
        $cena = $cena_netto + ($podatek_vat * $cena_netto)/100;
    }

    $ile_sztuk = 1;
    // przypisanie wartości przedmiotu do tablicy
    for ($i = 1; $i <= $_SESSION['count']; $i++) {
        if ($_SESSION[$i.'_1'] == $id) {
            $_SESSION[$i.'_2']++; 
            header('Location: cart.php');
            exit(); 
        }
    }

    // przypisanie wartości przedmiotu do tablicy
    $nr = $_SESSION['count'];

    $ile_sztuk = 1;
    $prod[$nr]['id_prod'] = $id;
    $prod[$nr]['ile_sztuk'] = $ile_sztuk;
    $prod[$nr]['nazwa'] = $nazwa;
    $prod[$nr]['cena'] = $cena;
    $prod[$nr]['ilosc'] = $ilosc; 
    $prod[$nr]['zdjecie'] = $zdjecie;

    $nr_0 = $nr.'_0';
    $nr_1 = $nr.'_1';
    $nr_2 = $nr.'_2';
    $nr_3 = $nr.'_3';
    $nr_4 = $nr.'_4';
    $nr_5 = $nr.'_5';

    $_SESSION[$nr_0] = $nr;
    $_SESSION[$nr_1] = $prod[$nr]['id_prod'];
    $_SESSION[$nr_2] = $prod[$nr]['ile_sztuk'];
    $_SESSION[$nr_3] = $prod[$nr]['nazwa'];
    $_SESSION[$nr_4] = $prod[$nr]['cena'];
    $_SESSION[$nr_5] = $prod[$nr]['zdjecie'];
    
    header('Location: cart.php');
}
// funkcja usuwania koszyka
function Order() {
    session_destroy();
    header("Refresh:0");
    echo '<script>alert("Pomyślnie złożono zamówienie");</script>';
    header('Location: index.php');
    exit();
}

function ShowProduct($nr) {
    ob_start();

    echo '<tr>';
    echo '<td><img style="width:40px; height:40px;" src="data:image/png;base64,'.base64_encode($_SESSION[$nr.'_5']).'" /></td>'; 
    echo '<td>'.$_SESSION[$nr.'_3'].'</td>';
    echo '<td>'.$_SESSION[$nr.'_4'].'</td>';
    echo '<td>'.$_SESSION[$nr.'_2'].'</td>';
    echo '<td><form action="'.$_SERVER['REQUEST_URI'].'" method="POST"><button class="btn" type="submit" name="usun" value="'.$_SESSION[$nr.'_0'].'">Usun</button></form></td>';
    echo '</tr>';

    $output = ob_get_clean();

    return $output; 
}
// wyświetlenie koszyka
global $full_price;
echo '<style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 24px; border: none; cursor: pointer; }
        .btn:hover { background-color: #45a049; }
      </style>';
echo '<table>';
echo '<tr><th>Zdjęcie</th><th>Nazwa</th><th>Cena</th><th>Sztuk</th><th>Usuń</th></tr>';
for ($i = 1; $i <= $_SESSION['count']; $i++) {
    if (isset($_SESSION[$i.'_0'])) {
        echo ShowProduct($i);
        $full_price += $_SESSION[$i.'_4'] * $_SESSION[$i.'_2'];
    }
}
echo '</table>';
echo '<p>Całkowita cena: '.$full_price.' zł</p>';

echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">';
echo '<input type="hidden" name="order" value="order">';
echo '<button class="btn" type="submit">Zamów</button>';
echo '</form>';
// funkcja usuwania przedmiotu z koszyka
function RemoveFromCart($id) {
    unset($_SESSION[$id.'_0']);
    unset($_SESSION[$id.'_1']);
    unset($_SESSION[$id.'_2']);
    unset($_SESSION[$id.'_3']);
    unset($_SESSION[$id.'_4']);
    unset($_SESSION[$id.'_5']);

    header('Refresh: 0;');
}

if (isset($_POST['order'])) {
    Order();
    exit();
}

if (isset($_POST['usun'])) {
    RemoveFromCart($_POST['usun']);

}
?>
</body>
</html>