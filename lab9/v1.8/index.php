<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loty kosmiczne</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery-3.7.1.min.js"></script>

</head>
<body>
  <div class="header">
   <h1><b>Strona Główna</b></h1>
  </div>

  <div class="main">
    <!-- menu główne -->
    <div class="menu">
      <div class="container-menu"> <a href="index.php"><img src="img/menu4.png" width="25" height="auto"> </a> </div>
      <div class="container-menu"> <a href="index.php?idp=strona1"><h2>ELT</h2> </a> </div>
      <div class="container-menu"> <a href="index.php?idp=strona2"><h2>Jowiszz</h2> </a> </div>
      <div class="container-menu"> <a href="index.php?idp=strona3"><h2>SpaceX</h2> </a> </div>
      <div class="container-menu"> <a href="index.php?idp=strona4"><h2>Mars</h2> </a> </div>
      <div class="container-menu"> <a href="index.php?idp=strona5"><h2>IDK</h2>  </a>  </div>
    </div>

<?php 
  error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

  // Zabezpieczamy zmienną $_GET przed atakiem typu CODE INJECTION
  $idp = isset($_GET['idp']) ? htmlspecialchars($_GET['idp']) : '';

  // Jeżeli zmienna $_GET['idp'] jest pusta, ustawiamy domyślną stronę
  if($idp == '') {
    $strona = 'html/glowna.html';
  } 


 

  if (empty($_GET['idp'])) {
    $strona = './html/glowna.html';
  } 
  elseif ($_GET['idp'] == 'strona1') {
    $strona = './html/strona1.html';
  }
   elseif ($_GET['idp'] == 'strona2') {
    $strona = './html/strona2.html';
  }
   elseif ($_GET['idp'] == 'strona3') {
    $strona = './html/strona3.html';
  }
  elseif ($_GET['idp'] == 'strona4') {
    $strona = './html/strona4.html';
  }
  elseif ($_GET['idp'] == 'strona5') {
    $strona = './html/strona5.html';
  }
  else {
    $strona = './html/glowna.html';
  }

  // Sprawdzamy czy plik istnieje
  if (file_exists($strona)) {
    include($strona);
  } else {
    echo 'Strona nie istnieje.';
  }
  
  $nr_indeksu = '164420';
  $nrGrupy = '3isi';
  echo "Autor: Andrzej Pliszka".$nr_indeksu." grupa ".$nrGrupy." <br /><br />";

?>

</body>
</html>


