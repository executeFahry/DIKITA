<?php

$id_aturan = $_GET['id']; // ambil id dari data yang akan dihapus

// hapus data rule base
$sql = "DELETE FROM rule_based WHERE id_aturan = '$id_aturan'";
$conn->query($sql);

// hapus data detail rule base
$sql = "DELETE FROM detail_rule_based WHERE id_aturan = '$id_aturan'";
$conn->query($sql);

header("Location:?page=aturan");
$conn->close();
