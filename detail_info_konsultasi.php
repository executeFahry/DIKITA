<?php
// proses menampilkan data hasil konsultasi
$id_konsultasi = $_GET['id'];

// mengambil data konsultasi
$sql = "SELECT * FROM konsultasi WHERE id_konsultasi =  '$id_konsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<div class="form-info-konsul row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Detail Konsultasi Pasien</strong></div>
               <div class="card-body">
                  <div class="form-group">
                     <strong><label for="">Nama Pasien</label></strong>
                     <input type="text" class="form-control" value="<?php echo $row['nama_pasien']; ?>" name="nama" readonly>
                  </div>

                  <!-- tabel gejala-gejala -->
                  <strong><label for="">Gejala-Gejala Yang Diderita:</label></strong>
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
                        $sql = "SELECT detail_konsultasi.id_konsultasi, detail_konsultasi.id_gejala, gejala.nama_gejala FROM detail_konsultasi INNER JOIN gejala ON detail_konsultasi.id_gejala = gejala.id_gejala WHERE id_konsultasi = '$id_konsultasi'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                           <tr>
                              <td class="text-center"><?php echo $counter++; ?></td>
                              <td><?php echo $row['nama_gejala']; ?></td>
                           </tr>
                        <?php
                        }
                        ?>
                     </tbody>
                  </table>

                  <!-- hasil konsultasi penyakit -->
                  <strong><label for="">Hasil Konsultasi Penyakit:</label></strong>
                  <table class="table table-bordered">
                     <thead>
                        <tr class="text-center">
                           <th width="5%">No.</th>
                           <th width="45%">Nama Penyakit</th>
                           <th width="5%">Persentase</th>
                           <th width="45%">Solusi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $counter = 1;
                        $sql = "SELECT detail_penyakit.id_konsultasi, detail_penyakit.id_penyakit, penyakit.nama_penyakit, penyakit.solusi, detail_penyakit.persentase FROM detail_penyakit INNER JOIN penyakit ON detail_penyakit.id_penyakit = penyakit.id_penyakit WHERE id_konsultasi = '$id_konsultasi' ORDER BY persentase DESC";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                           <tr>
                              <td class="text-center"><?php echo $counter++; ?></td>
                              <td><?php echo $row['nama_penyakit']; ?></td>
                              <td class="text-center"><?php echo $row['persentase'] . "%"; ?></td>
                              <td><?php echo $row['solusi']; ?></td>
                           </tr>
                        <?php
                        }
                        $conn->close();
                        ?>
                     </tbody>
                  </table>
                  <a class="btn btn-danger" href="?page=info_konsultasi">Kembali</a>
               </div>
            </div>
      </form>
   </div>
</div>