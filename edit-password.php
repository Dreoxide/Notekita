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
    if(isset($_POST["edit_pass"])){
        $email = $_POST['email'];
        $password_lama = md5($_POST['password_lama']);
        $password_baru = md5($_POST['password_baru']);
        $konfirmasi_password = md5($_POST['konfirmasi_password']);
        if($password_baru != $konfirmasi_password){
            echo "
                    <script>
                        alert('Password baru dengan konfirmasi password tidak sama!');
                        window.location.href='account.php';
                    </script>
                    ";
        }else{
            $queryPassword = mysqli_query($conn,"SELECT password FROM pengguna WHERE id_pengguna = $id_pengguna AND email = '$email'");
            if(mysqli_num_rows($queryPassword) < 1){
                header('location:index.php');
            }else{
                $result = mysqli_fetch_array($queryPassword);
                if($result['password'] != $password_lama){
                    echo "
                    <script>
                        alert('Password lama salah!');
                        window.location.href='account.php';
                    </script>
                    ";
                }else{
                    $queryGantiPassword = mysqli_query($conn,"UPDATE pengguna SET password = '$password_baru' WHERE id_pengguna = $id_pengguna AND email = '$email'");
                    if($queryGantiPassword){
                        echo "
                        <script>
                            alert('Berhasil mengubah password!');
                            window.location.href='account.php';
                        </script>
                    ";
                    }
                }
            }
        }
    }else{
        header('location:index.php');
    }
?>
