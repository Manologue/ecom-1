<?php require_once("../../../config.php") ?>


<?php

// this is for all the products operations


if (isset($_GET['delete'])) {
 $id = $_GET['delete'];

 delete_slider($id);
}





if (isset($_POST['action'])) {
 if ($_POST['action'] == 'add') {

  add_sliders_admin();
 }
 if ($_POST['action'] == 'edit') {
  $id = $_POST['edit_id'];

  edit_sliders_admin($id);
 }
}
