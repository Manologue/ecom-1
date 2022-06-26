<?php

/******************** helper function *********************/
$upload_directory = "uploads";




function get_out_page($table, $id) {
 $query = query("SELECT * FROM {$table} WHERE id = {$id}");
 confirm($query);
 $count_num_rows = mysqli_num_rows($query);

 if ($count_num_rows == 0) {
  redirect("admin_index.php");
 }
}

// set_alert_message for ajax 
function set_alert_mssg($msg, $text) {
 echo "
  <h4 class='alert alert-$text'>$msg</h4>
  ";
}

function empty_cart_sessions() {
 foreach ($_SESSION as $name => $value) {
  if ($value > 0) {
   if (substr($name, 0, 8) == "product_") {
    $length = strlen($name) - 8;
    $id = escape_string(substr($name, 8, $length));
    unset($_SESSION['product_' . $id]);
   }
  }
 }
 unset($_SESSION['item_total']);
 unset($_SESSION['item_total_frais']);
 unset($_SESSION['item_quantity']);
}
function last_id() {
 global $connection;
 return mysqli_insert_id($connection);
}
function display_image($picture) {
 global $upload_directory;
 return $upload_directory . DS . $picture;
}

function set_message($msg) {
 if (!empty($msg)) {
  $_SESSION['message'] = $msg;
 } else {
  $msg = "";
 }
}
function display_message() {

 if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']); // remove the message after the page is refresh
 }
}

// alert message
function set_alert($msg, $text) {
 if (!empty($msg)) {
  $_SESSION['alert_message'] = "<h4 style='text-align:center' class='alert alert-{$text}'>$msg</h4>";
 } else {
  $msg = "";
 }
}
function display_alert() {

 if (isset($_SESSION['alert_message'])) {
  echo $_SESSION['alert_message'];
  unset($_SESSION['alert_message']); // remove the message after the page is refresh
 }
}

function redirect($location) {
 header("Location:  $location");
}

function query($sql) {
 global $connection;
 return mysqli_query($connection, $sql);
}

function confirm($result) {
 global $connection;
 if (!$result) {
  die("QUERY FAILED " . mysqli_error($connection));
 }
}

function escape_string($string) {
 global $connection;

 return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
 return mysqli_fetch_array($result);
}

function show_product_category_title($product_category_id) {
 $query = query("SELECT * FROM categories WHERE id = " . escape_string($product_category_id) . " ");
 confirm($query);

 while ($row = mysqli_fetch_array($query)) {
  return $row['cat_title'];
 }
}
/************************ FRONT END FUNCTIONS ***************************/
function get_category_button_name($cat_title, $id) {
 if (preg_match('/\s/', $cat_title) || preg_replace('/[^A-Za-z0-9\-]/', '', $cat_title)) {
  $title = str_replace(' ', '_', $cat_title);
  $title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);
 } else {
  $title = $cat_title;
 }
 $id = (string) $id;
 $title .= -$id;

 return $title;
}



function categories() {
 $query = query("SELECT * FROM categories");
 confirm($query);

 while ($row = fetch_array($query)) {
  $cat_title = $row['cat_title'];
  $id = $row['id'];
  $title = get_category_button_name($cat_title, $id);
  $categories = <<<DELIMETER
    <button class="product-filter" data-filter=".{$title}">$cat_title</button>


DELIMETER;
  echo $categories;
 }
}


function products() {
 $query = query("SELECT * FROM products WHERE product_quantity > 0");
 confirm($query);

 while ($row = fetch_array($query)) {
  $id = $row['id'];
  $product_title = $row['product_title'];
  $product_category_id = $row['product_category_id'];
  $product_price = $row['product_price'];
  // $product_quantity = $row['product_quantity'];
  // $product_desc = $row['product_desc'];
  // $product_short_desc = $row['product_short_desc'];
  $product_image = $row['product_image'];
  $product_status = $row['product_status'];

  $cat_title = show_product_category_title($product_category_id);

  $title = get_category_button_name($cat_title, $product_category_id);

  $product_image = display_image($product_image);

  $status = "";
  if (!empty($product_status)) {
   if ($product_status == "new") {
    $status = "<div class='product-label label-red'>$product_status</div>";
   }
   if ($product_status == "promo") {
    $status = "<div class='product-label label-blue'>$product_status</div>";
   }
   if ($product_status == "best") {
    $status = "<div class='product-label label-yellow'>$product_status</div>";
   }
  }


  $product = <<<DELIMETER
    <a href="./product.php?id={$id}">
      <div class="product-card {$title}">
        {$status}
        <img class="product-image" src="../resources/{$product_image}" alt="" />
        <div class="product-detail">
          <h4>{$product_title} <i class="far fa-heart"></i></h4>
          <span>{$product_price} FCFA</span>
        </div>
        <a href="../resources/templates/front/action_cart.php?add=$id" class="product-button">Add to cart</a>
      </div>
    </a>


DELIMETER;
  echo $product;
 }
}


