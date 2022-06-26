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

<div class="single-message">
 <?php
 single_message($_GET['id']);
 ?>
</div>