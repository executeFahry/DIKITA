<?php
session_start();

// jika sudah login, maka arahkan ke halaman index
if (isset($_SESSION['role'])) {
   header("location:index.php");
   exit();
}

require "config.php";

if (isset($_POST["submit"])) {

   $username = $_POST["username"];
   $password = $_POST["password"];

   $sql = "SELECT * FROM users WHERE username ='$username' AND password='$password'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // set session
      $_SESSION['username'] = $row["username"];
      $_SESSION['role'] = $row["role"];
      $_SESSION['status'] = "y";

      header("location:index.php");
      exit();
   } else {
      header("location:?msg=n");
   }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>DIKITA - Login</title>

   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
   <!-- tampilan login gagal -->
   <?php
   if (isset($_GET['msg'])) {
      if ($_GET['msg'] == "n") {
   ?>
         <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Username atau Password Salah!</strong>
         </div>
   <?php
      }
   }
   ?>
   <div class="container-fluid" style="margin-top:150px">
      <div class="row">
         <div class="col-lg-4 offset-lg-4">
            <form method="POST">
               <div class="card border-dark">
                  <div class="card-header text-light border-dark text-center">
                     <img src="./assets/img/navbar-logo.svg" alt="Dikita Logo" width="100px" height="100px">
                  </div>
                  <div class="card-body border">
                     <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" autocomplete="off" required>
                     </div>
                     <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="off" required>
                     </div>
                     <input type="submit" class="btn btn-primary" name="submit" value="Login">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script src="assets/js/jquery-3.7.0.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>