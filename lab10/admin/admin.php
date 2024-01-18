<?php
// nie da się wejść na tą stronę wgl
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header('Location: ../user/login.php');
    exit();
} 
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
    header('Location: ../index.php');
    exit();
}
class ZarzadzajKategoriami {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function DodajKategorie($nazwa) {
        $query = "INSERT INTO kategorie (nazwa) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $nazwa);
        $stmt->execute();
    }

    public function UsunKategorie($id) {
        $query = "DELETE FROM kategorie WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function EdytujKategorie($id, $nazwa) {
        $query = "UPDATE kategorie SET nazwa = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $nazwa, $id);
        $stmt->execute();
    }

    public function PokazKategorie() {
        $query = "SELECT * FROM kategorie";
        $result = $this->db->query($query);
        
        
        
        while($row = $result->fetch_assoc()) {
        echo '<div class="category" ><b>' ."id: ". $row["id"]. "  ". $row["nazwa"]. "</b></div>";
        }
    }
}

?>
