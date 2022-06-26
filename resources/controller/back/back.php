<?php

/*********************************************** products ***************************************/
function products_admin() {

  $query = query("SELECT * FROM products ORDER BY id DESC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $product_title = $row['product_title'];
    $product_category_id = $row['product_category_id'];
    $product_price = $row['product_price'];
    $product_featured = $row['product_featured'];
    $product_quantity = $row['product_quantity'];
    $product_image = $row['product_image'];
    $product_status = $row['product_status'];
    $date_insertion = $row['date_insertion'];
    // $product_status = $row['product_status'];

    $cat_title = show_product_category_title($product_category_id);

    // img 
    $product_image = display_image($product_image);

    $color_quantity = "";
    $rupture = "";

    // product quantity setup
    if ($product_quantity <= 0) {
      $color_quantity = "danger";

      $rupture = "<td class='danger'>rupture</td>";
    } else {
      $rupture = "<td class='success'>disponible</td>";
    }





    $product = <<<DELIMETER
   <tr>  
   <td>$id</td>
   <td class="td-product">
     <img src="../../resources/{$product_image}" />
     <p>$product_title</p>
   </td>
   <td>$cat_title</td>
   <td>$product_featured</td>
   <td>$product_status</td>
   <td style="padding-left: 3rem;" class="$color_quantity">$product_quantity</td>
   {$rupture}
   <td>$product_price FCFA</td>
   <td>$date_insertion</td>
   <td>
     <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/products.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
   </td>
   <td class="btn-div">
     <a class="success div-btn" href="admin.php?edit_products&id={$id}"><i class="bx bxs-edit"></i></a>
   </td>
   <td class="div-btn">
   <a href="admin.php?gallery_products&id={$id}"><i class="fa-solid fa-image"></i></a>
   </td>
 </tr>


DELIMETER;
    echo $product;
  }
}
function delete_product($id) {
  // delete product from the db
  $query = query("DELETE FROM products WHERE id = " . escape_string($id) . "");
  confirm($query);
  if ($query) {
    set_alert_mssg("the product has been deleted successfully", "danger");
  } else {
    set_alert_mssg("the product was not deleted successfully", "danger");
  }
}


function add_products_admin() {
  $product_title = escape_string($_POST['product_title']);
  $product_category_id = escape_string($_POST['product_category_id']);
  $product_price = escape_string($_POST['product_price']);
  $product_desc = escape_string($_POST['product_desc']);
  $product_short_desc = escape_string($_POST['product_short_desc']);
  $product_quantity = escape_string($_POST['product_quantity']);
  $product_status = escape_string($_POST['product_status']);
  $product_featured = escape_string($_POST['product_featured']);
  $product_image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);
  $date_insertion = date("d-m-Y");
  $time_insertion = date("H:i:s");

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
  if (empty($product_image)) {
    set_alert_mssg("please enter an image", "danger");
  } else {

    $query = query("INSERT INTO products(product_title, product_category_id, date_insertion, time_insertion, product_price, product_desc, product_short_desc, product_quantity, product_image, product_status, product_featured) 
   VALUES('{$product_title}', '{$product_category_id}', '{$date_insertion}', '{$time_insertion}', '{$product_price}', '{$product_desc}', '{$product_short_desc}', '{$product_quantity}', '{$product_image}', '{$product_status}', '{$product_featured}')");
    confirm($query);


    set_alert_mssg("product added successfully", "success");
  }
}
function edit_products_admin($id) {
  $edit_id = $id;

  $product_title = escape_string($_POST['product_title']);
  $product_category_id = escape_string($_POST['product_category_id']);
  $product_price = escape_string($_POST['product_price']);
  $product_desc = escape_string($_POST['product_desc']);
  $product_short_desc = escape_string($_POST['product_short_desc']);
  $product_quantity = escape_string($_POST['product_quantity']);
  $product_status = escape_string($_POST['product_status']);
  $product_featured = escape_string($_POST['product_featured']);
  $product_image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
  if (empty($product_image)) {

    $query = query("UPDATE products SET product_title = '{$product_title}', product_category_id = '{$product_category_id}', product_price = '{$product_price}', product_desc = '{$product_desc}', product_short_desc = '{$product_short_desc}', product_quantity = '{$product_quantity}', product_status = '{$product_status}', product_featured = '{$product_featured}' WHERE id = '{$edit_id}'");
    confirm($query);

    set_alert_mssg("product updated successfully", "success");
  } else {
    $query = query("UPDATE products SET product_title = '{$product_title}', product_category_id = '{$product_category_id}', product_price = '{$product_price}', product_desc = '{$product_desc}', product_short_desc = '{$product_short_desc}', product_quantity = '{$product_quantity}', product_image = '{$product_image}', product_status = '{$product_status}', product_featured = '{$product_featured}' WHERE id = '{$edit_id}'");
    confirm($query);

    set_alert_mssg("product updated successfully", "success");
  }
}


