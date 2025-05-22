<?php
require_once __DIR__ . '/../config/config.php'; // Panggil konfigurasi database

class Model {
    protected $db;

    public function __construct() {
        global $mysqli;
        $this->db = $mysqli;
    }

    // Contoh fungsi ambil data dari tabel
    public function getData($table) {
        $query = "SELECT * FROM $table";
        $result = $this->db->query($query);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // Contoh fungsi untuk menyimpan data
    public function insertData($table, $fields) {
        $columns = implode(", ", array_keys($fields));
        $values  = implode("', '", array_values($fields));
        
        $query = "INSERT INTO $table ($columns) VALUES ('$values')";
        return $this->db->query($query);
    }
}
?>
