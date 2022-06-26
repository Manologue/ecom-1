<?php require_once("../../../config.php") ?>


<?php



if (isset($_GET['delete'])) {
 $id = $_GET['delete'];


 delete_collection($id);
}





if (isset($_POST['action'])) {
 if ($_POST['action'] == 'add') {

  add_collections_admin();
 }
 if ($_POST['action'] == 'edit') {
  $id = $_POST['edit_id'];

  edit_collections_admin($id);
 }
}
