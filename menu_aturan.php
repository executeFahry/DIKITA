<link rel="stylesheet" href="assets/css/custom.css">
<div class="form-aturan card">
   <div class="card-header text-white"><strong>Data Rule Base</strong></div>
   <div class="card-body">
      <a class="btn btn-primary mb-2 text-white" href="?page=aturan&action=tambah"> <i class="fas fa-plus"></i> Tambah</a>
      <table class="table table-bordered" id="myTable">
         <thead>
            <tr class="text-center">
               <th width="5%">No.</th>
               <th width="37.5%">Nama Penyakit</th>
               <th width="37.5%">Keterangan</th>
               <th width="20%">Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $counter = 1;
            $sql = "SELECT rule_based.id_aturan, rule_based.id_penyakit, penyakit.nama_penyakit, penyakit.keterangan FROM rule_based INNER JOIN penyakit WHERE rule_based.id_penyakit = penyakit.id_penyakit ORDER BY nama_penyakit ASC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
               <tr>
                  <td class="text-center"><?php echo $counter++; ?></td>
                  <td><?php echo $row['nama_penyakit']; ?></td>
                  <td><?php echo $row['keterangan']; ?></td>
                  <td class="text-center">
                     <a class="btn btn-primary" href="?page=aturan&action=detail&id=<?php echo $row['id_aturan']; ?>">
                        <i class="fas fa-list"></i>
                     </a>
                     <a class="btn btn-warning" href="?page=aturan&action=update&id=<?php echo $row['id_aturan']; ?>">
                        <i class="fas fa-edit"></i>
                     </a>
                     <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger" href="?page=aturan&action=hapus&id=<?php echo $row['id_aturan']; ?>">
                        <i class="fas fa-trash-alt"></i>
                     </a>
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