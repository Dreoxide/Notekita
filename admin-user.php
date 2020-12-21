<?php
    session_start();
    include ('include/connect.php');
?>

<?php 
  if(!isset($_SESSION['id_pengguna'])){
    header('location:login.php');
  }else{
    if($_SESSION['level'] == 'reguler'){
      header('location:index.php');
    }
  }
?>

<?php
    $queryKontak = mysqli_query($conn,"SELECT * FROM pengguna WHERE level != 'admin' ");
    $nomor = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Notekita - Manajemen User</title>
<?php include ('include/head.php'); ?>
</head>
<body>
<?php include 'include/nav.php'; ?>
<div class="container">
    <h1 style="margin: 15px 0; text-align: center;">Manajemen User</h3>
    <?php if(mysqli_num_rows($queryKontak) > 0): ?>
        <table class="table table-succes table-striped  table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($result = mysqli_fetch_array($queryKontak)): ?>
                    <tr>
                        <th scope="row"><?php echo $nomor ?></th>
                        <td><?php echo $result['nama'] ?></td>
                        <td><?php echo $result['email'] ?></td>
                        <td><?php echo $result['alamat'] ?></td>
                        <td><?php echo $result['kota'] ?></td>
                        <td class="row mx-0">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger p-1 mx-2" name="delete" onclick=delconfirm(<?php echo $result['id_pengguna'] ?>)>Delete</button>
                            </div>
                        </td>
                    </tr>
                    <?php $nomor ++ ?>
                <?php endwhile ?>
            </tbody>
        </table>
    <?php else: ?>
        <h3 style="text-align: center;">Belum ada data yang masuk!</h3>
    <?php endif ?>
</div>
<?php include ('include/footer.php') ?>
<script>
    function delconfirm(id_pengguna){
        if(confirm("Apakah Anda yakin ingin menghapus user tersebut?")){
            window.location.href='delete-user.php?id_pengguna=' + id_pengguna + '';
        }
    }
</script>
</body>
</html>
