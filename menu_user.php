<link rel="stylesheet" href="assets/css/custom.css">
<div class="form-user card">
   <div class="card-header text-white"><strong>Data User</strong></div>
   <div class="card-body">
      <a class="btn btn-primary mb-2 text-white" href="?page=user&action=tambah"> <i class="fas fa-plus"></i> Tambah</a>
      <table class="table table-bordered" id="myTable">
         <thead>
            <tr class="text-center">
               <th width="5%">No.</th>
               <th width="50%">Username</th>
               <th width="25%">Role</th>
               <th width="20%">Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $counter = 1;
            $sql = "SELECT * FROM users ORDER BY username ASC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
               <tr>
                  <td class="text-center"><?php echo $counter++; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['role']; ?></td>
                  <td class="text-center">
                     <a class="btn btn-warning" href="?page=user&action=update&id=<?php echo $row['id_user']; ?>">
                        <i class="fas fa-edit"></i>
                     </a>
                     <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger" href="?page=user&action=hapus&id=<?php echo $row['id_user']; ?>">
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