function slider_images() {
 $query = query("SELECT * FROM sliders");
 confirm($query);



 while ($row = fetch_array($query)) {
  $image = $row['image'];
  $cat_id = $row['cat_id'];

  $image = display_image($image);
  $category = show_product_category_title($cat_id);

  $title = get_category_button_name($category, $cat_id);

  if ($cat_id == 0) {
   $slider_image = <<<DELIMETER
  
      <div class="swiper-slide">
          <img src="../resources/{$image}" alt="" />
          <div class="swiper-desc">
            <h1>Discover Your <br />Own style</h1>
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Officiis eveniet harum at temporibus.
            </p>
            <a href="./products.php" class="swiper-btn">Shop now</a>
          </div>
        </div>
  

DELIMETER;
  } else {
   $slider_image = <<<DELIMETER
  
      <div class="swiper-slide">
          <img src="../resources/{$image}" alt="" />
          <div class="swiper-desc">
            <h1>Discover Your <br />Own style</h1>
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Officiis eveniet harum at temporibus.
            </p>
            <a href="./products.php?cat_id={$title}" class="swiper-btn">Shop now</a>
          </div>
        </div>

  
DELIMETER;
  }
  echo $slider_image;
 }
}


function featured_products() {
 $query = query("SELECT * FROM products WHERE product_featured = 'yes' AND product_quantity > 0");
 confirm($query);

 while ($row = fetch_array($query)) {
  $id = $row['id'];
  $product_title = $row['product_title'];
  $product_price = $row['product_price'];
  // $discount = $row['discount'];
  // $price_discount = $product_price * $discount;
  // $percentage_discount = $discount  * 100;
  $product_image = $row['product_image'];
  $product_short_desc = $row['product_short_desc'];

  $product_image = display_image($product_image);


  $featured_product = <<<DELIMETER
    <a href="./product.php?id={$id}">
    <div class="product-card">
      <div class="product-image">
        
        <img src="../resources/{$product_image}" class="product-thumb" alt="" />
        <a href="../resources/templates/front/action_cart.php?add=$id" class="card-btn">add to cart</a>
      </div>
      <a href="./product.php?id={$id}">
      <div class="product-info>
      <h2 class="product-brand">$product_title</h2>
      <p class="product-short-description">
      $product_short_desc
      </p>
      <span class="price">$product_price FCFA</span>
      </div>
      </a>
    </div>
    </a>


DELIMETER;
  echo $featured_product;
 }
}


function collections() {
 $query = query("SELECT * FROM collections");
 confirm($query);

 if (mysqli_num_rows($query) > 0) {

  $query_1 = query("SELECT * FROM collections LIMIT 1");
  confirm($query_1);

  while ($row = fetch_array($query_1)) {
   $cat_id = $row['cat_id'];
   $category = show_product_category_title($cat_id);
   $title = get_category_button_name($category, $cat_id);
   $image = $row['image'];
   $image = display_image($image);

   $collection = <<<DELIMETER
   
   <a href="./products.php?cat_id={$title}" class="collection-card">
     <img src="../resources/$image" alt="" />
     <div class="collection-detail">
       <h2>sacs a main de qualites</h2>
       <span> <i class="fas fa-long-arrow-alt-right"></i> Shop now</span>
     </div>
   </a>

 
 
 DELIMETER;
   echo $collection;
  }
 }
}

