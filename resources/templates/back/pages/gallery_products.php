<?php require_once('../../../config.php') ?>
<?php
get_out_page("products", $_GET['id']);
?>
<div class="head-title">
 <div class="left">
  <h1>Dashboard</h1>
  <ul class="breadcrumb">
   <li>
    <a href="#">Dashboard</a>
   </li>
   <li><i class="bx bx-chevron-right"></i></li>
   <li>
    <a class="active" href="#">Single Product Gallery</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?products" class="btn-download">
   <span class="text">See Products</span>
  </a>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Gallery</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <form class="form gallery-form" action="add_gallery" enctype="multipart/form-data">
   <!-- img upload -->
   <div class="img-container">
    <div class="wrapper">
     <div class="image">
      <img class="img-upload" src="" alt="" />
     </div>
     <div class="content-img">
      <div class="icon">
       <i class="fas fa-cloud-upload-alt"></i>
      </div>
      <div class="text">No file chosen, yet!</div>
     </div>
     <div id="cancel-btn">
      <i class="fas fa-times"></i>
     </div>
     <div class="file-name">File name here</div>
    </div>
    <button type="button" id="custom-btn">Choose a file</button>
    <input id="default-btn" name="file" type="file" hidden />
    <!-- end of img upload -->
   </div>
   <div class="form-input">
    <input type="submit" name="publish" value="add picture" />
   </div>
  </form>
 </div>
</div>

<section class="gallery-container">

 <div class="image-gallery">
  <header>Single Product Gallery</header>
  <div class="image-container">
   <?php
   product_gallery_admin($_GET['id'])
   ?>

  </div>
 </div>

</section>