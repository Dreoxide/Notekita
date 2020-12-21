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
    if(isset($_GET['id_pengguna'])){
        $id_pengguna = $_GET['id_pengguna'];
    }else{
        header('location:admin-user.php');
    }
?>

<!-- QUERY HAPUS DATA -->

<?php
    $queryCek = mysqli_query($conn,"SELECT level FROM pengguna WHERE id_pengguna = $id_pengguna");
    $result = mysqli_fetch_array($queryCek);
    if($result['level'] == 'reguler'){
        $queryDeleteCatatan = mysqli_query($conn,"DELETE FROM catatan WHERE id_pengguna = $id_pengguna") or die("Error");
        $queryDeletePengguna = mysqli_query($conn,"DELETE FROM pengguna WHERE id_pengguna = $id_pengguna") or die("Error");
    }
    header('location:admin-user.php');
?>