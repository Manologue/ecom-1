<?php require_once('../../../config.php'); ?>



<div class="head-title">
 <div class="left">
  <h1>Dashboard</h1>
  <ul class="breadcrumb">
   <li>
    <a href="#">Dashboard</a>
   </li>
   <li><i class="bx bx-chevron-right"></i></li>
   <li>
    <a class="active" href="#">Collections</a>
   </li>
  </ul>
 </div>
 <div class="btn-div">
  <a href="admin.php?add_collections" class="btn-download">
   <i class="bx bx-plus"></i>
   <span class="text">Add collection</span>
  </a>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Collections</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <table tab="collections">
   <thead>
    <tr>
     <th>Category</th>
     <th class="slider-img-title">Image</th>
    </tr>
   </thead>
   <tbody>
    <?php
    collection_admin()
    ?>
   </tbody>
  </table>
 </div>
 <div class="empty-container">
  <p>empty table</p>
 </div>
</div>