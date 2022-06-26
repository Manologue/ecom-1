<?php require_once('../../../config.php') ?>
<?php
if ($_SESSION['user_id'] != $_GET['id']) {
  redirect('admin_index.php');
}

$query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
confirm($query);

if ($query) {
  while ($row = fetch_array($query)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    // $user_password = $row['user_password'];
    $user_tel = $row['user_tel'];
    $user_photo = $row['user_photo'];
    $user_photo = display_image($user_photo);
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
        <a class="active" href="#">Edit User</a>
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
      <h3>Edit User</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <form class="form" action="edit" enctype="multipart/form-data">
      <div class=" form-details">
        <div class="form-input">
          <label for="">User name</label>
          <input type="text" name="user_name" value=<?php echo $user_name ?> />
        </div>
        <div class="form-input">
          <label for="">User Email</label>
          <input type="email" name="user_email" value=<?php echo $user_email ?> />
        </div>
        <div class="form-input">
          <label for="">User Tel</label>
          <input type="text" name="user_tel" value=<?php echo $user_tel ?> />
        </div>
        <div class="form-input">
          <label for="">Delete Profile Picture</label>
          <select name="delete_photo" id="">
            <option value="">no</option>
            <option value="yes">yes</option>
          </select>
        </div>
        <div class="form-input">
          <input type="submit" name="publish" value="Update" />
        </div>
        <div class="form-input btn-div">
          <!-- <label for="">User password</label>
          <input type="password" placeholder="password" /> -->
          <a href="admin.php?password_users&id=<?php echo $user_id ?>">click here if you want to change your password</a>
        </div>
      </div>
      <!-- img upload -->
      <div class="img-container">
        <div class="wrapper">
          <div class="image">
            <img class="img-upload" src="../../resources/<?php echo $user_photo ?>" alt="" />
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