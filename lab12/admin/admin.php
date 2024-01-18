<?php
// zabezpieczenie przed bezpośrednim nieautoryzowanym uruchomieniem pliku

// nie wiem czemu ta konkretna cześć kodu powoduje błąd przez którą cała strona przestaje działać
// if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
//     header('Location: ../user/login.php');
//     exit();
// } 
// if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
//     header('Location: ../index.php');
//     exit();
// }

class ZarzadzajKategoriami {
    private $db;
    // Konstruktor - łączenie z bazą danych
    public function __construct($db) {
        $this->db = $db;
    }
    // Dodawanie kategorii
    public function DodajKategorie($nazwa) {
        $query = "INSERT INTO kategorie (nazwa) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $nazwa);
        $stmt->execute();
    }
    // Usuwanie kategorii
    public function UsunKategorie($id) {
        $query = "DELETE FROM kategorie WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    // Edytowanie kategorii
    public function EdytujKategorie($id, $nazwa) {
        $query = "UPDATE kategorie SET nazwa = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $nazwa, $id);
        $stmt->execute();
    }
    // Wyświetlanie kategorii
    public function PokazKategorie() {
        $query = "SELECT * FROM kategorie";
        $result = $this->db->query($query);
        
        while($row = $result->fetch_assoc()) {
        echo '<div class="category" ><b>' ."id: ". $row["id"]. "  ". $row["nazwa"]. "</b></div>";
        }
    }
}

class ZarzadzajProduktami {

    public function __construct($db) {
        $this->db = $db;
    }