/* gallery of single product */
function  add_products_gallery($product_id) {
  $image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $image);
  if (empty($image)) {
    set_alert_mssg("enter an image", "danger");
  } else {
    $query = query("INSERT INTO gallery(image, product_id) VALUES('{$image}', '{$product_id}')");
    confirm($query);

    set_alert_mssg("image added successfully", "success");
  }
}

function product_gallery_admin($product_id) {
  $query = query("SELECT * FROM gallery WHERE product_id = " . escape_string($product_id) . " ");
  confirm($query);

  while ($row = fetch_array($query)) {

    $image = $row['image'];
    $id = $row['id'];
    // img 
    $image = display_image($image);
    $gallery = <<<DELIMETER
   <div class="image-box">
     <img class="gImg" src="../../resources/{$image}" alt="">
     <div class="logo_icons">
     <div class="icons">
       <a class="danger delete-btn img-delete-btn" href="../../resources/templates/back/ajax/products.php?delete_img={$id}"><i class="bx bxs-trash-alt"></i></a>
     </div>
     </div>
  </div>

DELIMETER;
    echo $gallery;
  }
}


function delete_gallery_img($id) {
  $query = query("DELETE FROM gallery WHERE id = " . escape_string($id) . "");
  confirm($query);
  if ($query) {
    set_alert_mssg("the image was deleted successfully", "danger");
  } else {
    set_alert_mssg("the image was not deleted successfully", "danger");
  }
}

/*** end  ***/
/*********************************************** Categories ***************************************/

function admin_categories() {
  $query = query("SELECT * FROM categories ORDER BY id DESC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $cat_title = $row['cat_title'];
    $categories = <<<DELIMETER
       <tr>
         <td>$id</td>
         <td>
           <p>$cat_title</p>
         </td>
         <td>
           <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/categories.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
         </td>
         <td class="btn-div">
           <a class="success" href="admin.php?edit_categories&id={$id}"><i class="bx bxs-edit"></i></a>
         </td>
       </tr>


DELIMETER;
    echo $categories;
  }
}

function add_category_admin() {
  $cat_title = escape_string($_POST['cat_title']);

  if (empty($cat_title) || is_numeric($cat_title[0])) {
    set_alert_mssg("please enter a valid title", "danger");
  } else {
    $query = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}')");
    confirm($query);

    set_alert_mssg("category added successfully", "success");
  }
}


