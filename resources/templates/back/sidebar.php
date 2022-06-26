<!-- SIDEBAR -->
<section id="sidebar">
 <a href="admin.php" class="brand">
  <i class="bx bxs-smile"></i>
  <span class="text user-name">
   <?php
   $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_SESSION['user_id']) . " ");
   confirm($query);
   while ($row = fetch_array($query)) {
    echo $row['user_name'];
   }
   ?>
  </span>
 </a>
 <ul class="side-menu top">
  <li>
   <a class="active-link" href="admin.php">
    <i class="bx bxs-dashboard"></i>
    <span class="text">Dashboard</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?products">
    <i class="bx bxs-shopping-bag-alt"></i>
    <span class="text">Products</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?orders">
    <i class="bx bxs-receipt"></i>
    <span class="text">Orders</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?categories">
    <i class="bx bxs-category"></i>
    <span class="text">Categories</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?users">
    <i class="bx bxs-user"></i>
    <span class="text">Users</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?sliders">
    <i class='bx bxs-slideshow'></i>
    <span class="text">Sliders</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?collections">
    <i class='bx bxs-collection'></i>
    <span class="text">Collections</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?analytics">
    <i class="bx bxs-doughnut-chart"></i>
    <span class="text">Analytics</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?messages">
    <i class="bx bxs-message-dots"></i>
    <span class="text">Message</span>
   </a>
  </li>
  <li>
   <a class="active-link" href="admin.php?add_products">
    <i class="bx bx-plus"></i>
    <span class="text">Add Product</span>
   </a>
  </li>
 </ul>
 <ul class="side-menu">

  <li>
   <a href="./logout.php" class="logout">
    <i class="bx bxs-log-out-circle"></i>
    <span class="text">Logout</span>
   </a>
  </li>
 </ul>
</section>
<!-- SIDEBAR -->