    function PokazProduktID($id){

        // Pobranie danych z bazy danych
        $query = "SELECT * FROM produkty WHERE id = '$id'";
        $result = $this->db->query($query);

        // Sprawdzenie czy zapytanie zwróciło wyniki
        if ($result) {
            $row = $result->fetch_assoc();
            $nazwa = $row['nazwa'];
            $opis = $row['opis'];
            $cena_netto = $row['cena_netto'];
            $data_wygasniecia = $row['data_wygasniecia'];
            $podatek_vat = $row['podatek_vat'];
            $ilosc = $row['ilosc'];
            $dostepnosc = $row['dostepnosc'] == 1 ? "Dostępne" : "Niedostępne";
            $zdjecie = $row['zdjecie'];
            // Obliczenie ceny brutto
            $cena = $cena_netto + ($podatek_vat * $cena_netto)/100;
            
            $wynik = "";
            // Dodanie wiersza odpowiadającego produktowi do zmiennej
            $wynik .= '<h3>Produkt: '.$nazwa.'</h3><br /><br /><div class="product-image"><img src="data:image/png;base64,'.base64_encode($zdjecie).'"/></div>';
            $wynik .= '<div class="product-details"><p>Opis: '.$opis.'</p><h2>Cena: '.$cena.'zł</h2><p>Status dostępności: '.$dostepnosc.'!</p></div>';
            
            // funkcje dla admina, usuniecia rejestru
            if ((isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)){
                $wynik .= 
                '<h1>Id produktu: '.$id.'</h1>
                <form method="post">
                <input type="number" name="id" value="'.$id.'" hidden>
                <input type="submit" name="usun_produkt" value="Usuń produkt">
                </form>';
            }
            if(isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true){
                if($_SESSION['is_admin'] == 0){
                    if(strtotime(date("Y-m-d")) < strtotime($data_wygasniecia)){
                        $wynik .= '<form method="POST" action="cart.php">'; 
                        $wynik .= '<input type="number" name="id" value="'.$id.'" hidden>';
                        $wynik .= '<input type="submit" name="cart" value="Dodaj do koszyka">'.'</form>';
                    }else{
                        $wynik .= '<p style="color: red;">Produkt wygasł</p>';
                    }
                }
            }

            $wynik .= '<div class="clearfix"></div>';

        } else {
            // Wyświetlenie komunikatu o braku produktu
            $wynik = '<tr><td colspan="3">Brak produktu.</td></tr>';
        }

    return $wynik;
    }
    // Wyświetlanie produktów na bazie funkcji PokazProduktID dodatkowo po kategorii
    function PokazProduktyPoKategorii($kategoria_id = null, $kategoria_nazwa = null){
        // Pobranie danych z bazy danych po id lub nazwie kategorii
        if($kategoria_id != null){
            $query = "SELECT * FROM produkty WHERE kategoria_id = '$kategoria_id'";
        }elseif($kategoria_nazwa != null){
            $query = "SELECT * FROM produkty WHERE kategoria_id = (SELECT id FROM kategorie WHERE nazwa = '$kategoria_nazwa')";
        }
        $result = $this->db->query($query);
        
        $wynik = "";
        // Sprawdzenie czy zapytanie zwróciło wyniki i wyświetlenie pruduktów danej kategorii
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $wynik .= $this->PokazProduktID($row['id']);
                $wynik .= '<hr>';
            }
        }
        return $wynik;
    }

    // Wyświetlanie wszystkich produktów
    function DodajProdukt() {
        $wynik = '<h3>Dodaj produkt:</h3>'.'<form method="POST" enctype="multipart/form-data" action="add_update_product.php">';
        $wynik .= 'Tytul: <input class="nazwa" type="text" name="name" value=""><br /> <br />';
        $wynik .= 'Opis: <textarea class="tresc" rows=20 cols=100 name="opis"></textarea><br /> <br />';
        $wynik .= 'Data wygaśnięcia: <input class="tytul" type="date" name="data" value=""><br /> <br />';
        $wynik .= 'Cena netto: <input class="tytul" type="text" name="netto" value=""><br /> <br />';
        $wynik .= 'Podatek VAT: <input class="tytul" type="number" name="vat" value=""><br /> <br />';
        $wynik .= 'Ilość sztuk w magazynie: <input class="tytul" type="number" name="number" value=""><br /> <br />';
        $wynik .= 'Kategoria: <input class="tytul" type="number" name="category" value=""><br /> <br />';
        $wynik .= 'Zdjęcie: <input class="tytul" type="file" name="photo" value=""><br /> <br />';
        $wynik .= '<input class="zapisz" type="submit" name="create" value="Dodaj">'.'</form>';
        
        return $wynik;
    }

    function UsunProdukt($id) {
        // Usunięcie produktu z bazy danych
        if($id <= 0) return "Id produktu nie może być mniejsze równe 0.";
        $query = "DELETE FROM produkty WHERE id = $id LIMIT 1";
        $result = $this->db->query($query);

        // Sprawdzenie czy produkt został usunięty
        if ($result) {
            return "Produkt został usunięty.";
        }
        else {
            return "Nie udało się usunąć produktu.";
        }
    }

    function EdytujProdukt($id) {
        // Pobranie danych produktu z bazy danych
        $query = "SELECT * FROM produkty WHERE id = '$id'";
        $result = $this->db->query($query);
    
        // Przypisanie danych produktu do zmiennych
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $nazwa = $row['nazwa'];
            $opis = $row['opis'];
            $data_wygasniecia = $row['data_wygasniecia'];
            $cena_netto = $row['cena_netto'];
            $podatek_vat = $row['podatek_vat'];
            $ilosc = $row['ilosc'];
            $kategoria = $row['kategoria_id'];
            $zdjecie = $row['zdjecie'];
    
            // Stworzenie formularza do edycji produktu
            $wynik = '<form method="POST" enctype="multipart/form-data" action="add_update_product.php">'; 
            $wynik .= '<input type="number" name="id" value="'.$id.'" hidden>';
            $wynik .= 'Tytul: <input class="nazwa" type="text" name="name" value="'.$nazwa.'"><br /> <br />';
            $wynik .= 'Opis: <textarea class="tresc" rows=20 cols=100 name="opis">'.$opis.'</textarea><br /> <br />';
            $wynik .= 'Data wygaśnięcia: <input class="tytul" type="date" name="data" value="'.$data_wygasniecia.'"><br /> <br />';
            $wynik .= 'Cena netto: <input class="tytul" type="text" name="netto" value="'.$cena_netto.'"><br /> <br />';
            $wynik .= 'Podatek VAT: <input class="tytul" type="number" name="vat" value="'.$podatek_vat.'"><br /> <br />';
            $wynik .= 'Ilość sztuk w magazynie: <input class="tytul" type="number" name="number" value="'.$ilosc.'"><br /> <br />';
            $wynik .= 'Kategoria: <input class="tytul" type="number" name="category" value="'.$kategoria.'"><br /> <br />';
            $wynik .= 'Zdjęcie: <input class="tytul" type="file" name="zdjecie" ><br /> <br />';
            $wynik .= '<input class="zapisz" type="submit" name="update" value="zapisz">'.'</form>';
            //<img src="data:image/png;base64,'.base64_encode($zdjecie).'"/>
            
            return $wynik;
        }
    }
    
     
}


?>


