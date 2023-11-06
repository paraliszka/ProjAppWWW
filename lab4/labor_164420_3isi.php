<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $nr_indeksu='164420';
    $nrGrupy='3isi';

    echo 'Andrzej Pliszka: '.$nr_indeksu.'Grupa: '.'<br/><br/>';
    echo 'Zastosowania metody include() <br/>';

    echo"metoda include załącza plik aaa";
    include('aaa.php');
    echo"metoda require_once wymaga załączenia pliku tylko jeden raz";
    require_once('aaa.php');

    echo '<br><br>';
    echo 'warunki if,else,elseif,switch <br>;
    są to instrukcje warunkowe które po spełnieniu jakiegoś warunku wykonjuą dane polecenie';
    $ocena = 75;

    if ($ocena >= 50) {
        echo "Zaliczone!";
    } else {
        echo "Niezaliczone.";
    }
    
    if ($ocena >= 90) {
        echo "Celujący!";
    } elseif ($ocena >= 75) {
        echo "Bardzo dobry!";
    } elseif ($ocena >= 50) {
        echo "Dostateczny.";
    } else {
        echo "Niedostateczny.";
    }

    echo '<br><br>';
    echo 'Pętle while i for działają podobnie jak instrukcje warunkowe z tym że dane polecenie jest wykonywane do puki warunek jest prawdziwy';

    $licznik = 0;
    while ($licznik < 5) {
    echo "Iteracja: $licznik<br>";
    $licznik++;
    }

    for ($i = 0; $i < 5; $i++) {
    echo "Iteracja: $i<br>";
    }

?>
    <h2>Get przekazuje dane z formularzy lub adresu URL do serwera w celu odczytania informacji.</h2>
    <form action="labor_164420_3isi.php" method="get">
        <label for="parametr">Parametr:</label>
        <input type="text" id="parametr" name="parametr">

        <input type="submit" value="Prześlij">
    </form>

    <h2>Post przesyła dane z formularzy do serwera w celu utworzenia, aktualizacji lub zapisania informacji, zwykle używane do operacji zmieniających stan.</h2>
    <form action="labor_164420_3isi.php" method="post">
        <label for="formularz">Wartość:</label>
        <input type="text" id="formularz" name="formularz">

        <input type="submit" value="Prześlij">
    </form>


<?php
if (isset($_GET['parametr'])) {
    $wartoscGet = $_GET['parametr'];
    echo "Wartość przekazana przez GET: $wartoscGet";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['formularz'])) {
        $wartoscPost = $_POST['formularz'];
        echo "Wartość przekazana przez POST: $wartoscPost";
    }
}

echo '<br><br>';
echo '<h2>SESSION przechowuje dane na serwerze, umożliwiając śledzenie informacji między różnymi żądaniami HTTP, np. informacji o zalogowanym użytkowniku.</h2>';

session_start();
$_SESSION['uzytkownik'] = 'JohnDoe';

echo "Wartość zmiennej sesyjnej: " . $_SESSION['uzytkownik'];
    

    ?>
</body>
</html>