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
        $queryCatatan = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM catatan WHERE id_catatan = $id_catatan"));
        if($queryCatatan['id_pengguna'] != $_SESSION['id_pengguna']){
            header('location:index.php');
        }
    }else{
        header('location:index.php');
    }
?>

<!-- QUERY EDIT DATA CATATAN -->
<?php
  if(isset($_POST['submit'])){
    $getJudul = $_POST['judul'];
    $getKonten = $_POST['konten'];
    $queryUpdate = mysqli_query($conn,"UPDATE catatan SET judul = '$getJudul', konten = '$getKonten' WHERE id_catatan = $id_catatan");
    if($queryUpdate){
      echo "
      <script>
        alert('Sukses mengedit catatan!');
        window.location.href='index.php';
      </script>
    ";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('include/head.php') ?>
    <title>Notekita - Tulis Note sepuasmu | Gratis</title>
  </head>
  <body>
    <?php include ('include/nav.php') ?>
      <div class="container">
          <div class="row my-4 justify-content-center align-content-center">
              <div  class="col-sm-9 col-md-7 form-container shadow-big ">
              <form method="POST" action="">
                <div class="form-row my-2">
                    <input class="form-control transparent" name="judul" type="text" placeholder="Judul" id="judul"  value="<?php echo $queryCatatan['judul'] ?>" required>
                </div>
                <div class="form-row my-1">
                  <textarea class="form-control transparent" name="konten" id="subjudul" rows="7" placeholder="Isi" required><?php echo $queryCatatan['konten'] ?></textarea>
                </div>
                <div class="row mt-2 justify-content-end">
                    <div class="col-2">
                      <a href="index.php">
                          <button type="button" class="btn btn-outline-danger my-2 font-weight-bold" title="Batal">Batal</button>
                      </a>
                    </div>
                    <div class="col-4">   
                      <input type="submit" class="btn btn-dark bg-gradient my-2 font-weight-bold" title="Save Note" value="Save" name='submit'>
                    </div>
                </div>
              </form>
            </div>
      </div>
    <?php include ('include/footer.php') ?>
  </body>
  <script>
    var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);
                
    function autosize(){
      var el = this;
      setTimeout(function(){
        el.style.cssText = 'height:auto; padding:0';
        // for box-sizing other than "content-box" use:
        // el.style.cssText = '-moz-box-sizing:content-box';
        el.style.cssText = 'height:' + el.scrollHeight + 'px';
      },0);
    }
    
  </script>
</html>