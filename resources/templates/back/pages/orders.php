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
        <a class="active" href="#">Orders</a>
      </li>
    </ul>
  </div>
</div>

<div class="table-data">
  <div class="order">
    <!-- alert -->
    <div class="alert-div"></div>
    <div class="head">
      <h3>Orders</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table tab="orders">
      <thead>
        <tr>
          <th>Id</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Date</th>
          <th>Report</th>
        </tr>
      </thead>
      <tbody>

        <?php orders_admin(); ?>

      </tbody>
    </table>
  </div>
  <div class="empty-container">
    <p>empty table</p>
  </div>
</div>