<?php require_once("../../../config.php") ?>


<?php

// this is for all the category operations


if (isset($_GET['delete'])) {
 $id = $_GET['delete'];


 delete_category($id);
}




if (isset($_POST['action'])) {
 if ($_POST['action'] == 'add') {

  add_category_admin();
 }
 if ($_POST['action'] == 'edit') {
  $id = $_POST['edit_id'];
  edit_category_admin($id);
 }
}
