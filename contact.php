<?php
  session_start();
  include ('include/connect.php');
  $verification = '';
?>

<?php
  if(isset($_SESSION['id_pengguna'])){
    if($_SESSION['level'] == 'admin'){
      header('location:admin-contact.php');
    }
  }
?>

<?php
  if(isset($_POST['submit'])){
    $getNama = $_POST['nama'];
    $getEmail = $_POST['email'];
    $getSubject = $_POST['subjek'];
    $getPesan = $_POST['pesan'];

    if (!filter_var($getEmail, FILTER_VALIDATE_EMAIL)) {
      $verification = "Format email tidak valid!";
    }else{
      $queryPesan = mysqli_query($conn,"INSERT INTO kontak (nama,email,subjek,pesan) VALUES ('$getNama','$getEmail','$getSubject','$getPesan')");
      if($queryPesan){
        echo "
          <script>
            alert('Pesan Anda telah terkirim!');
          </script>
        ";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('include/head.php') ?>
	<title>Notekita - Contact Us</title>
<style>
  .form-container {
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
  <section class="Form my-5 mx-5">
    <div class="container">
      <div class="form-container row g-0">
        <div class="d-flex col-md-5">
          <img class="align-items-center img-fluid p-2" style="background-color: rgba(1, 150, 150, .7)    ;"
            src="pictures/undraw_personal_email_t7nw.svg" alt="contact-us">
        </div>
        <div class="col-md-7 px-5 ">
          <h1 class="text-center font-weight-bold pt-3">Contact Us</h1>

          <form method="POST" action="" class="row pt-3 g-3">
            <div class="col-md-6">
              <label for="inputAddress" class="form-label">Name</label>
              <input type="text" class="form-control" id="inputName" placeholder="Enter Name" name="nama" maxlength='40'
                required>
            </div>
            <div class="col-md-7">
              <label for="Email" class="form-label">Email</label>
              <input type="text" class="form-control" id="Email" name="email" placeholder="example@address"
                maxlength='40' required>
            </div>
            <div class="col-md-7">
              <label for="Subject" class="form-label" maxlength="20">Subject</label>
              <input type="text" class="form-control" id="Subject" name="subjek" placeholder="Enter Subject"
                maxlength='40' required>
            </div>
            <div class="col-md-7">
              <label for="Message" class="form-label">Your Message</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter your Message" maxlength="400" name="pesan"></textarea>
            </div>


            <div class="col-12">

              <div class="form-row py-1">
                <div class="col-md-12">
                  <p style="color: red;"><?php echo $verification; ?></p>
                </div>
                <div class="col-md-12">
                  <input type="submit" class="btn btn-dark my-3 font-weight-bold" name="submit" value="Submit">
                </div>
              </div>

            </div>
        </div>
      </div>
  </section>
  <?php include ('include/footer.php') ?>
</body>

</html>