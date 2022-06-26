<?php require_once('../../../config.php') ?>
<?php
if ($_SESSION['user_id'] != $_GET['id']) {
 redirect('admin_index.php');
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
    <a class="active" href="#">Change Password</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?edit_users&id=<?php echo $_GET['id']; ?>" class="btn-download">
   <span class="text">Edit Profile</span>
  </a>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Edit User</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <form class="form" action="edit_password" enctype="multipart/form-data">
   <div class=" form-details">
    <div class="form-input">
     <label for="">Present Password</label>
     <input type="password" name="old_password" />
    </div>
    <div class="form-input">
     <label for="">New Password</label>
     <input type="password" name="user_password" />
    </div>
    <div class="form-input">
     <input type="submit" name="publish" value="Update" />
    </div>
   </div>
  </form>
 </div>
</div>