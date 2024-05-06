<?php
// proses menampilkan data penyakit dari rule base -->
$id_aturan = $_GET['id']; // ambil id aturan dari data yang akan diupdate

$sql = "SELECT rule_based.id_aturan, rule_based.id_penyakit, penyakit.nama_penyakit FROM rule_based INNER JOIN penyakit ON rule_based.id_penyakit = penyakit.id_penyakit WHERE id_aturan = '$id_aturan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// proses update data penyakit dari rule base
if (isset($_POST['update'])) {
   $id_gejala = $_POST['id_gejala']; // simpan data dari form

   // proses simpan detail rule base
   if ($id_gejala = null) {
      $jumlah = count($id_gejala);
      for ($i = 0; $i < $jumlah; $i++) {
         $sql = "INSERT INTO detail_rule_based VALUES ('$id_aturan','$id_gejala[$i]')";
         mysqli_query($conn, $sql);
      }
   }
   header("Location:?page=aturan");
}

?>

<div class="form-aturan row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Update Data Rule Base</strong></div>
               <div class="card-body">
                  <!-- Form Penyakit -->
                  <div class="form-group">
                     <label class="font-weight-bold">Nama Penyakit</label>
                     <input type="text" class="form-control" value="<?php echo $row['nama_penyakit']; ?>" disabled>
                  </div>

                  <!-- Tabel Gejala -->
                  <div class=" form-group">
                     <strong><label for="">Pilih Gejala Penyakit:</label></strong>
                     <table class="table table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th width="5%">Pilih</th>
                              <th width="90%">Nama Gejala</th>
                              <th width="5%"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              $id_gejala = $row['id_gejala'];
                              // cek ke tabel detail rule based
                              $sql_cek = "SELECT * FROM detail_rule_based WHERE id_aturan = '$id_aturan' AND id_gejala = '$id_gejala'";
                              $result_cek = $conn->query($sql_cek);
                              $row_cek = $result_cek->fetch_assoc();
                              if ($result_cek->num_rows > 0) {
                                 // jika ditemukan maka tampilkan data yang terchecklist dan disabled
                           ?>
                                 <tr>
                                    <td class="text-center"><input type="checkbox" class="check-item" disabled="disabled"></td>
                                    <td><?php echo $row['nama_gejala']; ?></td>
                                    <td>
                                       <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger" href="?page=aturan&action=hapus_gejala&id_aturan=<?php echo $id_aturan; ?>&id_gejala=<?php echo $id_gejala; ?>">
                                          <i class="fas fa-trash-alt"></i>
                                       </a>
                                    </td>
                                 </tr>
                              <?php
                              } else {
                                 // jika tidak ditemukan maka tampilkan data yang tidak terchecklist 
                              ?>
                                 <tr>
                                    <td class="text-center"><input type="checkbox" class="check-item" name="<?php echo 'id_gejala[]'; ?>" value="<?php echo $row['id_gejala']; ?>"></td>
                                    <td><?php echo $row['nama_gejala']; ?></td>
                                    <td class="text-center">
                                       <i class="fas fa-trash-alt"></i>
                                    </td>
                                 </tr>
                           <?php
                              }
                           }
                           $conn->close();
                           ?>
                        </tbody>
                     </table>
                  </div>
                  <input class="btn btn-primary" type="submit" name="update" value="Update">
                  <a class="btn btn-danger" href="?page=aturan">Batal</a>
               </div>
            </div>
      </form>
   </div>
</div>