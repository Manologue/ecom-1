<?php require_once('../../../config.php') ?>
<?php
if (isset($_GET['id'])) {
 get_out_page("categories", $_GET['id']);



 $query = query("SELECT * FROM categories WHERE id = " . escape_string($_GET['id']) . " ");

 while ($row = fetch_array($query)) {

  $cat_title = $row['cat_title'];
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
    <a class="active" href="#">Category</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?categories" class="btn-download">
   <span class="text">See Categories</span>
  </a>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Category</h3>
   <form class="form" action="edit" enctype="multipart/form-data">
    <div class="caterory">
     <input type="text" name="cat_title" value="<?php echo  $cat_title; ?>" required />
     <input type="submit" name="publish" value="update category" />
    </div>
   </form>
  </div>
 </div>
</div>