function delete_category($id) {

  $query = query("DELETE FROM categories WHERE id = " . escape_string($id) . "");
  confirm($query);
  if ($query) {
    // deletion for sliders
    $query_sliders_cat_id = query("SELECT * FROM sliders WHERE cat_id = " . escape_string($id) . "");
    confirm($query_sliders_cat_id);
    $row_count_cat_id = mysqli_num_rows($query_sliders_cat_id);
    $query_sliders = query("SELECT * FROM sliders ");
    confirm($query_sliders);
    $row_count_sliders = mysqli_num_rows($query_sliders);

    if ($row_count_cat_id == 1 && $row_count_sliders == 1) {
      $query = query("UPDATE sliders SET cat_id = 0 WHERE cat_id = " . escape_string($id) . "");
    } else {
      $query = query("DELETE FROM sliders WHERE cat_id = " . escape_string($id) . "");
    }
    // delete in collections table 
    $query = query("DELETE FROM collections WHERE cat_id = " . escape_string($id) . "");
    confirm($query);
    // set no category in products
    $query = query("UPDATE products SET product_category_id = 0 WHERE product_category_id = " . escape_string($id) . "");
    set_alert_mssg("the category has been deleted successfully", "danger");
  } else {
    set_alert_mssg("the category was not deleted successfully", "danger");
  }
}

function  edit_category_admin($id) {
  $edit_id = $id;


  $cat_title = escape_string($_POST['cat_title']);
  if (empty($cat_title) || is_numeric($cat_title[0])) {
    set_alert_mssg("please enter a valid title", "danger");
  } else {
    $query = query("UPDATE categories SET cat_title = '{$cat_title}' WHERE id = '{$edit_id}'");
    confirm($query);

    set_alert_mssg("category updated successfully", "success");
  }
}

/*********************************************** Orders ***************************************/

function orders_admin() {
  $query = query("SELECT * FROM orders ORDER BY id DESC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $order_amount = $row['order_amount'];
    $order_status = $row['order_status'];
    $order_date = $row['order_date'];
    $order_time = $row['order_time'];

    if ($order_status == 'pending') {
      $status_color = 'pending';
      $icon = '<i class="fa-solid fa-clock"></i>';
      $icon_color = 'pending-color';
    } else {
      $status_color = 'completed';
      $icon = '<i class="fa-solid fa-check-circle"></i>';
      $icon_color = 'completed-color';
    }


    $orders = <<<DELIMETER
   <tr>
   <td>$id</td>
   <td>$order_amount FCFA</td>
   <td><span class="status $status_color">$order_status</span></td>
   <td>{$order_time} | {$order_date}</td>
   <td>
     <a style="padding-left: 1rem;" class="details" href="admin.php?view_orders&id={$id}"><i class="fa-solid fa-eye"></i></a>
   </td>
   <td class="flex-tb">
     <a class="$icon_color process-btn order-process-btn" href="../../resources/templates/back/ajax/orders.php?process_id={$id}">$icon</a>
     <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/orders.php?delete={$id}"><i class="fa-solid fa-trash"></i></a>
   </td>
 </tr>


DELIMETER;
    echo $orders;
  }
}

function recent_orders_admin() {
  $query = query("SELECT * FROM orders ORDER BY id DESC LIMIT 8");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $order_amount = $row['order_amount'];
    $order_status = $row['order_status'];
    $order_date = $row['order_date'];
    $order_time = $row['order_time'];

    if ($order_status == 'pending') {
      $status_color = 'pending';
      $icon = '<i class="fa-solid fa-clock"></i>';
      $icon_color = 'pending-color';
    } else {
      $status_color = 'completed';
      $icon = '<i class="fa-solid fa-check-circle"></i>';
      $icon_color = 'completed-color';
    }


    $orders = <<<DELIMETER
   <tr>
   <td>$id</td>
   <td>$order_amount FCFA</td>
   <td><span class="status $status_color">$order_status</span></td>
   <td>{$order_time} | {$order_date}</td>
   <td>
     <a style="padding-left: 1rem;" class="details" href="admin.php?view_orders&id={$id}"><i class="fa-solid fa-eye"></i></a>
   </td>
   <td class="flex-tb">
     <a class="$icon_color process-btn order-process-btn" href="../../resources/templates/back/ajax/orders.php?process_id={$id}">$icon</a>
     <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/orders.php?delete={$id}"><i class="fa-solid fa-trash"></i></a>
   </td>
 </tr>


DELIMETER;
    echo $orders;
  }
}






