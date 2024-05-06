<?php

$id_penyakit = $_GET['id']; // ambil id penyakit dari data yang akan diupdate

if (isset($_POST['update'])) {
   $nama_penyakit = $_POST['nama_penyakit']; // simpan data dari form
   $keterangan = $_POST['keterangan']; // simpan data dari form
   $solusi = $_POST['solusi']; // simpan data dari form

   // proses update
   $sql = "UPDATE penyakit SET nama_penyakit = '$nama_penyakit', keterangan = '$keterangan', solusi = '$solusi' WHERE id_penyakit ='$id_penyakit'";
   if ($conn->query($sql) === TRUE) {
      header("Location:?page=penyakit");
   }
}

$sql = "SELECT * FROM penyakit WHERE id_penyakit = '$id_penyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="form-penyakit row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Update Data Penyakit</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <label for="">Nama Penyakit</label>
                     <input type="text" class="form-control" name="nama_penyakit" value="<?php echo $row['nama_penyakit'] ?>" maxlength="200" required>
                  </div>
                  <div class="form-group">
                     <label for="">Keterangan</label>
                     <input type="text" class="form-control" name="keterangan" value="<?php echo $row['keterangan'] ?>" maxlength="500" required>
                  </div>
                  <div class="form-group">
                     <label for="">Solusi</label>
                     <input type="text" class="form-control" name="solusi" value="<?php echo $row['solusi'] ?>" maxlength="500" required>
                  </div>
                  <input class="btn btn-primary" type="submit" name="update" value="Update">
                  <a class="btn btn-danger" href="?page=penyakit">Batal</a>
               </div>
            </div>
      </form>
   </div>
</div>