function collection_products() {
 $query = query("SELECT * FROM collections");
 confirm($query);

 if (mysqli_num_rows($query) > 1) {
  $query_2 = query("SELECT * FROM collections LIMIT 1 , 3");
  confirm($query_2);

  while ($row = fetch_array($query_2)) {
   $cat_id = $row['cat_id'];
   $category = show_product_category_title($cat_id);
   $title = get_category_button_name($category, $cat_id);
   $image = $row['image'];
   $image = display_image($image);

   $collection = <<<DELIMETER
     
     <a href="./products.php?cat_id={$title}" class="collection-card">
       <img src="../resources/{$image}" alt="" />
       <div class="collection-detail">
         <h2>sacs a main de qualites</h2>
         <span> <i class="fas fa-long-arrow-alt-right"></i>Shop now</span>
       </div>
     </a>



DELIMETER;
   echo $collection;
  }
 }
}


function cart_items() {

 $item_quantity = 0;
 foreach ($_SESSION as $name => $value) {
  if ($value > 0) {
   if (substr($name, 0, 8) == "product_") {
    $length = strlen($name) - 8;

    $id = escape_string(substr($name, 8, $length));


    $query = query("SELECT * FROM products WHERE id = $id ");
    confirm($query);
    while ($row = mysqli_fetch_array($query)) {
     $id = $row['id'];
     $product_title = $row['product_title'];
     $product_price = $row['product_price'];
     $product_image = $row['product_image'];
     $product_image = display_image($product_image);

     $sub = $product_price * $value;
     $item_quantity += $value;

     echo "     
    <a href='../public/cart.php'>
     <div class='cart-detail'>
      <img class='cart-image' src='../resources/$product_image' alt='' />
      <div class='cart-text'>
       <h4>$product_title</h4>
       <p>$value items</p>
      </div>
      <h4>$sub FCFA</h4>
     </div>
    </a>     
      ";
    }
   }
  }
 }
}

function count_cart() {
 $count = 0;
 foreach ($_SESSION as $name => $value) {

  if ($value > 0) {
   if (substr($name, 0, 8) == "product_") {
    $length = strlen($name) - 8;

    $id = escape_string(substr($name, 8, $length));


    $query = query("SELECT * FROM products WHERE id = $id");
    confirm($query);
    while ($row = mysqli_fetch_array($query)) {
     $count++;
    }
    if ($count >= 1) {
     echo " <span class='cart-item-count'>$count</span>";
    }
   }
  }
 }
}

function checkout() {
 if (isset($_POST['checkout'])) {
  $customer_name = escape_string($_POST['customer_name']);
  $customer_email = escape_string($_POST['customer_email']);
  $customer_tel = escape_string($_POST['customer_tel']);
  $customer_town = escape_string($_POST['customer_town']);
  $customer_quarter = escape_string($_POST['customer_quarter']);
  $order_amount = escape_string($_SESSION['item_total_frais']);

  // used in thank_you page
  $_SESSION['customer_name'] = $customer_name;

  $item_quantity = 0;
  $date = date("d-m-Y");
  $time = date("H:i:s");


  $query = query("INSERT INTO orders(order_amount, customer_name, customer_town, customer_quarter, customer_email, customer_tel, order_date, order_time) 
   VALUES( '{$order_amount}', '{$customer_name}' ,'{$customer_town}', '{$customer_quarter}' ,'{$customer_email}', '{$customer_tel}', '{$date}', '{$time}')");

  $last_id = last_id();

  confirm($query);

  foreach ($_SESSION as $name => $value) {
   if ($value > 0) {
    if (substr($name, 0, 8) == "product_") {
     $length = strlen($name) - 8;

     $id = escape_string(substr($name, 8, $length));


     $query = query("SELECT * FROM products WHERE id = $id");
     confirm($query);
     while ($row = mysqli_fetch_array($query)) {

      $item_quantity += $value;
      $product_title = $row['product_title'];
      $product_price = $row['product_price'];
      $product_image = $row['product_image'];
      $sub = $product_price * $value;

      $insert_report = query("INSERT INTO reports (product_image, product_id, order_id, product_title, product_price, product_quantity) VALUES ('{$product_image}', '{$id}', '{$last_id}', '{$product_title}', '{$sub}', '{$value}')");
      confirm($insert_report);
     }
    }
   }
  }
  set_alert("felicitations {$customer_name} votre commande a été envoyée avec succès", "success");
  redirect("./thank_you.php");
 }
}





function single_product_details() {
 if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $query = query("SELECT * FROM products WHERE id = " . escape_string($product_id) . " ");
  confirm($query);

  while ($row = fetch_array($query)) {
   $id = $row['id'];
   $product_title = $row['product_title'];
   $product_price = $row['product_price'];
   $product_image = $row['product_image'];
   $product_desc = $row['product_desc'];
   $product_short_desc = $row['product_short_desc'];
   $product_category_id = $row['product_category_id'];
   $product_status = $row['product_status'];



   $product = <<<DELIMETER
      <div class="product-desc">
          <div class="show">
            <h2>$product_title</h2>
            <p>$product_price FCFA</p>
            <select name="" id="">
              <option value="Select size">Select size</option>
              <option value="">M</option>
              <option value="">XXL</option>
              <option value="">XL</option>
            </select>
            <form class="quantity" method='get' action="../resources/templates/front/action_cart.php">
              <input type="hidden" name="add" value="{$id}" />
              <input name="init_value" type="number" min="1" value="1" max="" />
              <button type="submit" class="btn btn-product">Add To Cart</button>
            </form>
          </div>
          <div class="desc">
            <h3 class="details-title">Details</h3>
            <p class="description">
            $product_desc
            </p>
          </div>
        </div>

DELIMETER;
   echo $product;
  }
 }
}