function delete_order($id) {
  $query = query("DELETE FROM orders WHERE id = " . escape_string($id) . "");
  confirm($query);
  // delete every reports where order id = $id
  $query = query("DELETE FROM reports WHERE order_id = " . escape_string($id) . "");
  confirm($query);
  if ($query) {
    set_alert_mssg("the order was deleted successfully", "danger");
  } else {
    set_alert_mssg("the order was not deleted successfully", "danger");
  }
}


function order_process($order_id) {
  $select_query = query("SELECT * FROM orders WHERE id = " . escape_string($order_id) . " ");
  confirm($select_query);

  while ($row = mysqli_fetch_array($select_query)) {
    if ($row['order_status'] == "pending") {
      $update_query = query("UPDATE orders SET order_status = 'complete' WHERE id = " . escape_string($order_id) . "");
      confirm($update_query);
      $select_query2 = query("SELECT * FROM reports WHERE order_id = " . escape_string($order_id) . "");
      confirm($select_query2);
      while ($row2 = mysqli_fetch_array($select_query2)) {
        $product_quantity = $row2['product_quantity'];
        $select_query3 = query("UPDATE products SET product_quantity = product_quantity - $product_quantity WHERE id = " . escape_string($row2['product_id']) . "");
        confirm($select_query3);
      }
      echo set_alert_mssg("order was completed successfully", "success");
    } else {
      echo set_alert_mssg("order was already completed", "danger");
    }
  }
}



/*********************************************** Reports ***************************************/

/* reports */

function reports_admin($order_id) {
  $query = query("SELECT * FROM reports WHERE order_id = " . escape_string($order_id) . "");
  confirm($query);

  $check_if_completed = query("SELECT * FROM orders WHERE id = " . escape_string($order_id) . " ");
  confirm($check_if_completed);
  $delete_btn_class = '';
  while ($row = mysqli_fetch_array($check_if_completed)) {
    if ($row['order_status'] == "complete") {
      $delete_btn_class = 'none';
    }
  }

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];
    $product_image = $row['product_image'];

    $product_image = display_image($product_image);

    $reports = <<<DELIMETER
   <tr>
   <td>$id</td>
   <td>$product_id</td>
   <td class="td-product">
   <img src="../../resources/{$product_image}" />
   <p>$product_title</p>
   </td>
   <td>$product_price FCFA</td>
   <td>$product_quantity</td>
   <td>
   <a class="{$delete_btn_class} danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/orders.php?delete_report={$id}"><i class="bx bxs-trash-alt"></i></a>
   </td>
 </tr>


DELIMETER;
    echo $reports;
  }
}


function order_customer_info($order_id) {
  $query = query("SELECT * FROM orders WHERE id = " . escape_string($order_id) . "");
  confirm($query);

  while ($row = fetch_array($query)) {
    $customer_name = $row['customer_name'];
    $customer_email = $row['customer_email'];
    $customer_tel = $row['customer_tel'];
    $customer_quarter = $row['customer_quarter'];
    $customer_town = $row['customer_town'];

    $customer_info = <<<DELIMETER
   <tr>
   <td>$customer_name</td>
   <td>$customer_tel</td>
   <td>$customer_email</td>
   <td>$customer_quarter</td>
   <td>$customer_town</td>
 </tr>


DELIMETER;
    echo $customer_info;
  }
}



function delete_report($id) {
  $query = query("DELETE FROM reports WHERE id = " . escape_string($id) . "");
  confirm($query);
  if ($query) {
    set_alert_mssg("the report was deleted successfully", "danger");
  } else {
    set_alert_mssg("the report was not deleted successfully", "danger");
  }
}

/*********************************************** Sliders ***************************************/

