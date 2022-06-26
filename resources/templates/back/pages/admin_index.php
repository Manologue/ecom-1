<?php require_once('../../../config.php') ?>

<div class="head-title">
 <div class="left">
  <h1>Dashboard</h1>
  <ul class="breadcrumb">
   <li>
    <a href="#">Dashboard</a>
   </li>
   <li><i class="bx bx-chevron-right"></i></li>
   <li>
    <a class="active" href="#">Home</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?add_products" class="btn-download">
   <i class="bx bx-plus"></i>
   <span class="text">Add Products</span>
  </a>
 </div>
</div>

<ul class="box-info">
 <li>
  <i class="bx bxs-calendar-check"></i>
  <span class="text">
   <h3>1020</h3>
   <p>New Order</p>
  </span>
 </li>
 <li>
  <i class="bx bxs-group"></i>
  <span class="text">
   <h3>2834</h3>
   <p>Visitors</p>
  </span>
 </li>
 <li>
  <i class="bx bxs-dollar-circle"></i>
  <span class="text">
   <h3>$2543</h3>
   <p>Total Sales</p>
  </span>
 </li>
</ul>

<div class="table-data">
 <div class="order">
  <div class="head">
   <h3>Recent Orders</h3>
   <div class="btn-div">
    <a href="admin.php?orders" class="users-link">see all</a>
   </div>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <table tab="orders">
   <thead>
    <tr>
     <th>Id</th>
     <th>Total Amounty</th>
     <th>Status</th>
     <th>Date</th>
     <th>Report</th>
    </tr>
   </thead>
   <tbody>
    <?php
    recent_orders_admin();

    ?>
   </tbody>
  </table>
 </div>
 <div class="empty-container">
  <p>empty table</p>
 </div>
</div>