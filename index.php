<?php
session_start();

if ($_SESSION['status'] != "y") {
   header("location:login.php");
   exit();
}

require "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DIKITA - Diagnosis Penyakit Mata</title>
   <link rel="shortcut icon" href="assets/fav.ico" type="image/x-icon">
   <!-- Bootstrap -->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="assets/css/custom.css">
   <!-- DataTables CSS -->
   <link rel="stylesheet" href="assets/css/datatables.min.css">
   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="assets/css/all.css">
   <!-- Bootstrap Chosen -->
   <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>

<body>
   <!-- Navbar Start -->
   <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="index.php">
         <img src="./assets/img/navbar-logo.svg" alt="DIKITA Logo" width="60px" height="60px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
         <ul class="navbar-nav ">
            <li class="nav-item">
               <a class="nav-link" href="index.php">Home</a>
            </li>
            <!-- Penentuan hak akses tiap roles-->
            <?php
            if ($_SESSION['role'] == "Admin") {
            ?>
               <li class="nav-item">
                  <a class="nav-link" href="?page=user">User</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="?page=gejala">Gejala</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="?page=penyakit">Penyakit</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="?page=aturan">Rule Based</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="?page=info_konsultasi">Konsultasi</a>
               </li>
            <?php
            } elseif ($_SESSION['role'] == "Dokter") {
            ?>
               <li class="nav-item">

                  <a class="nav-link" href="?page=aturan">Rule Based</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="?page=info_konsultasi">Konsultasi</a>
               </li>
            <?php
            } else {
            ?>
               <li class="nav-item">
                  <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
               </li>
            <?php
            }
            ?>
            <li class="nav-item">
               <a class="nav-link" href="?page=logout">Logout</a>
            </li>
         </ul>
      </div>
   </nav>
   <!-- Navbar End -->
   </div>

   <!-- Route Menu Setting Start -->
   <div class="container-fluid mt-2 mb-2">
      <?php

      $page = isset($_GET['page']) ? $_GET['page'] : "";
      $action = isset($_GET['action']) ? $_GET['action'] : "";

      if ($page == "") {
         include "welcome.php";
      } elseif ($page == "user") {
         if ($action == "") {
            include "menu_user.php";
         } elseif ($action == "tambah") {
            include "tambah_user.php";
         } elseif ($action == "update") {
            include "update_user.php";
         } else {
            include "hapus_user.php";
         }
      } elseif ($page == "gejala") {
         if ($action == "") {
            include "menu_gejala.php";
         } elseif ($action == "tambah") {
            include "tambah_gejala.php";
         } elseif ($action == "update") {
            include "update_gejala.php";
         } else {
            include "hapus_gejala.php";
         }
      } elseif ($page == "penyakit") {
         if ($action == "") {
            include "menu_penyakit.php";
         } elseif ($action == "tambah") {
            include "tambah_penyakit.php";
         } elseif ($action == "update") {
            include "update_penyakit.php";
         } else {
            include "hapus_penyakit.php";
         }
      } elseif ($page == "aturan") {
         if ($action == "") {
            include "menu_aturan.php";
         } elseif ($action == "tambah") {
            include "tambah_aturan.php";
         } elseif ($action == "detail") {
            include "detail_aturan.php";
         } elseif ($action == "update") {
            include "update_aturan.php";
         } elseif ($action == "hapus_gejala") {
            include "hapus_detail_aturan.php";
         } else {
            include "hapus_aturan.php";
         }
      } elseif ($page == "konsultasi") {
         if ($action == "") {
            include "menu_konsultasi.php";
         } else {
            include "hasil_konsultasi.php";
         }
      } elseif ($page == "info_konsultasi") {
         if ($action == "") {
            include "menu_info_konsultasi.php";
         } elseif ($action == "detail") {
            include "detail_info_konsultasi.php";
         } else {
            include "hapus_info_konsultasi.php";
         }
      } else {
         include "logout.php";
      }
      ?>
   </div>
   <!-- Route Menu Setting End-->

   <!-- JQuery -->
   <script src="assets/js/jquery-3.7.0.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- DataTables JS -->
   <script src="assets/js/datatables.min.js"></script>
   <script>
      $(document).ready(function() {
         $('#myTable').DataTable();
      });
   </script>
   <!-- Font Awesome JS -->
   <script src="assets/js/all.js"></script>
   <!-- Chosen JS -->
   <script src="assets/js/chosen.jquery.min.js"></script>
   <script>
      $(function() {
         $('.chosen').chosen();
      });
   </script>
</body>

</html>