function  sliders_admin() {
  $query = query("SELECT * FROM sliders ORDER BY id DESC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $cat_id = $row['cat_id'];
    $category_title =  show_product_category_title($cat_id);
    $image = $row['image'];
    $image = display_image($image);

    $sliders = <<<DELIMETER
  <tr>
   <td>$category_title</td>
   <td><img class="slider-img" src="../../resources/$image" alt=""></td>
   <td>
    <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/sliders.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
   </td>
   <td class="btn-div">
    <a class="success div-btn" href="admin.php?edit_sliders&id={$id}"><i class="bx bxs-edit"></i></a>
   </td>
  </tr> 







DELIMETER;
    echo $sliders;
  }
}



function add_sliders_admin() {
  $category_id = escape_string($_POST['product_category_id']);
  $image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);


  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $image);
  if (empty($image)) {
    set_alert_mssg("please enter an image", "danger");
  } else {

    $query = query("INSERT INTO sliders(cat_id, image) VALUES('{$category_id}', '{$image}')");

    confirm($query);

    set_alert_mssg("slider added successfully", "success");
  }
}


function edit_sliders_admin($id) {
  $edit_id = $id;
  $cat_id = escape_string($_POST['product_category_id']);


  $image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $image);
  if (empty($image)) {

    $query = query("UPDATE sliders SET cat_id = '{$cat_id}' WHERE id = '{$edit_id}'");
    confirm($query);

    set_alert_mssg("product updated successfully", "success");
  } else {
    $query = query("UPDATE sliders SET cat_id = '{$cat_id}', image = '{$image}' WHERE id = '{$edit_id}'");

    confirm($query);

    set_alert_mssg("product updated successfully", "success");
  }
}


function delete_slider($id) {

  $select = query("SELECT * FROM sliders ");
  confirm($select);
  $count = mysqli_num_rows($select);
  if ($count <= 1) {
    set_alert_mssg("you cannot delete the last slider", "danger");

    return;
  }
  $query = query("DELETE FROM sliders WHERE id = " . escape_string($id) . "");
  confirm($query);

  if ($query) {
    set_alert_mssg("the slider was deleted successfully", "danger");
  } else {
    set_alert_mssg("the slider was not deleted successfully", "danger");
  }
}


/*********************************************** Collections ***************************************/

function collection_admin() {
  $query = query("SELECT * FROM collections ORDER BY id DESC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $cat_id = $row['cat_id'];
    $category_title =  show_product_category_title($cat_id);
    $image = $row['image'];
    $image = display_image($image);

    $collections = <<<DELIMETER
  <tr>
   <td>$category_title</td>
   <td><img class="slider-img" src="../../resources/$image" alt=""></td>
   <td>
    <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/collections.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
   </td>
   <td class="btn-div">
    <a class="success div-btn" href="admin.php?edit_collections&id={$id}"><i class="bx bxs-edit"></i></a>
   </td>
  </tr> 


DELIMETER;
    echo $collections;
  }
}


function add_collections_admin() {
  $category_id = escape_string($_POST['product_category_id']);
  $image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);


  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $image);
  if (empty($image) || empty($category_id)) {
    if (empty($image)) {
      set_alert_mssg("please enter an image", "danger");
    }
    if (empty($category_id)) {
      set_alert_mssg("please enter a category", "danger");
    }
  } else {

    $query = query("INSERT INTO collections(cat_id, image) VALUES('{$category_id}', '{$image}')");

    confirm($query);

    set_alert_mssg("collection image added successfully", "success");
  }
}



function delete_collection($id) {

  $query = query("DELETE FROM collections WHERE id = " . escape_string($id) . "");
  confirm($query);

  if ($query) {
    set_alert_mssg("the image was deleted successfully", "danger");
  } else {
    set_alert_mssg("the image was not deleted successfully", "danger");
  }
}



function edit_collections_admin($id) {
  $edit_id = $id;
  $cat_id = escape_string($_POST['product_category_id']);


  $image = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $image);


  // if empty cat_id
  if (empty($cat_id)) {
    set_alert_mssg("please enter a category", "danger");
    return;
  }
  if (empty($image)) {

    $query = query("UPDATE collections SET cat_id = '{$cat_id}' WHERE id = '{$edit_id}'");
    confirm($query);

    set_alert_mssg("product updated successfully", "success");
  } else {
    $query = query("UPDATE collections SET cat_id = '{$cat_id}', image = '{$image}' WHERE id = '{$edit_id}'");

    confirm($query);

    set_alert_mssg("product updated successfully", "success");
  }
}


