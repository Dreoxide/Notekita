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
    $queryKontak = mysqli_query($conn,"SELECT * FROM kontak");
    $nomor = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Notekita - Pesan</title>
<?php include ('include/head.php'); ?>
</head>
<body>
<?php include 'include/nav.php'; ?>
<div class="container">
    <h1 style="margin: 15px 0; text-align: center;">Tampungan Pesan</h3>
    <?php if(mysqli_num_rows($queryKontak) > 0): ?>
        <table class="table table-succes table-striped  table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subjek</th>
                    <th scope="col">Pesan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($result = mysqli_fetch_array($queryKontak)): ?>
                    <tr>
                        <th scope="row"><?php echo $nomor ?></th>
                        <td><?php echo $result['nama'] ?></td>
                        <td><?php echo $result['email'] ?></td>
                        <td><?php echo $result['subjek'] ?></td>
                        <td><?php echo nl2br($result['pesan']) ?></td>
                        <td>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger p-1 mx-2" name="delete" onclick=delconfirm(<?php echo $result['id_kontak'] ?>)>Delete</button>
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
    function delconfirm(id_kontak){
        if(confirm("Apakah Anda yakin ingin menghapus pesan tersebut?")){
            window.location.href='delete-contact.php?id_kontak=' + id_kontak + '';
        }
    }
</script>
</script>
</body>
</html>
