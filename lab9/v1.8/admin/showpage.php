<?php

function PokazPodstrone($id){
    // Zabezpieczanie zmiennej $id przed atakiem typu CODE INJECTION
    $id_clear = htmlspecialchars($id);

    // Zapytanie SQL do pobrania podstrony o podanym ID
    $query = "SELECT * FROM page_list WHERE id = '$id_clear' LIMIT 1";
    $result = mysqli_query($query);
    $row = mysqli_fetch_array($result);

    // Sprawdzenie, czy podstrona o podanym ID istnieje
    if(empty($row['id'])){
        $web = '[nie_znaleziono_podstrony]';
    }
    else{
        $web = $row['page_content'];
    }
    return $web;
}

?>