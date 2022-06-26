<?php require_once('../../../config.php') ?>
<?php
if (isset($_GET['id'])) {
 get_out_page("collections", $_GET['id']);


 $edit_id = $_GET['id'];
 $query = query("SELECT * FROM collections WHERE id = $edit_id");
 confirm($query);

 while ($row = fetch_array($query)) {
  $cat_id = $row['cat_id'];
  $image = $row['image'];
  $image = display_image($image);
 }
}


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
    <a class="active" href="#">Edit Collection</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?collections" class="btn-download">
   <span class="text">See Collections</span>
  </a>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Edit collection</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <form class="form" action="edit" enctype="multipart/form-data">
   <div class="form-details">
    <div class="form-input">
     <label for="">Product category</label>
     <select name="product_category_id" id="">
      <option value="<?php echo $cat_id ?>"><?php echo show_product_category_title($cat_id) ?></option>
      <?php
      $query = query("SELECT * FROM categories WHERE id NOT IN($cat_id)");
      confirm($query);
      while ($row = fetch_array($query)) {
       $category_id = $row['id'];
       $cat_title = $row['cat_title'];
       echo "<option value='$category_id'>$cat_title</option>";
      }
      ?>
      <option value="">no category</option>
     </select>
    </div>
    <div class="form-input">
     <input type="submit" name="publish" value="Publish" />
    </div>
   </div>
   <!-- img upload -->
   <div class="img-container">
    <div class="wrapper">
     <div class="image">
      <img class="img-upload" src="../../resources/<?php echo $image ?>" alt="" />
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
  </form>
 </div>
</div>