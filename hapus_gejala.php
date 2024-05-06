<?php

$id_gejala = $_GET['id']; // ambil id dari data yang akan dihapus

$sql = "DELETE FROM gejala WHERE id_gejala = '$id_gejala'";
if ($conn->query($sql) === TRUE) {
   header("Location:?page=gejala");
}
$conn->close();
