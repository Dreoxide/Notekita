<?php
    session_start();
    include ('include/connect.php');
    $verification = '';
?>

<?php
    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $verification = "Format email tidak valid!";
        }else{
            $checkEmail = mysqli_num_rows(mysqli_query($conn,"SELECT email FROM pengguna WHERE email = '$email'"));
            if($checkEmail > 0){
                $verification = "Email telah digunakan pengguna lain!";
            }else{
                $query = mysqli_query($conn,"INSERT INTO pengguna (nama,email,password,alamat,kota) VALUES ('$nama','$email','$password','$alamat','$kota')");
                echo "
                    <script>
                        alert('Anda telah berhasil melakukan registrasi!');
                        window.location.href='login.php';
                    </script>
                ";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include ('include/head.php'); ?>
	<title>Notekita - Register</title>
  <style>
      .form-container {
          box-shadow: 12px 12px 24px rgb(128, 128, 128);
      }
      row.btn{
          outline: 0px;
          border: none;  
      }
  </style>
</head>
<body>
    <?php include ('include/nav.php'); ?>
    <section class="Form my-5 mx-5">
        <div class="container">
            <div  class="form-container row g-0">
                <div class="d-flex col-md-5">
                    <img class="align-items-center img-fluid p-2" style="background-color: rgba(1, 150, 150, .7)    ;" src="pictures/Register-undraw.svg" alt="Gambar Register Undraw">
                </div>
                <div class="col-md-7 px-5 ">
                    <h1 class="text-center font-weight-bold pt-3">Notekita</h1>
                    <h4 class="text-center" >Register Form</h4>
                    <form method="POST" action="" class="row pt-3 g-3">
                            <div class="col-md-7">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="nama" placeholder="Enter Name" maxlength='40' required>
                            </div>
                                <div class="col-md-7">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Enter Email" maxlength='40' required>
                                </div>
                                <div class="col-md-7">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Enter Password" maxlength='14' required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="Alamat" name="alamat" maxlength="150" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="inputCity" placeholder="Indramayu" name="kota" maxlength='40' required>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-check">
                                    <input class="form-check-input " type="checkbox" id="gridCheck" required>
                                    <label class="form-check-label" for="gridCheck">
                                        Dengan membuat akun ini anda menyetujui semua peraturan yang ada.
                                    </label>
                                    </div>
                                </div>
                                <div class="form-row py-1">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-dark my-3 font-weight-bold" name="submit">
                                    </div>
                                </div>
                            </form>
                        <p style="color: red"><?php echo $verification ?></p>
                        <p class="text-right">Sudah punya akun? <a href="login.php">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include ('include/footer.php'); ?>
</body>
</html>
