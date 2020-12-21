<?php
    session_start();
    include ('include/connect.php');
?>

<?php
    if(!isset($_SESSION['id_pengguna'])){
        header('location:login.php');
    }else{
        if($_SESSION['level'] != 'admin'){
            header('location:index.php');
        }
    }
?>

<?php 
    if(isset($_GET['id_kontak'])){
        $id_kontak = $_GET['id_kontak'];
    }else{
        header('location:admin-contact.php');
    }
?>

<!-- QUERY HAPUS DATA -->

<?php
    $queryDelete = mysqli_query($conn,"DELETE FROM kontak WHERE id_kontak = $id_kontak") or die("Error");
    header('location:admin-contact.php');
?>