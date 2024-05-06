<?php
require 'config.php';

if ($_SESSION['role'] === "Admin") {
   $userRole = "Admin";
} else if ($_SESSION['role'] === "Dokter") {
   $userRole = "Dokter";
} else {
   $userRole = "Pasien";
}

$sql = mysqli_query($conn, "SELECT * FROM users WHERE role = '$userRole'");

if (mysqli_num_rows($sql) === 1) {
   $row = mysqli_fetch_assoc($sql);
} else {
   echo "Welcome!";
}

$conn->close();

?>

<link rel="stylesheet" href="assets/css/custom.css">

<div class="container mt-3">
   <h1 class="text-center welcome">Selamat Datang,
      <span class="">
         <?php echo $row["role"] ?>!
      </span>
   </h1>
   <h3 class="text-center text">Sistem Pakar Diagnosis Penyakit Pada Mata</h3>
</div>