/*********************************************** Messages ***************************************/

// messages 



function admin_messages() {
  $query = query("SELECT * FROM messages ORDER BY id DESC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $date = $row['date'];
    $tel = $row['tel'];
    $status = $row['status'];
    if ($status == "non lu") {
      $color = 'alert-danger';
    } else {
      $color = 'alert-success';
    }

    $messages = <<<DELIMETER
  <tr>
       <td>$date</td>
       <td>$tel</td>
       <td>$email</td>
       <td>$name</td>
       <td style="text-align: center" class={$color}>{$status}</td>
       <td class="btn-div view-mssg" style="text-align: center">
         <a class="details" href="admin.php?view_messages&id={$id}"><i class="fa-solid fa-eye"></i></a>
       </td>
       <td style="text-align: right">
         <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/messages.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
       </td>
  </tr>


DELIMETER;
    echo $messages;
  }
}





/*  messages  */


function delete_message($id) {
  $query = query("DELETE FROM messages WHERE id = " . escape_string($id) . "");
  confirm($query);

  if ($query) {
    set_alert_mssg("the message was deleted successfully", "danger");
  } else {
    set_alert_mssg("the message was not deleted successfully", "danger");
  }
}



function single_message($id) {
  // update message status to lu
  // $query = query("UPDATE messages SET status = 'lu' WHERE id = " . escape_string($id) . "");
  // confirm($query);

  $query = query("SELECT * FROM messages WHERE id = " . escape_string($id) . "");
  confirm($query);

  while ($row = fetch_array($query)) {
    $date = $row['date'];
    $message = $row['message'];

    $single_message = <<<DELIMETER
   <h4>$date</h4>
   <p>
   $message
   </p>


DELIMETER;
    echo $single_message;
  }
}

function count_messages() {
  // count messages with status non lu
  $query_count = query("SELECT * FROM messages WHERE status = 'non lu'");
  confirm($query_count);

  $count = mysqli_num_rows($query_count);

  echo $count;
}

function update_message($id) {
  // update message status to lu
  $query = query("UPDATE messages SET status = 'lu' WHERE id = " . escape_string($id) . "");
  confirm($query);

  // count messages with status non lu

}



/*********************************************** Users ***************************************/


/**** users ****/




function add_users_admin() {
  $user_name = escape_string($_POST['user_name']);
  $user_password = escape_string($_POST['user_password']);
  $user_email = escape_string($_POST['user_email']);

  $user_tel = escape_string($_POST['user_tel']);

  $user_role = escape_string($_POST['user_role']);
  $user_photo = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);
  $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $user_photo);

  if (empty($user_password)  || empty($user_role)) {
    // if (empty($user_name)) {
    //   set_alert_mssg("please enter a username", "danger");
    // }
    if (empty($user_password)) {
      set_alert_mssg("please enter a password", "danger");
    }
    if (empty($user_role)) {
      set_alert_mssg("please enter a role", "danger");
    }
  } else {
    // check if email input is already in the database 
    $query = query("SELECT * FROM users WHERE user_email = '{$user_email}'");
    confirm($query);
    if (mysqli_num_rows($query) > 0) {
      set_alert_mssg("this email is already in the database", "danger");
    } else {
      $query = query("INSERT INTO users (user_name, user_password, user_email, user_tel, role, user_photo) VALUES ('{$user_name}', '{$user_password}', '{$user_email}', '{$user_tel}', '{$user_role}', '{$user_photo}')");
      confirm($query);
      set_alert_mssg("user added successfully", "success");
    }
  }
}


