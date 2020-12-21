<?php
    session_start();
    include ('include/connect.php');
?>

<?php
    if(!isset($_SESSION['id_pengguna'])){
        header('location:login.php');
    }
?>

<!-- CEK KEPEMILIKAN DATA CATATAN -->

<?php
    if(isset($_GET['id_catatan'])){
        $id_catatan = $_GET['id_catatan'];
        $queryCek = mysqli_fetch_array(mysqli_query($conn,"SELECT id_pengguna FROM catatan WHERE id_catatan = $id_catatan"));
        if($queryCek['id_pengguna'] != $_SESSION['id_pengguna']){
            header('location:index.php');
        }
    }else{
        header('location:index.php');
    }
?>

<!-- QUERY HAPUS DATA -->

<?php
    $queryDelete = mysqli_query($conn,"DELETE FROM catatan WHERE id_catatan = $id_catatan") or die("Error");
    header('location:index.php');
?>