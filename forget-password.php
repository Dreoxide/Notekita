<?php
    session_start();
    include ('include/connect.php');
?>

<?php
    if(isset($_POST['submit'])){
        $getEmail = $_POST['email'];
        $getKota = $_POST['kota'];
        $getPassword = md5($_POST['password']);
        $queryCek = mysqli_query($conn,"SELECT email, kota, password FROM pengguna WHERE email = '$getEmail'");
        if(mysqli_num_rows($queryCek) < 1){
            echo "
            <script>
                alert('Data yang Anda masukkan tidak ada di dalam database Notekita!');
                window.location.href='login.php';
            </script>
            ";
        }else{
            $resultCek = mysqli_fetch_array($queryCek);
            if($getEmail == $resultCek['email'] and $getKota == $resultCek['kota']){
                $queryPassword = mysqli_query($conn,"UPDATE pengguna SET password = '$getPassword' WHERE email = '$getEmail'");
                if($queryPassword){
                    echo "
                    <script>
                        alert('Berhasil mengganti Password!');
                        window.location.href='login.php';
                    </script>
                    ";
                }else{
                    echo "
                    <script>
                        alert('Error pada Query!');
                        window.location.href='login.php';
                    </script>
                    ";
                }
            }else{
                echo "
                    <script>
                        alert('Data yang Anda masukkan tidak ada di dalam database Notekita!');
                        window.location.href='login.php';
                    </script>
                ";
            }
        }
    }else{
        header('location:login.php');
    }
?>