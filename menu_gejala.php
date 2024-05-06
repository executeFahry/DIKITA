<link rel="stylesheet" href="assets/css/custom.css">
<div class="form-gejala card">
   <div class="card-header text-white"><strong>Data Gejala</strong></div>
   <div class="card-body">
      <a class="btn btn-primary mb-2 text-white" href="?page=gejala&action=tambah"> <i class="fas fa-plus"></i> Tambah</a>
      <table class="table table-bordered" id="myTable">
         <thead>
            <tr class="text-center">
               <th width="5%">No.</th>
               <th width="75%">Gejala</th>
               <th width="20%">Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $counter = 1;
            $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
               <tr>
                  <td class="text-center"><?php echo $counter++; ?></td>
                  <td><?php echo $row['nama_gejala']; ?></td>
                  <td class="text-center">
                     <a class="btn btn-warning" href="?page=gejala&action=update&id=<?php echo $row['id_gejala']; ?>">
                        <i class="fas fa-edit"></i>
                     </a>
                     <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger" href="?page=gejala&action=hapus&id=<?php echo $row['id_gejala']; ?>">
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