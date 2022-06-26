<?php require_once("../../../config.php") ?>


<?php



// users table refresher



// users_admin();





if (isset($_GET['delete'])) {
 echo $id = $_GET['delete'];


 delete_user($id);
}





if (isset($_POST['action'])) {
 if ($_POST['action'] == 'add') {

  add_users_admin();
 }
 if ($_POST['action'] == 'edit') {
  $id = $_POST['edit_id'];

  edit_users_admin($id);
 }
 if ($_POST['action'] == 'edit_password') {
  $id = $_POST['edit_id'];
  edit_password_admin($id);
 }

 // refresher
 if ($_POST['action'] == 'getUserName') {

  $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_SESSION['user_id']) . " ");
  confirm($query);
  while ($row = fetch_array($query)) {
   echo $row['user_name'];
  }
 }
 // refresher
 if ($_POST['action'] == 'getUserPhoto') {

  $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_SESSION['user_id']) . " ");
  confirm($query);
  while ($row = fetch_array($query)) {
   $photo = $row['user_photo'];
   if (empty($photo)) {
    $photo = 'empty-profile.png';
   }
   echo $photo;
  }
 }
}




?>
