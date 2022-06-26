<?php require_once("../../../config.php") ?>


<?php

// this is for all the products operations


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];


  delete_product($id);
}
if (isset($_GET['delete_img'])) {
  $id = $_GET['delete_img'];


  delete_gallery_img($id);
}




if (isset($_POST['action'])) {
  if ($_POST['action'] == 'add') {

    add_products_admin();
  }
  if ($_POST['action'] == 'edit') {
    $id = $_POST['edit_id'];

    edit_products_admin($id);
  }
  if ($_POST['action'] == 'add_gallery') {
    if (isset($_GET['id'])) {
      $product_id = $_GET['id'];
      add_products_gallery($product_id);
    }
  }
}
