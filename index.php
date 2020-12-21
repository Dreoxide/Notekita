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
  $id_pengguna = $_SESSION['id_pengguna'];
  $queryNote = mysqli_query($conn,"SELECT * FROM catatan WHERE id_pengguna = $id_pengguna ORDER BY id_pengguna, tanggal DESC");
  $cekResult = mysqli_num_rows($queryNote);
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
      <div class="row my-4 justify-content-center">
        <div  class="col-sm-9 col-md-5 form-container shadow-big ">
        <form method="POST" action="insert-note.php">
          <!--popover help-->
          <div class="d-flex justify-content-between">
            <p class="font-weight-bold my-auto">Notekita</p>
            <div class=" help-button" style="text-align: right;">
              <button type="button" class="btn btn-lg btn-default" data-bs-toggle="popover" title="Bantuan"
                data-bs-content="Isi terlebih dahulu judul catatan, kemudian tuliskan apa yang ingin ada catat di bagian isi!"><i
                  class="fas fa-info-circle"></i></button>
            </div>
          </div>
          <div class="form-row my-2">
            <input class="form-control transparent" type="text" placeholder="Judul" name="judul" required>
          </div>
          <div class="form-row my-1">
            <textarea class="form-control transparent" name="konten" id="subjudul" rows="3" placeholder="Isi" required></textarea>
          </div>
          <div class="form-row mt-2">
            <input type="submit" class="btn btn-dark my-2 font-weight-bold" title="Create Note" value="Submit" name="submit">
          </div>
      </form>
        </div>
        <!-- Note Note -->
        <?php if(mysqli_num_rows($queryNote) < 1): ?>
          <h3 style="margin: 15px 0; text-align: center;">Belum ada catatan yang dibuat</h3>
        <?php else: ?>
          <?php while($result = mysqli_fetch_array($queryNote)): ?>
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

