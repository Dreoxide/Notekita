<?php
    session_start();
    include ('include/connect.php');
?>

<?php
    if(!isset($_SESSION['id_pengguna'])){
        header('location:login.php');
    }else{
        $id_pengguna = $_SESSION['id_pengguna'];
    }
?>

<?php
    if(isset($_POST['edit_account'])){
        $getEmail = $_POST['email'];
        $getNama = $_POST['nama'];
        $getAlamat = $_POST['alamat'];
        $getKota = $_POST['kota'];

        $queryUpdateAkun = mysqli_query($conn,"UPDATE pengguna SET nama = '$getNama', alamat = '$getAlamat', kota = '$getKota' WHERE id_pengguna = $id_pengguna AND email = '$getEmail'");
        if($queryUpdateAkun){
            echo "
                <script>
                    alert('Berhasil mengubah informasi akun!');
                    window.location.href='account.php';
                </script>
            ";
        }else{
            echo mysqli_error($conn);
        }
    }else{
        header('location:index.php');
    }
?>