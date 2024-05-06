<?php
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['proses'])) {

   // mengambil data dari form
   $nama_pasien = $_POST['nama_pasien'];
   $tanggal = date('Y-m-d');

   // proses simpan data konsultasi
   $sql = "INSERT INTO konsultasi (tanggal, nama_pasien) VALUES ('$tanggal', '$nama_pasien')";
   mysqli_query($conn, $sql);

   // mengambil data id gejala
   $id_gejala = $_POST['id_gejala'];

   // proses mengambil data konsultasi
   $sql = "SELECT * FROM konsultasi ORDER BY id_konsultasi DESC LIMIT 1";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $id_konsultasi = $row['id_konsultasi'];

   // proses simpan data detail konsultasi
   $jumlah = count($id_gejala);
   for ($i = 0; $i < $jumlah; $i++) {
      $sql = "INSERT INTO detail_konsultasi (id_konsultasi, id_gejala) VALUES ('$id_konsultasi','$id_gejala[$i]')";
      mysqli_query($conn, $sql);
   }
   // mengambil data dari tabel penyakit untuk dicek di rule base
   $sql_ambil = "SELECT * FROM penyakit";
   $result_ambil = $conn->query($sql_ambil);
   while ($row_ambil = $result_ambil->fetch_assoc()) {
      $id_penyakit = $row_ambil['id_penyakit'];
      $jumlah_true = 0; // jumlah gejala yang benar

      // hitung jumlah gejala di rule base berdasarkan penyakit
      $sql_hitung = "SELECT COUNT(id_penyakit) AS jumlah_gejala FROM rule_based INNER JOIN detail_rule_based ON rule_based.id_aturan = detail_rule_based.id_aturan WHERE id_penyakit = '$id_penyakit'";
      $result_hitung = $conn->query($sql_hitung);
      $row_hitung = $result_hitung->fetch_assoc();
      $jumlah_gejala = $row_hitung['jumlah_gejala'];

      // mencari gejala di rule base
      $sql_cari = "SELECT id_penyakit, id_gejala FROM rule_based INNER JOIN detail_rule_based ON rule_based.id_aturan = detail_rule_based.id_aturan WHERE id_penyakit = '$id_penyakit'";
      $result_cari = $conn->query($sql_cari);
      while ($row_cari = $result_cari->fetch_assoc()) {
         $id_gejala_rule = $row_cari['id_gejala'];

         // membandingkan gejala yang dipilih dengan gejala di rule base
         $sql_cek = "SELECT id_gejala FROM detail_konsultasi WHERE id_konsultasi = '$id_konsultasi' AND id_gejala = '$id_gejala_rule'";
         $result_cek = $conn->query($sql_cek);
         if ($result_cek->num_rows > 0) {
            $jumlah_true += 1;
         }
      }

      // mencari persentase gejala yang benar
      if ($jumlah_gejala > 0) {
         $peluang = round(($jumlah_true / $jumlah_gejala) * 100, 2);
      } else {
         $peluang = 0;
      }

      // simpan data detail penyakit
      if ($peluang > 0) {
         $sql = "INSERT INTO detail_penyakit (id_konsultasi, id_penyakit, persentase) VALUES ('$id_konsultasi','$id_penyakit','$peluang')";
         mysqli_query($conn, $sql);
      }

      header("Location:?page=konsultasi&action=hasil&id_konsultasi=$id_konsultasi");
   }
}
?>
<div class="form-konsultasi row">
   <div class="col-sm-12">
      <form action="" method="POST" name="form" onsubmit="return validasiForm()">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Konsultasi Pasien</strong></div>
               <div class="card-body">
                  <!-- Form Penyakit -->
                  <div class="form-group">
                     <label class="font-weight-bold">Nama Pasien</label>
                     <input type="text" class="form-control" name="nama_pasien" maxlength="50">
                  </div>

                  <!-- Tabel Gejala -->
                  <div class="form-group">
                     <strong><label for="">Pilih Gejala Penyakit:</label></strong>
                     <table class="table table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th width="5%">Pilih</th>
                              <th width="95%">Nama Gejala</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                           ?>
                              <tr>
                                 <td class="text-center"><input type="checkbox" class="check-item" name="<?php echo 'id_gejala[]'; ?>" value="<?php echo $row['id_gejala']; ?>"></td>
                                 <td><?php echo $row['nama_gejala']; ?></td>
                              </tr>
                           <?php
                           }
                           $conn->close();
                           ?>
                        </tbody>
                     </table>
                  </div>
                  <input class="btn btn-primary" type="submit" name="proses" value="Proses">
                  <a class="btn btn-danger" href="index.php">Kembali</a>
               </div>
            </div>
      </form>
   </div>
</div>

<script type="text/javascript">
   // validasi form 
   function validasiForm() {
      let namaPasien = document.forms["form"]["nama_pasien"].value;
      let checkIdGejala = document.getElementsByName('<?php echo 'id_gejala[]'; ?>');
      let isChecked = false;

      // validasi ketika keduanya kosong
      for (let i = 0; i < checkIdGejala.length; i++) {
         if (checkIdGejala[i].checked) {
            isChecked = true;
            break;
         }
      }

      if (namaPasien == "" && !isChecked) {
         alert('Nama pasien dan gejala harus diisi!');
         return false;
      }

      // validasi nama Pasien
      if (namaPasien == "") {
         alert('Nama pasien harus diisi!');
         return false;
      }

      // validasi gejala
      for (let i = 0; i < checkIdGejala.length; i++) {
         if (checkIdGejala[i].checked) {
            isChecked = true;
            break;
         }
      }
      if (!isChecked) {
         alert('Gejala harus dipilih!');
         return false;
      }
   }
</script>