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
        <a class="active" href="#">Users</a>
      </li>
    </ul>
  </div>
  <?php
  if ($_SESSION['role'] == 'super admin') {
    echo '
       <div class="btn-div">
         <a href="admin.php?add_users" class="btn-download">
         <i class="bx bx-plus"></i>
          <span class="text">add User</span>
         </a>
       </div>
       ';
  }
  ?>
</div>

<div class="table-data">
  <div class="order">
    <!-- alert -->
    <div class="alert-div"></div>
    <?php display_alert(); ?>
    <div class="head">
      <h3>Users</h3>
    </div>
    <table tab="users">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Tel</th>
          <th>Role</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody class="users-body">
        <?php
        users_admin();
        ?>
      </tbody>
    </table>
  </div>
</div>