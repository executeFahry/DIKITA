<?php
if (isset($_POST['simpan'])) {
   $nama_penyakit = $_POST['nama_penyakit']; // simpan data dari form

   // validasi nama penyakit
   $sql = "SELECT rule_based.id_aturan, rule_based.id_penyakit, penyakit.nama_penyakit FROM rule_based INNER JOIN penyakit ON rule_based.id_penyakit = penyakit.id_penyakit WHERE rule_based.id_penyakit = '$nama_penyakit'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
?>
      <div class="alert alert-danger alert-dismissible fade show">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <strong>Data basis aturan penyakit tersebut sudah ada!</strong>
      </div>
<?php
   } else {
      // mengambil data penyakit
      $sql = "SELECT * FROM penyakit WHERE nama_penyakit = '$nama_penyakit'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $id_penyakit = $row['id_penyakit'];

      // proses simpan data rule base
      $sql = "INSERT INTO rule_based VALUES (null,'$id_penyakit')";
      mysqli_query($conn, $sql);

      // mengambil data id gejala
      $id_gejala = $_POST['id_gejala'];

      // proses mengambil data rule base
      $sql = "SELECT * FROM rule_based ORDER BY id_aturan DESC LIMIT 1";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $id_aturan = $row['id_aturan'];

      // proses simpan data detail rule base
      $jumlah = count($id_gejala);
      for ($i = 0; $i < $jumlah; $i++) {
         $sql = "INSERT INTO detail_rule_based VALUES ('$id_aturan','$id_gejala[$i]')";
         mysqli_query($conn, $sql);
      }
      header("Location:?page=aturan");
   }
}
?>

<div class="form-aturan row">
   <div class="col-sm-12">
      <form action="" method="POST" name="form" onsubmit="return validasiForm()">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header text-white border-dark"><strong>Tambah Data Rule Base</strong></div>
               <div class="card-body">
                  <!-- Form Penyakit -->
                  <div class="form-group">
                     <label class="font-weight-bold">Nama Penyakit</label>
                     <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nama_penyakit">
                        <option value=""></option>
                        <?php
                        $sql = "SELECT * FROM penyakit ORDER BY nama_penyakit ASC";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                           <option value="<?php echo $row['nama_penyakit']; ?>"><?php echo $row['nama_penyakit']; ?></option>
                        <?php
                        }
                        ?>
                     </select>
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
                  <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                  <a class="btn btn-danger" href="?page=aturan">Batal</a>
               </div>
            </div>
      </form>
   </div>
</div>

<script type="text/javascript">
   function validasiForm() {
      let namaPenyakit = document.forms["form"]["nama_penyakit"].value;
      let checkIdGejala = document.getElementsByName('<?php echo 'id_gejala[]'; ?>');
      let isChecked = false;

      // validasi ketika keduanya kosong
      for (let i = 0; i < checkIdGejala.length; i++) {
         if (checkIdGejala[i].checked) {
            isChecked = true;
            break;
         }
      }

      if (namaPenyakit == "" && !isChecked) {
         alert('Nama penyakit dan gejala harus diisi!');
         return false;
      }

      // validasi nama penyakit
      if (namaPenyakit == "") {
         alert('Nama penyakit harus diisi!');
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