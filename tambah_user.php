<?php
require "config.php";
// proses tambah user
if (isset($_POST["simpan"])) {
   $username = strtolower(stripslashes($_POST["username"]));
   $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
   $role = $_POST["role"];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

   if (mysqli_num_rows($result) === 1) {
      echo "<script>alert('Username sudah terdaftar!');</script>";
   } else {
      $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
      if (mysqli_query($conn, $query)) {
         echo "<script>alert('Data user berhasil ditambahkan!');</script>";
         echo "<script>location='index.php?page=user';</script>";
      } else {
         echo "<script>alert('Data user gagal ditambahkan!');</script>";
      }
   }
}
?>

<div class="form-user row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Tambah Data User</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <label class="font-weight-bold">Username</label>
                     <input type="text" class="form-control" name="username" maxlength="50" required>
                  </div>
                  <div class="form-group">
                     <label class="font-weight-bold">Password</label>
                     <input type="password" class="form-control" name="password" maxlength="20" required>
                  </div>
                  <div class="form-group">
                     <label class="font-weight-bold">Role</label>
                     <select class="form-control chosen" name="role" required>
                        <option value="" disabled selected hidden>Pilih Role User</option>
                        <option value="Dokter">Dokter</option>
                        <option value="Admin">Admin</option>
                        <option value="Pasien">Pasien</option>
                     </select>
                  </div>
                  <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                  <a class="btn btn-danger" href="?page=user">Batal</a>
               </div>
            </div>
      </form>
   </div>
</div>