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
    <a class="active" href="#">Report(s)</a>
   </li>
  </ul>
 </div>
</div>

<div class="table-data">
 <div class="order">
  <!-- alert -->
  <div class="alert-div"></div>
  <div class="head">
   <h3>Reports</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <table tab="reports">
   <thead>
    <tr>
     <th>Report Id</th>
     <th>Product Id</th>
     <th>Product Title</th>
     <th>Product Price</th>
     <th class="report-quantity">Product Quantity</th>
    </tr>
   </thead>
   <tbody>
    <?php reports_admin($_GET['id']); ?>
   </tbody>
  </table>
 </div>
 <div class="empty-container">
  <p>empty table</p>
 </div>
</div>





<div class="table-data">
 <div class="order">
  <div class="head">
   <h3>Info Customer</h3>
   <i class="bx bx-search"></i>
   <i class="bx bx-filter"></i>
  </div>
  <table>
   <thead>
    <tr>
     <th>Customer Name</th>
     <th>Customer Tel</th>
     <th>Customer Email</th>
     <th>Customer Town</th>
     <th>Customer Quarter</th>
    </tr>
   </thead>
   <tbody>
    <?php order_customer_info($_GET['id']); ?>
   </tbody>
  </table>
 </div>
</div>