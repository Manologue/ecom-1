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
        <a class="active" href="#">Message</a>
      </li>
    </ul>
  </div>
</div>

<div class="table-data">
  <div class="order">
    <!-- alert -->
    <div class="alert-div"></div>
    <div class="head">
      <h3>Messages</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table class="message-table" tab="messages">
      <thead>
        <tr>
          <!-- <th>Id</th> -->
          <th>Date</th>
          <th>Tel</th>
          <th>Email</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php admin_messages() ?>
      </tbody>
    </table>
  </div>
  <div class="empty-container">
    <p>empty table</p>
  </div>
</div>