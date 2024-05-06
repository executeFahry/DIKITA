<?php
// proses menampilkan data hasil konsultasi
$id_konsultasi = $_GET['id_konsultasi'];

// mengambil data konsultasi
$sql = "SELECT * FROM konsultasi WHERE id_konsultasi =  '$id_konsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- tampilan hasil konsultasi -->
<div class="hasil-konsul jumbotron text-center">
   <h1 class="display-3">Halo,
      <?php
      echo $row['nama_pasien'];
      ?>!
   </h1>
   <hr class="my-4">
   <p>Kamu didiagnosa mengidap penyakit:</p>
   <?php
   $sql = "SELECT detail_penyakit.id_konsultasi, detail_penyakit.id_penyakit, penyakit.nama_penyakit, penyakit.solusi, detail_penyakit.persentase FROM detail_penyakit INNER JOIN penyakit ON detail_penyakit.id_penyakit = penyakit.id_penyakit WHERE id_konsultasi = '$id_konsultasi' ORDER BY persentase DESC LIMIT 1";
   $result = $conn->query($sql);
   while ($row = $result->fetch_assoc()) {
   ?>
      <h1 class="nama-penyakit">
         <?php echo $row['nama_penyakit']; ?>
      </h1>

      <p>Dengan kemungkinan
         <?php echo $row['persentase'] . "%"; ?>
      </p>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
         Lihat Solusi
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Solusi
                     <?php echo $row['nama_penyakit']; ?>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <?php echo $row['solusi']; ?>
               </div>
            </div>
         </div>
      </div>
   <?php
   }
   $conn->close();
   ?>
</div>