<?php require_once("../../../config.php") ?>


<?php


count_messages();


if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 delete_message($id);
}




if (isset($_GET['update_mssg'])) {
 $id = $_GET['update_mssg'];

 update_message($id);
 // optional 
 // count_messages();
}



?>
