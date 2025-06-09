<?php
include('conn.php');

$sql = "SELECT * FROM files ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$file = mysqli_fetch_assoc($result);

?>
<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>

<style>
    
    .btn {
    color: var(--white);
    font-family: var(--ff-oswald);
    font-size: var(--fs-6);
    font-weight: var(--fw-500);
    letter-spacing: 1px;
    text-transform: uppercase;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    background-color: red;
    padding: 13px 34px;
    clip-path: var(--polygon-1);
    transition: var(--transition-1);
}
</style>


<div class="row">
  <div class="col-lg-12">
    <?= $this->include('Layout/msgStatus') ?>
  </div>
<?php if (session()->getFlashdata('msgSuccess')) : ?>
    <script>
        Swal.fire('Success', '<?= session()->getFlashdata('msgSuccess') ?>', 'success');
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire('Success', '<?= session()->getFlashdata('success') ?>', 'success');
    </script>
<?php endif; ?>

<!-- Add similar code for other flash messages -->

  <div class="col-lg-6">
      
    <div class="card mb-3">
     
     <div class="section-wrapper">

            <div class="about-content">

              <p class="about-subtitle">Update</p>

              <h2 class="about-title">Online  <strong>MOD</strong> </h2>

               <div class="card-body">
       <?php if(isset($file['name'])): ?>
                    <label for="file">Moded Lib Name: <font size="2" color ="#a39c9b"><?= $file['name'] ?></font></label> 
                  <hr class="double-line">

                <?php endif; ?>
                
                <?php if(isset($file['size'])): ?>
                    <label for="size">Total Size : <font size="2" color ="#a39c9b"><?= $file['size'] ?></font></label>
                     <hr class="double-line">

                <?php endif; ?>
               
          <?php if(isset($file['extension'])): ?>
                    <label for="time">Support Type : <font size="2" color ="#a39c9b"><?= $file['extension'] ?></font></label>
                      <hr class="double-line">

                <?php endif; ?>
              <?php if(isset($file['version'])): ?>
                    <label for="time">Game Version : <font size="2" color ="#a39c9b"><?= $file['version'] ?></font></label>
                      <hr class="double-line">

                <?php endif; ?>
         
                <?php if(isset($file['uploadtime'])): ?>
                    <label for="time">Last Modified : <font size="2" color ="#a39c9b"><?= $file['uploadtime'] ?></font></label>
                      <hr class="double-line">

                <?php endif; ?>
      </div>

             
            </div>

          </div>
        </section>
        </div>
    </div>
    
    
    
      <div class="col-lg-6">
    <div class="card mb-3">
     
     <div class="section-wrapper">

            <div class="about-content">

              <p class="about-subtitle">Update</p>

              <h2 class="about-title">Your  <strong>ModName</strong> </h2>

               <div class="card-body">
        <form action="<?= base_url('upload') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <label class="custom-file-label" for="file">Online MOD Lib</label>
        <div class="custom-file mb-3">
                  <input type="file" name="file" accept=".so" id="file" name="file" required  class="form-control" >



          
        </div>
        
         <div class="form-group">
      <label for="version">MOD Version:</label>
      <input type="text" name="version" id="version" class="form-control">
    </div><br>
        <button type="submit" class="btn btn-dark">Send New Update</button>
      </form>
      </div>
              
            </div>

          </div>
        </section>
        </div>
    </div>







   
    
 

<script>
$('form').submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();

    xhr.upload.addEventListener('progress', function(event) {
        if (event.lengthComputable) {
            var percentComplete = event.loaded / event.total * 100;
            $('.progress-bar').css('width', percentComplete + '%');
        }
    });

    xhr.open('GET', '/update');
    xhr.send(formData);
});



</script<

 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
<script>
$(function(){
    <?php if(session()->has("success")) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Great! Your lib has been uploaded',
            text: '<?= session("success") ?>'
        })
    <?php } ?>
});
</script>

<script>
$(function(){
    <?php if(session()->has("msg")) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Great! Notification Successfully sent to the users',
            text: '<?= session("msg") ?>'
        })
    <?php } ?>
});
</script>
<script>
$(function(){
    <?php if(session()->has("info")) { ?>
        Swal.fire({
            icon: 'info',
            title: 'Done! Key Time Has been Changed',
            text: '<?= session("info") ?>'
        })
    <?php } ?>
});
</script>


<?= $this->endSection() ?>