<?php






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
