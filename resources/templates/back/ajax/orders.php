<?php require_once("../../../config.php"); ?>

<?php
if (isset($_GET['process_id'])) {


 order_process($_GET['process_id']);
}


if (isset($_GET['delete'])) {


 delete_order($_GET['delete']);
}


/* report(s)  */

if (isset($_GET['delete_report'])) {
 $id = $_GET['delete_report'];


 delete_report($id);
}

?>