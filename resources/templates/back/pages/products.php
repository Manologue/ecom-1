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
        <a class="active" href="#">Products</a>
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

<div class="table-data">
  <div class="order">
    <!-- alert -->
    <div class="alert-div"></div>
    <div class="head">
      <h3>Products</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table tab="products">
      <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Category</th>
          <th>featured</th>
          <th>status</th>
          <th>Quantity</th>
          <th>availability</th>
          <th>Price</th>
          <th>date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        products_admin()
        ?>
      </tbody>
    </table>
  </div>
  <div class="empty-container">
    <p>empty table</p>
  </div>
</div>