<?php
    session_start();
    include ('include/connect.php');
?>

<?php
    if(!isset($_SESSION['id_pengguna'])){
        header('location:index.php');
    }else{
        $id_pengguna = $_SESSION['id_pengguna'];
    }
?>

<?php
    $queryAkun = mysqli_query($conn,"SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna");
    $result = mysqli_fetch_array($queryAkun);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('include/head.php'); ?>
	<title>Notekita - Account</title>
<style>
    section #row {
        box-shadow: 12px 12px 24px rgb(128, 128, 128);
    }
</style>
</head>
<body>
    <?php include ('include/nav.php'); ?>
        <section class="Form my-5 mx-5">
            <div class="container">
                <div class="row g-0 justify-content-center">
                    <div id="row" class="col-6 text-center form-container p-2">
                        <div class="row">
                            <h4 class="text-center font-weight-bold py-3">Profile</h4>
                            <p>Nama: <?php echo $result['nama'] ?></p>
                            <p>Email: <?php echo $result['email'] ?></p>
                            <p>Alamat: <?php echo nl2br($result['alamat']) ?></p>
                            <p>Kota: <?php echo $result['kota'] ?></p>
                        </div>
                        <div class="row d-flex justify-content-evenly">
                            <div class="col-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editprofil">Edit Profil</button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#ubahpassword">Ubah Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="editprofil" data-backdrop="static" tabindex="-1" aria-labelledby="editprofil" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editprofil">Edit Profil</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form method="POST" action="edit-account.php">
                            <div class="form-row py-1">
                                <!-- Isi Placeholdernya dengan Email user bisa ga -->
                                <label for="email" class="form-label">Email:</label>
                                <input class="form-control" id="email" type="text" name="email" value="<?php echo $result['email'] ?>" readonly>
                            </div>
                            <div class="form-row pt-2 py-1">
                                <label for="Nama" class="form-label">Nama:</label>
                                <input class="form-control" id="Nama" type="text" placeholder="Nama" name="nama" value="<?php echo $result['nama'] ?>" maxlength="40" required autofocus>
                            </div>
                            <div class="form-row py-1">
                                <label for="Alamat" class="form-label">Alamat:</label>
                                <textarea class="form-control" id="Alamat" name="alamat" rows="3" maxlength="150" required><?php echo nl2br($result['alamat']) ?></textarea>
                            </div>
                            <div class="form-row py-1">
                                <label for="Kota" class="form-label">Kota:</label>
                                <input class="form-control " type="text" id="Kota" placeholder="Kota" name="kota" value="<?php echo $result['kota'] ?>" maxlength="40" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="edit_account" value="Edit Akun">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ubahpassword" data-backdrop="static" tabindex="-1" aria-labelledby="ubahpassword" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ubahpassword">Ubah Password</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form method="POST" action="edit-password.php">
                            <div class="form-row py-1">
                                <!-- Isi Placeholdernya dengan Email user bisa ga -->
                                <label for="email" class="form-label">Email:</label>
                                <input class="form-control" id="email" type="text" name="email" value="<?php echo $result['email'] ?>" readonly>
                            </div>
                            <div class="form-row py-1">
                                <label for="password" class="form-label">Password lama:</label>
                                <input class="form-control " type="password" id="email" placeholder="Password" name="password_lama" maxlength="32" required>
                            </div>
                            <div class="form-row mt-4 py-1">
                                <label for="password" class="form-label">Ganti password:</label>
                                <input class="form-control " type="password" id="email" placeholder="Password" name="password_baru" maxlength="32" required>
                            </div>
                            <div class="form-row py-1">
                                <label for="password" class="form-label">Konfirmasi password:</label>
                                <input class="form-control " type="password" id="email" placeholder="Password" name="konfirmasi_password" maxlength="32" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="edit_pass" value="Ubah Password">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php include ('include/footer.php'); ?>
</body>


</html>