function  users_admin() {
  if ($_SESSION['role'] == 'super admin') {
    $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_SESSION['user_id']) . " ");
    confirm($query);


    while ($row = fetch_array($query)) {
      //  select users where role is super admin
      // $super_admin = query("SELECT * FROM users WHERE role = 'super admin'");
      // confirm($super_admin);
      // // count number of rows
      // $count = mysqli_num_rows($super_admin);
      // $display = '';
      // if ($count == 1) {
      //   $display = 'hide';
      // }
      $display = 'hide';

      $id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_email = $row['user_email'];
      $user_tel = $row['user_tel'];
      $role = $row['role'];
      $user_photo = $row['user_photo'];

      $super_admin = <<<DELIMETER
    <tr>  
         <td>$id</td>
         <td>$user_name</td>
         <td>$user_email</td>
         <td>$user_tel</td>
         <td>$role</td>
         <td><img class="img-fluid" src="../../resources/uploads/{$user_photo}" alt=""></td>
         <td style="text-align: right">
           <a class="danger delete-btn table-delete-btn $display" href="../../resources/templates/back/ajax/users.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
         </td>
         <td class="btn-div">
         <a class="success div-btn" href="admin.php?edit_users&id={$id}"><i class="bx bxs-edit"></i></a>
         </td>
    </tr>
 
 
DELIMETER;
      echo $super_admin;
    }

    // select every users except the super admin in desc order
    $query = query("SELECT * FROM users WHERE user_id != " . escape_string($_SESSION['user_id']) . " ORDER BY user_id DESC");

    confirm($query);

    while ($row = fetch_array($query)) {
      $id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_email = $row['user_email'];
      $user_tel = $row['user_tel'];
      $role = $row['role'];
      $user_photo = $row['user_photo'];

      $users = <<<DELIMETER
    <tr>  
         <td>$id</td>
         <td>$user_name</td>
         <td>$user_email</td>
         <td>$user_tel</td>
         <td>$role</td>
         <td><img class="img-fluid" src="../../resources/uploads/{$user_photo}" alt=""></td>
         <td style="text-align: right">
           <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/users.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
         </td>
    </tr>
 
 
DELIMETER;
      echo $users;
    }
  } else {
    $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_SESSION['user_id']) . " ");
    confirm($query);

    while ($row = fetch_array($query)) {
      $id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_email = $row['user_email'];
      $user_tel = $row['user_tel'];
      $role = $row['role'];
      $user_photo = $row['user_photo'];

      $admin = <<<DELIMETER
    <tr>  
         <td>$id</td>
         <td>$user_name</td>
         <td>$user_email</td>
         <td>$user_tel</td>
         <td>$role</td>
         <td><img class="img-fluid" src="../../resources/uploads/{$user_photo}" alt=""></td>
         <td class="btn-div">
         <a class="success div-btn" href="admin.php?edit_users&id={$id}"><i class="bx bxs-edit"></i></a>
         </td>
    </tr>
 
 
DELIMETER;
      echo $admin;
    }

    // select every users except the super admin in desc order
    $query = query("SELECT * FROM users WHERE user_id != " . escape_string($_SESSION['user_id']) . " ORDER BY user_id DESC");

    confirm($query);

    while ($row = fetch_array($query)) {
      $id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_email = $row['user_email'];
      $user_tel = $row['user_tel'];
      $role = $row['role'];
      $user_photo = $row['user_photo'];

      $users = <<<DELIMETER
    <tr>  
         <td>$id</td>
         <td>$user_name</td>
         <td>$user_email</td>
         <td>$user_tel</td>
         <td>$role</td>
         <td><img class="img-fluid" src="../../resources/uploads/{$user_photo}" alt=""></td>
    </tr>
 
 
DELIMETER;
      echo $users;
    }
  }
}





