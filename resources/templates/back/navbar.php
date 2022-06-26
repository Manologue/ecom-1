<!-- NAVBAR -->

<nav>
 <i class="bx bx-menu"></i>
 <a href="#" class="nav-link">Categories</a>
 <form action="#">
  <div class="form-input">
   <input type="search" placeholder="Search..." />
   <button type="submit" class="search-btn">
    <i class="bx bx-search"></i>
   </button>
  </div>
 </form>
 <input type="checkbox" id="switch-mode" hidden />
 <label for="switch-mode" class="switch-mode"></label>
 <a href="admin.php?messages" class="notification">
  <i class='bx bxs-message-dots'></i>
  <?php
  // count messages with status non lu
  $query = query("SELECT * FROM messages WHERE status = 'non lu'");
  confirm($query);
  $count = mysqli_num_rows($query);

  if ($count > 0) {
   echo "<span class='num count-mssg'>$count</span>";
  }





  ?>

 </a>
 <!-- <a href="#" class="notification">
  <i class="bx bxs-bell"></i>
  <span class="num">8</span>
 </a> -->
 <a href="admin.php" class="profile">
  <?php
  $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_SESSION['user_id']) . " ");
  confirm($query);
  while ($row = fetch_array($query)) {
   $photo = $row['user_photo'];
   if (empty($photo)) {
    $photo = 'empty-profile.png';
   }
   echo  "<img class='user-photo' src='../../resources/uploads/$photo' />";
  }
  ?>

 </a>
</nav>
<!-- NAVBAR -->