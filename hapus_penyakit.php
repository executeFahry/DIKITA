<?php

$id_penyakit = $_GET['id']; // ambil id dari data yang akan dihapus

$sql = "DELETE FROM penyakit WHERE id_penyakit = '$id_penyakit'";
if ($conn->query($sql) === TRUE) {
   header("Location:?page=penyakit");
}
$conn->close();
