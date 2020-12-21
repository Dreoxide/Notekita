<?php
  session_start();
  include ('include/connect.php');
?>

<?php 
  if(!isset($_SESSION['id_pengguna'])){
    header('location:login.php');
  }else{
    if($_SESSION['level'] == 'admin'){
      header('location:admin-contact.php');
    }
  }
?>

<?php
  if(isset($_GET['submit'])){
      $id_pengguna = $_SESSION['id_pengguna'];
      $getSearch = $_GET["search-note"];
      $queryCari = mysqli_query($conn,"SELECT * FROM catatan WHERE id_pengguna = $id_pengguna AND judul LIKE '%$getSearch%' ");
      if(!$queryCari){
          echo "Error";
      }
  }else{
      header('location:index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include ('include/head.php'); ?>
  <title>Notekita - Tulis Note Sepuasmu | Gratis</title>
  <link rel="stylesheet" href="assets/css/all.css" type="text/css">
  <style>
    .catatan-kosong{
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px 15px;
      background-color: white;
      border-radius: 10px;
      font-size: 32px;
      margin: 25px;
    }
  </style>
</head>
<body>
    <?php
      include ('include/nav.php');
    ?>
    <main>
    <div class="container">
        <!-- Note Note -->
        <h1 style="margin: 15px 0; text-align: center;">Cari: <?php echo $getSearch ?></h3>
        <?php if(mysqli_num_rows($queryCari) < 1): ?>
            <h3 style="margin: 15px 0; text-align: center;">Tidak ada catatan yang ditemukan.</h3>
        <?php else: ?>
          <?php while($result = mysqli_fetch_array($queryCari)): ?>
            <div class="row mt-4 mb-2 justify-content-center"> 
              <div  class="col-sm-9 col-md-7 form-container shadow-inset p-2 position-relative">
                <div><button type="button" class="btn-close position-absolute top-0 right-0" title="Delete" aria-label="Delete" onclick=delconfirm(<?php echo $result['id_catatan'] ?>)></button></div>
                <div class="row">
                  <div id='judulNote' class="col" >
                    <h5 class="text-center mb-0 font-weight-bold"><?php echo $result['judul'] ?></h5>
                    <hr class="m-2">
                  </div>
                </div>
                <div class="row">
                  <div id='isiNote' class="col-12 ">
                    <p class="px-2 my-2"><?php echo nl2br($result['konten']) ?></p> 
                  </div>
                </div> <hr class="m-2">
                
                <div class="row transparent text-muted align-items-center justify-content-end">
                  <div class="col-auto">
                    <p style="font-size: small;margin-bottom: 0;">
                      Terakhir diubah : <label id="tanggal"><?php echo $result['tanggal'] ?></label>
                    </p>
                  </div>
                  <div class="col-2">
                    <a href="edit-note.php?id_catatan=<?php echo $result['id_catatan'] ?>">
                      <button class="btn btn-primary font-weight-bold py-1" title="Edit Note">Edit</button>
                    </a>
                  </div>              
                </div>
              </div>
            </div>
          </div>
          <?php endwhile ?>
        <?php endif ?>
    </div>
    </main>  
    <?php
      include ('include/footer.php');
    ?>
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

      function delconfirm(id_catatan){
          if(confirm("Apakah Anda yakin ingin menghapus catatan tersebut?")){
              window.location.href='delete-note.php?id_catatan=' + id_catatan + '';
          }
      }
    </script>
</body>  
</html>

