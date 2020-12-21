<?php
  session_start();
?>

<?php
  if(isset($_SESSION['id_pengguna'])){
    if($_SESSION['level'] == 'admin'){
      header('location:admin-contact.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include ('include/head.php') ?>
	<title>Notekita - About Us</title>
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
  <?php include ('include/nav.php') ?>
  <section class="About my-5 mx-5">
    <div class="container justify-content-center">

      <div class="container row g-0 bg-light">
        <div class="d-flex col-md-5">
          <img class="align-items-center img-fluid p-2" style="background-color: rgba(1, 150, 150, .7) ;"
            src="pictures/undraw_software_engineer_lvl5.svg" alt="Gambar About" style="width: 100%;">
        </div>
        <div class="col-md-7 px-5 ">
          <h1 class="text-center font-weight-bold pt-4">About</h1>
          <p class="text-center font-weight-bold pt-2">Notekita adalah aplikasi penyedia catatan gratis yang berguna
            untuk
            menyimpan catatan-catatan yang mana
            nanti bisa menjadi bahan bantu pengingat. Notekita ini dirancang sedemikian rupa sehingga bisa nyaman
            digunakan oleh berbagai kalangan. Apabila ada kritik saran mengenai Notekita, bisa hubungi kami lewat
            dibawah ini</p>
          <div class="col text-center pt-3">
            <a class="btn btn-primary btn-med" href="contact.php" role="button">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include ('include/footer.php') ?>
</body>

</html>