function edit_users_admin($id) {
  $edit_id = $id;

  $user_name = escape_string($_POST['user_name']);
  $user_email = escape_string($_POST['user_email']);
  $user_tel = escape_string($_POST['user_tel']);

  $user_photo = escape_string($_FILES['file']['name']);
  $image_temp_location = ($_FILES['file']['tmp_name']);
  $delete_photo = escape_string($_POST['delete_photo']);

  move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $user_photo);

  //if empty photo update without it else update with photo
  if ($delete_photo === 'yes') {
    // delete your photo

    $query = query("UPDATE users SET  user_photo = '' WHERE user_id = '{$edit_id}'");
  }

  if (empty($user_photo)) {
    $query = query("UPDATE users SET user_name = '{$user_name}', user_email = '{$user_email}', user_tel = '{$user_tel}' WHERE user_id = '{$edit_id}'");
    confirm($query);
    // set alert 
    set_alert_mssg('User updated successfully', 'success');
  } else {
    $query = query("UPDATE users SET user_name = '{$user_name}', user_email = '{$user_email}', user_tel = '{$user_tel}', user_photo = '{$user_photo}' WHERE user_id = '{$edit_id}'");
    confirm($query);
    set_alert_mssg('User updated successfully', 'success');
  }
}


function edit_password_admin($id) {
  $edit_id = $id;
  $old_password = $_POST['old_password'];
  $user_password = $_POST['user_password'];


  if (empty($old_password) || empty($user_password)) {
    if (empty($old_password)) {
      set_alert_mssg('enter your present password', 'danger');
    }
    if (empty($user_password)) {
      set_alert_mssg('enter your new password', 'danger');
    }
  } else {
    // set_alert_mssg('password updated', 'success');

    $query = query("SELECT * FROM users WHERE user_id = '{$edit_id}'");
    confirm($query);
    while ($row = fetch_array($query)) {
      $db_password = $row['user_password'];
      $db_user_password = password_verify($old_password,  $db_password);
      if ($db_user_password) {
        $update = query("UPDATE users SET user_password = '" . password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12)) . "' WHERE user_id = '{$edit_id}'");
        confirm($update);
        set_alert_mssg('password updated', 'success');
      } else {
        set_alert_mssg('present password is incorrect', 'danger');
      }
    }
  }
}

function delete_user($id) {
  $query = query("SELECT * FROM users WHERE user_id = '{$id}'");
  confirm($query);
  while ($row = fetch_array($query)) {
    $user_role = $row['role'];
  }
  // select users where role equal to super admin
  $query = query("SELECT * FROM users WHERE role = 'super admin'");
  confirm($query);
  // count number of rows
  $count = mysqli_num_rows($query);
  if ($count == 1 && $user_role == 'super admin') {
    set_alert_mssg('You cannot delete the only super admin', 'danger');
    set_alert('You cannot delete the only super admin', 'danger');
  } else {
    $query = query("DELETE FROM users WHERE user_id = '{$id}'");
    confirm($query);
    set_alert_mssg('User deleted successfully', 'success');
    set_alert('User deleted successfully', 'success');
    // if super admin delete himself
    if ($id === $_SESSION['user_id']) {
      redirect('./logout.php');
    }
  }
}


/* login  ****/

function login_user() {

  if (isset($_POST['login'])) {

    $user_email =  escape_string($_POST['user_email']);
    $user_password =  escape_string($_POST['user_password']);
    // encrypt password
    // $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = query("SELECT * FROM users WHERE user_email = '{$user_email}'");
    confirm($query);
    if (mysqli_num_rows($query) == 0) {
      set_alert('invalid email', 'danger');
    } else {

      while ($row = mysqli_fetch_array($query)) {

        // $user_name = $row['user_name'];
        // $user_photo = $row['user_photo'];
        $role = $row['role'];
        $db_user_password = $row['user_password'];

        // decrypt password
        $db_user_password = password_verify($user_password, $db_user_password);
        if ($db_user_password) {
          set_alert("you are logged in", "success");
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['role'] = $role;
          redirect("admin.php");
        } else {
          set_alert("invalid password", "danger");
        }
      }
    }
  }
}
