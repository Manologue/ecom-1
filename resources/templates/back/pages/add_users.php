<?php require_once('../../../config.php') ?>
<?php
// if you are not super admin you can not access this page
if ($_SESSION['role'] != 'super admin') {
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
    <a class="active" href="#">Add User</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?users" class="btn-download">
   <span class="text">See Users</span>
  </a>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Add User</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <form class="form" action="add" enctype="multipart/form-data">
   <div class="form-details">
    <div class="form-input">
     <label for="">User name</label>
     <input type="text" name="user_name" placeholder="user name" required />
    </div>
    <div class="form-input">
     <label for="">User Email</label>
     <input type="email" name="user_email" placeholder="user email" required />
    </div>
    <div class="form-input">
     <label for="">User Tel</label>
     <input type="text" name="user_tel" placeholder="user tel" />
    </div>
    <div class="form-input">
     <label for="">User Role</label>
     <select name="user_role" id="user role" required>
      <option value="admin">admin</option>
     </select>
    </div>
    <div class="form-input">
     <label for="">User Password</label>
     <input type="password" name="user_password" placeholder="user password" required />
    </div>
    <div class="form-input">
     <input type="submit" name="publish" value="Publish" />
    </div>
   </div>
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
  </form>
 </div>
</div>