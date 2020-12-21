<?php
  session_start();
  include ('include/connect.php');
?>

<?php 
  if(!isset($_SESSION['id_pengguna'])){
    header('location:login.php');
  }
?>

<?php
  if(isset($_POST['submit'])){
    $id_pengguna = $_SESSION['id_pengguna'];
    $judul = mysqli_real_escape_string($conn,$_POST['judul']);
    $konten = mysqli_real_escape_string($conn,$_POST['konten']);
    $queryInsertNote = mysqli_query($conn,"INSERT INTO catatan (id_pengguna,judul,konten,tanggal) VALUES ($id_pengguna,'$judul','$konten',curdate())");
    if($queryInsertNote){
      echo "
      <script>
        alert('Sukses menambahkan catatan!');
        window.location.href='index.php';
      </script>
    ";
    }
  }else{
    header('location:index.php');
  }
?>