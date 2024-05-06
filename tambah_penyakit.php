<?php

if (isset($_POST['simpan'])) {
   $nama_penyakit = $_POST['nama_penyakit']; // simpan data dari form
   $keterangan = $_POST['keterangan']; // simpan data dari form
   $solusi = $_POST['solusi']; // simpan data dari form

   //proses simpan
   $sql = "INSERT INTO penyakit VALUES (null,'$nama_penyakit','$keterangan','$solusi')";
   if ($conn->query($sql) === TRUE) {
      header("Location:?page=penyakit");
   }
}
?>

<div class="form-penyakit row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Tambah Data Penyakit</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <label class="font-weight-bold">Nama Penyakit</label>
                     <input type="text" class="form-control" name="nama_penyakit" maxlength="200" required>
                  </div>
                  <div class="form-group">
                     <label class="font-weight-bold">Keterangan Penyakit</label>
                     <input type="text" class="form-control" name="keterangan" maxlength="500" required>
                  </div>
                  <div class="form-group">
                     <label class="font-weight-bold">Solusi Penyakit</label>
                     <input type="text" class="form-control" name="solusi" maxlength="500" required>
                  </div>

                  <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                  <a class="btn btn-danger" href="?page=penyakit">Batal</a>

               </div>
            </div>
      </form>
   </div>
</div>