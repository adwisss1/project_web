<?php
require_once 'app/models/Model.php';

// Buat objek model
$model = new Model();

// Ambil data dari tabel admin
$data = $model->getData('admin');

// Cetak hasil
echo "<pre>";
print_r($data);
echo "</pre>";
?>
