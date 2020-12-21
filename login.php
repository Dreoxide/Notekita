<?php
session_start();
include('include/connect.php');
$verification = '';
?>

<?php
if (isset($_SESSION['id_pengguna'])) {
    header('location:index.php');
}
?>

<?php
if (isset($_POST['submit'])) {
    $getEmail = $_POST['email'];
    $getPassword = md5($_POST['password']);
    $check = mysqli_fetch_array(mysqli_query($conn, "SELECT id_pengguna, email, password, level FROM pengguna WHERE email = '$getEmail'"));
    if (!filter_var($getEmail, FILTER_VALIDATE_EMAIL)) {
        $verification = "Format email tidak valid!";
    } else {
        if ($getPassword == $check['password'] and $getEmail == $check['email']) {
            $_SESSION['id_pengguna'] = $check['id_pengguna'];
            $_SESSION['level'] = $check['level'];
            header('location:index.php');
        } else {
            $verification = "Email atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/head.php'); ?>
    <title>Notekita - Login</title>
    <style>
        section .row {
            box-shadow: 12px 12px 24px rgb(128, 128, 128);
        }

        row.btn {
            outline: 0px;
            border: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'include/nav.php'; ?>
    <main>

        <body>
            <section class="form my-5 mx-5">
                <div class="container">
                    <div class="form-container row g-0">
                        <div class="d-flex col-md-5">
                            <img class="align-items-center img-fluid px-2" style="background-color: rgba(1, 150, 150, .7)    ;" src="pictures/login-banner.svg" alt="Gambar Login Undraw">
                        </div>
                        <div class="col-md-7 px-5 ">
                            <h1 class="font-weight-bold pt-3">Notekita</h1>
                            <h4>Sign into your account</h4>

                            <form method="POST" action="" id="login">
                                <div class="form-row pt-4 py-1">
                                    <div class="col-md-7">
                                        <input class="form-control" type="email" placeholder="Email" name="email" required autofocus>
                                    </div>
                                </div>
                                <div class="form-row py-1">
                                    <div class="col-md-7">
                                        <input class="form-control " type="password" placeholder="Password" name="password" required>
                                    </div>
                                </div>
                                <div class="form-row py-1">
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-dark my-3 font-weight-bold" form="login" value="Submit">Log in</button>
                                    </div>
                                </div>
                                <p style="color: red;"><?php echo $verification; ?></p>
                                <!-- Button trigger modal -->
                                <p class="m-0">Lupa Password? <a class="text-secondary" href="" data-toggle="modal" data-target="#Lpasswordmodal">Click here</a></p>
                                <p>Belum punya akun? <a href="register.php">Register here</a></p>
                                <input type="hidden" value="submit" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Modal -->
            <form action="forget-password.php" method="POST">
                <div class="modal fade" id="Lpasswordmodal" data-backdrop="static" tabindex="-1" aria-labelledby="Lpassword" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="Lpassword">Lupa Password</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row  justify-content-center ">
                                    <div class="bg-light col">
                                        <h5 class="text-center">Identify Yourself</h5>
                                    </div>
                                </div>
                                <div class="form-row pt-2 py-1">
                                    <label for="email" class="form-label">Masukkan Email:</label>
                                    <input class="form-control" id="email" type="email" placeholder="Email" name="email"  maxlength="40" required autofocus>
                                </div>
                                <div class="form-row py-1">
                                    <label for="city" class="form-label">Asal Kota:</label>
                                    <input class="form-control" id="city" type="text" placeholder="Kota" name="kota" maxlength="40" required>
                                </div>
                                <div class="row mt-2 justify-content-center  ">
                                    <div class="bg-light col ">
                                        <h5 class="text-center">Ganti Password</h5>
                                    </div>
                                </div>
                                <div class="form-row py-1">
                                    <label for="password" class="form-label">Ganti password:</label>
                                    <input class="form-control " type="password" id="email" placeholder="Password" name="password" maxlength="32" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Ubah Password" name="submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </body>
    </main>
    <!-- Footer -->
    <?php include 'include/footer.php'; ?>
</body>

</html>
