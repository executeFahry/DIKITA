<?php
require "config.php";

$id_konsultasi = $_GET['id']; // ambil id dari data yang akan dihapus

// hapus data konsultasi
$sql = "DELETE FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'";
if ($conn->query($sql) === TRUE) {
   
   header("Location:?page=info_konsultasi");
}

$conn->close();
