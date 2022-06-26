<?php require_once('../../../config.php') ?>
<?php
if (isset($_GET['id'])) {
  get_out_page("products", $_GET['id']);


  $edit_id = $_GET['id'];
  $query = query("SELECT * FROM products WHERE id = $edit_id");
  confirm($query);

  while ($row = fetch_array($query)) {
    $product_title = $row['product_title'];
    $product_price = $row['product_price'];
    $product_desc = $row['product_desc'];
    $product_short_desc = $row['product_short_desc'];
    $product_category_id = $row['product_category_id'];
    $product_featured = $row['product_featured'];
    $product_quantity = $row['product_quantity'];
    $product_image = $row['product_image'];
    $product_image = display_image($product_image);
    $product_status = $row['product_status'];
  }
}


?>


<div class="head-title">
  <div class="left">
    <h1>Dashboard</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Dashboard</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Edit product</a>
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
      <h3>Edit product</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <form class="form" action="edit" enctype="multipart/form-data">

      <div class="form-details">
        <div class="form-input">
          <label for="">Product name</label>
          <input type="text" name="product_title" placeholder="Product name" value=<?php echo $product_title; ?> />
        </div>
        <div class="form-input">
          <label for="">Product price</label>
          <input type="text" name="product_price" placeholder="Product price" value=<?php echo $product_price; ?> />
        </div>
        <div class="form-input">
          <label for="">Product description</label>
          <textarea name="product_desc" id="" cols="30" rows="10"><?php echo $product_desc; ?></textarea>
        </div>
        <div class="form-input">
          <label for="">Product short description</label>
          <textarea name="product_short_desc" id="" cols="20" rows="5"><?php echo $product_short_desc; ?></textarea>
        </div>
        <div class="form-input">
          <label for="">Product category</label>
          <select name="product_category_id" id="">
            <option value="<?php echo $product_category_id ?>"><?php echo show_product_category_title($product_category_id) ?></option>
            <?php
            $query = query("SELECT * FROM categories WHERE id NOT IN($product_category_id)");
            confirm($query);
            while ($row = fetch_array($query)) {
              $cat_id = $row['id'];
              $cat_title = $row['cat_title'];
              echo "<option value='$cat_id'>$cat_title</option>";
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
            <option value=<?php echo $product_featured; ?>><?php echo $product_featured; ?></option>

            <?php
            if ($product_featured == 'yes') {
              echo '<option value="no">no</option>';
            } else {
              echo '<option value="yes">yes</option>';
            }

            ?>
          </select>
        </div>
        <div class="form-input">
          <label for="">Product quantity</label>
          <input type="number" value="<?php echo $product_quantity ?>" min="0" name="product_quantity" placeholder="Product quantity" />
        </div>
        <!-- <div class="form-input">
          <label for="">Product size</label>
          <input type="text" placeholder="Product size" />
        </div> -->
        <div class="form-input">
          <label for="">Product Status</label>
          <select name="product_status" id="">
            <option value="<?php echo $product_status; ?>"><?php echo $product_status; ?></option>
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
            <img class="img-upload" src="../../resources/<?php echo $product_image ?>" alt="" />
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