function single_product_picture() {
 if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $query = query("SELECT * FROM products WHERE id = " . escape_string($product_id) . " ");
  confirm($query);
  while ($row = fetch_array($query)) {

   $product_image = $row['product_image'];
   $product_image = display_image($product_image);

   $picture = <<<DELIMETER
      <div class="swiper-slide">
        <img src="../resources/$product_image" />
      </div>


DELIMETER;
   echo $picture;
  }
 }
}


function single_product_gallery() {
 if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $query = query("SELECT * FROM gallery WHERE product_id = " . escape_string($product_id) . " ");
  confirm($query);

  while ($row = fetch_array($query)) {

   $image = $row['image'];
   $image = display_image($image);
   $gallery = <<<DELIMETER
      <div class="swiper-slide">
        <img src="../resources/{$image}" />
      </div>

DELIMETER;
   echo $gallery;
  }
 }
}


function single_product_title() {
 if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $query = query("SELECT * FROM products WHERE id = " . escape_string($product_id) . " ");
  confirm($query);

  while ($row = fetch_array($query)) {
   $product_title = $row['product_title'];

   $title = <<<DELIMETER
      <h3 class="directory">Home / $product_title</h3>


DELIMETER;
   echo $title;
  }
 }
}


function related_products() {
 if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $query = query("SELECT * FROM products WHERE id = " . escape_string($product_id) . " ");
  confirm($query);

  while ($row = fetch_array($query)) {
   $product_category_id = $row['product_category_id'];
   $query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($product_category_id) . " AND id != " . escape_string($product_id) . " ");
   confirm($query);

   if (mysqli_num_rows($query) > 0) {
    echo "
        <section class='related-products'>
          <h2>related products</h2>
          <div class='product-featured related-products-featured'>
            <button class='pre-btn'>
              <img src='images/arrow.png' alt='' />
            </button>
            <button class='nxt-btn'>
              <img src='images/arrow.png' alt='' />
            </button>
            <div class='product-container'>
          ";
    while ($row = fetch_array($query)) {
     $id = $row['id'];
     $product_title = $row['product_title'];
     $product_price = $row['product_price'];
     $product_image = $row['product_image'];
     $product_image = display_image($product_image);
     $product_short_desc = $row['product_short_desc'];

     echo "   <a href='./product.php?id={$id}'>
                <div class='product-card'>
                  <div class='product-image'>
                    <img src='../resources/$product_image' class='product-thumb' alt='' />
                    <a href='../resources/templates/front/action_cart.php?add=$id' class='card-btn'>add to cart</a>
                  </div>
                  <div class='product-info'>
                    <h2 class='product-brand'>$product_title</h2>
                    <p class='product-short-description'>
                      $product_short_desc
                    </p>
                    <span class='price'>$product_price FCFA</span>
                  </div>
                </div>
                </a>
                ";
    }
    echo "
            </div>
            <div class='container-slider-circle'>
              <div class='circle-slide circle-prev active'></div>
              <div class='circle-slide circle-next'></div>
            </div>
          </div>
        </section>
        ";
   }
  }
 }
}


/*****  cart *****/

