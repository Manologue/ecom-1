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
        <a class="active" href="#">Add product</a>
      </li>
    </ul>
  </div>
  <div class="btn-div">
    <a href="admin.php?products" class="btn-download">
      <span class="text">See Products</span>
    </a>
  </div>
</div>

<div class="table-data">
  <div class="order">
    <!-- alert -->
    <div class="alert-div"></div>
    <div class="head">
      <h3>Add product</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <form class="form" action="add" enctype="multipart/form-data">
      <div class="form-details">
        <div class="form-input">
          <label for="">Product name</label>
          <input type="text" name="product_title" placeholder="Product name" required />
        </div>
        <div class="form-input">
          <label for="">Product price</label>
          <input type="number" name="product_price" placeholder="Product price" required />
        </div>
        <div class="form-input">
          <label for="">Product description</label>
          <textarea name="product_desc" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-input">
          <label for="">Product short description</label>
          <textarea name="product_short_desc" id="" cols="20" rows="5"></textarea>
        </div>
        <div class="form-input">
          <label for="">Product category</label>
          <select name="product_category_id" id="">
            <?php
            $query = query("SELECT * FROM categories");
            confirm($query);
            while ($row = fetch_array($query)) {
              $id = $row['id'];
              $cat_title = $row['cat_title'];
              echo "<option value='$id'>$cat_title</option>";
            }
            $count_rows = mysqli_num_rows($query);
            if ($count_rows == 0) {
              echo "<option value=''>no category</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-input">
          <label for="">Product Featured</label>
          <select name="product_featured" id="">
            <option value="">Select featured product</option>
            <option value="yes">yes</option>
            <option value="">no</option>
          </select>
        </div>
        <div class="form-input">
          <label for="">Product quantity</label>
          <input type="number" value="1" min="0" name="product_quantity" placeholder="Product quantity" />
        </div>
        <!-- <div class="form-input">
          <label for="">Product size</label>
          <input type="text" placeholder="Product size" />
        </div> -->
        <div class="form-input">
          <label for="">Product Status</label>
          <select name="product_status" id="">
            <option value="">Select status</option>
            <option value="new">new</option>
            <option value="promo">promo</option>
            <option value="best">best</option>
          </select>
        </div>
        <div class="form-input">
          <input type="submit" name="publish" value="Publish" />
        </div>
      </div>
      <!-- img upload -->
      <div class="img-container">
        <div class="wrapper">
          <div class="image">
            <img class="img-upload" src="" alt="" />
          </div>
          <div class="content-img">
            <div class="icon">
              <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div class="text">No file chosen, yet!</div>
          </div>
          <div id="cancel-btn">
            <i class="fas fa-times"></i>
          </div>
          <div class="file-name">File name here</div>
        </div>
        <button type="button" id="custom-btn">Choose a file</button>
        <input id="default-btn" name="file" type="file" hidden />
        <!-- end of img upload -->
      </div>
    </form>
  </div>
</div>