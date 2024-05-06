<!-- proses menampilkan data rule base -->
<?php
$id_aturan = $_GET['id']; // ambil id gejala dari data yang akan diupdate

$sql = "SELECT rule_based.id_aturan, rule_based.id_penyakit, penyakit.nama_penyakit, penyakit.keterangan FROM rule_based INNER JOIN penyakit ON rule_based.id_penyakit = penyakit.id_penyakit WHERE rule_based.id_aturan = '$id_aturan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!-- tampil halaman detail -->
<div class="form-aturan row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Detail Data Rule Base</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <label for="">Nama Penyakit</label>
                     <input type="text" class="form-control" value="<?php echo $row['nama_penyakit']; ?>" name="nama" readonly>
                  </div>
                  <div class="form-group">
                     <label for="">Keterangan</label>
                     <input type="text" class="form-control" value="<?php echo $row['keterangan']; ?>" name="ket" readonly>
                  </div>
                  <!-- tabel gejala-gejala -->
                  <label for="">Gejala-Gejala Penyakit</label>
                  <table class="table table-bordered">
                     <thead>
                        <tr class="text-center">
                           <th width="5%">No.</th>
                           <th width="95%">Nama Gejala</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $counter = 1;
                        $sql = "SELECT detail_rule_based.id_aturan, detail_rule_based.id_gejala, gejala.nama_gejala FROM detail_rule_based INNER JOIN gejala ON detail_rule_based.id_gejala = gejala.id_gejala WHERE detail_rule_based.id_aturan = '$id_aturan'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                           <tr>
                              <td class="text-center"><?php echo $counter++; ?></td>
                              <td><?php echo $row['nama_gejala']; ?></td>
                           </tr>
                        <?php
                        }
                        $conn->close();
                        ?>

                     </tbody>
                  </table>
                  <a class="btn btn-danger" href="?page=aturan">Kembali</a>
               </div>
            </div>
      </form>
   </div>
</div>