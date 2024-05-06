<?php

if (isset($_POST['simpan'])) {
   $nama_gejala = $_POST['nama_gejala']; // simpan data dari form

   //proses simpan
   $sql = "INSERT INTO gejala VALUES (null,'$nama_gejala')";
   if ($conn->query($sql) === TRUE) {
      header("Location:?page=gejala");
   }
}
?>

<div class="form-gejala row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Tambah Data Gejala</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <label class="font-weight-bold">Nama Gejala</label>
                     <input type="text" class="form-control" name="nama_gejala" maxlength="200" required>
                  </div>

                  <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                  <a class="btn btn-danger" href="?page=gejala">Batal</a>

               </div>
            </div>
      </form>
   </div>
</div>