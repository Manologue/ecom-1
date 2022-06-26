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
        <a class="active" href="#">Category</a>
      </li>
    </ul>
  </div>
</div>

<div class="table-data">
  <div class="order">
    <!-- alert -->
    <div class="alert-div"></div>
    <div class="head">
      <h3>Category</h3>
      <form class="form" action="add" enctype="multipart/form-data">
        <div class="caterory">
          <input type="text" name="cat_title" />
          <input type="submit" name="publish" value="add category" />
        </div>
      </form>
    </div>
    <table tab="categories">
      <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
        </tr>
      </thead>
      <tbody>
        <?php admin_categories() ?>
      </tbody>
    </table>
  </div>
</div>