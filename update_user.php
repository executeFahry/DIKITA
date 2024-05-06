<?php

$id_user = $_GET['id'];

if (isset($_POST['update'])) {
   $role = $_POST['role'];

   // proses update
   $sql = "UPDATE users SET role = '$role' WHERE id_user ='$id_user'";
   if ($conn->query($sql) === TRUE) {
      header("Location:?page=user");
   }
}

$sql = "SELECT * FROM users WHERE id_user = '$id_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="form-user row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Update Data User</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <label for="">Username</label>
                     <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" maxlength="50" readonly>
                  </div>
                  <div class="form-group">
                     <label for="">Password</label>
                     <input type="text" class="form-control" name="password" readonly>
                  </div>
                  <div class="form-group">
                     <label for="">Role</label>
                     <select class="form-control chosen" name="role">
                        <option value="" disabled selected hidden><?php echo $row['role'] ?></option>
                        <option value="Dokter">Dokter</option>
                        <option value="Admin">Admin</option>
                        <option value="User">Pasien</option>
                     </select>
                  </div>
                  <input class="btn btn-primary" type="submit" name="update" value="Update">
                  <a class="btn btn-danger" href="?page=user">Batal</a>
               </div>
            </div>
      </form>
   </div>
</div>