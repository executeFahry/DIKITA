<?php
// mengaktifkan session
session_start();

// menghapus semua session
session_destroy();

// beralih ke halaman login
header("Location:login.php");
