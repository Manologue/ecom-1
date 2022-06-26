<?php

/******************** helper function *********************/
$upload_directory = "uploads";


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
function get_out_page($table, $id) {
  $query = query("SELECT * FROM {$table} WHERE id = {$id}");
  confirm($query);
  $count_num_rows = mysqli_num_rows($query);

  if ($count_num_rows == 0) {
    redirect("admin_index.php");
  }
}



/************************ FRONT END FUNCTIONS ***************************/

include('controller/front/front.php');

/************************ BACK END FUNCTIONS ***************************/

include('controller/back/back.php');
