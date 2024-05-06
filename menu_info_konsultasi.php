<link rel="stylesheet" href="assets/css/custom.css">
<div class="form-info-konsul card">
   <div class="card-header text-white"><strong>Data Konsultasi Pasien</strong></div>
   <div class="card-body">
      <table class="table table-bordered" id="myTable">
         <thead>
            <tr class="text-center">
               <th width="5%">No.</th>
               <th width="37.5%">Tanggal</th>
               <th width="37.5%">Nama Pasien</th>
               <th width="20%">Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $counter = 1;
            $sql = "SELECT * FROM konsultasi ORDER BY tanggal DESC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
               <tr>
                  <td class="text-center"><?php echo $counter++; ?></td>
                  <td><?php echo $row['tanggal']; ?></td>
                  <td><?php echo $row['nama_pasien']; ?></td>
                  <td class="text-center">
                     <a class="btn btn-primary" href="?page=info_konsultasi&action=detail&id=<?php echo $row['id_konsultasi']; ?>">
                        <i class="fas fa-list"></i>
                     </a>
                     <a class="btn btn-danger" href="?page=info_konsultasi&action=delete&id=<?php echo $row['id_konsultasi']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i>
                  </td>
               </tr>
            <?php
            }
            $conn->close();
            ?>
         </tbody>
      </table>
   </div>
</div>