function cart() {
 $_SESSION['frais'] = 0;
 $total = 0;
 $item_quantity = 0;
 foreach ($_SESSION as $name => $value) {
  if ($value > 0) {
   if (substr($name, 0, 8) == "product_") {
    $length = strlen($name) - 8;

    $id = escape_string(substr($name, 8, $length));


    $query = query("SELECT * FROM products WHERE id = $id ");
    confirm($query);
    while ($row = mysqli_fetch_array($query)) {
     $id = $row['id'];
     $product_title = $row['product_title'];
     $product_price = $row['product_price'];
     $product_image = $row['product_image'];
     $product_image = display_image($product_image);

     $sub = $product_price * $value;
     $item_quantity += $value;

     echo "
      
      
      <div class='product'>
 
           <img src='../resources/$product_image' />
            
           <div class='cart-product'>
           
           <div class='product-info'>
             <h3 class='product-name'>$product_title</h3>
 
             <h4 class='product-price'>$sub FCFA</h4>
 
             <h4 class='product-offer'>Quantity</h4>
 
             <div class='product-quantity'>
             <a href='../resources/templates/front/action_cart.php?reduce=$id' class='cart-reduce-btn'>
             <i class='bx bx-minus'></i>
             </a>
             <span class='product-quantity-value'>$value</span>
             <a href='../resources/templates/front/action_cart.php?add=$id' class='cart-add-btn'>
             <i class='bx bx-plus'></i>
             </a>
             </div>
 
             
           </div>
           <div class='cart-icons'>
             <a  class='product-view-icon'  href='./product.php?id=$id'>
             <i class='fa-solid fa-eye'></i>
             </a>
             <a href='../resources/templates/front/action_cart.php?delete=$id' class='product-remove'>
               <i class='fa fa-trash'></i>
             </a>
           </div>
           
           </div>
     </div>
      

        
      
      
      ";
     $_SESSION['quantity'] = $value;
     $_SESSION['item_total'] = $total += $sub;
     $_SESSION['item_total_frais'] = $_SESSION['item_total'] + $_SESSION['frais'];
    }
   }
  }
 }

 // quantity of all products in cart
 $_SESSION['item_quantity'] = $item_quantity;
 isset($_SESSION['item_total_frais']) ? $_SESSION['item_total_frais'] : $_SESSION['item_total_frais'] = 0;
 isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = 0;

 if ($item_quantity < 1) {
  echo "

  
        <main class='empty-cart'>
             <h2>votre pannier est vide veillez ajoutez des produits</h2>
        </main>
      
      ";
 }
}


function reports() {

 $item_quantity = 0;
 foreach ($_SESSION as $name => $value) {
  if ($value > 0) {
   if (substr($name, 0, 8) == "product_") {
    $length = strlen($name) - 8;

    $id = escape_string(substr($name, 8, $length));


    $query = query("SELECT * FROM products WHERE id = $id ");
    confirm($query);
    while ($row = mysqli_fetch_array($query)) {
     $id = $row['id'];
     $product_title = $row['product_title'];
     $product_price = $row['product_price'];
     $product_image = $row['product_image'];
     $product_image = display_image($product_image);
     $sub = $product_price * $value;
     $item_quantity += $value;

     echo "
      
      
      <div class='product'>
 
           <img src='../resources/$product_image' />
            
           <div class='cart-product'>
           
           <div class='product-info'>
             <h3 class='product-name'>$product_title</h3>
 
             <h4 class='product-price'>$sub FCFA</h4>
 
             <h4 class='product-offer'>Quantity</h4>
 
             <div class='product-quantity'>
             
             <span class='product-quantity-value'>$value</span>
             
             </div>
 
             
           </div>
           
           
           </div>
     </div>
      

        
      
      
      ";
    }
   }
  }
 }
}

/*** ajax ***/

function messages() {

 $name = $_POST['name'];
 $message = $_POST['message'];
 $tel = $_POST['tel'];
 $email = $_POST['email'];
 $date = date("d-m-Y H:i:s");  // date d'insertion


 if (!empty($message)) {

  $query = query("INSERT INTO messages(name, message, tel, email, date) VALUES('$name', '$message', '$tel', '$email', '$date')");
  confirm($query);
  echo "<h4 class='alert alert-success'>message envoyé avec succès</h4>";
 } else {
  echo "<h4 class='alert alert-success'>Veillez laisser un message s'il vous plait</h4>";
 }
}



/************************ BACK END FUNCTIONS ***************************/

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
   redirect('logout.php');
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
