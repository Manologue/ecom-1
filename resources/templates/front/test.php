<?php require_once("../../config.php"); ?>
<?php

if (isset($_GET["add"])) {


 $init_value = $_GET["init_value"];

 // in case the user choose quantity product from single page
 if (isset($init_value)) {
  $product_value_count = $_SESSION['product_' . $_GET["add"]];
  $product_value_count += $init_value;

  $query = query("SELECT * FROM products WHERE id=" . escape_string($_GET['add']) . "");
  confirm($query);
  while ($row = mysqli_fetch_array($query)) {
   if ($row['product_quantity'] < $product_value_count) {
    $_SESSION['product_' . $_GET["add"]] = $row['product_quantity'];
    set_alert("nous avons juste " . $row['product_quantity'] . " " . "{$row['product_title']}" . " disponible", "danger");
    redirect("../../../public/cart.php");
   } else {
    $_SESSION['product_' . $_GET["add"]] += $init_value;
    redirect("../../../public/cart.php");
   }
  }
 } else {
  $query = query("SELECT * FROM products WHERE id=" . escape_string($_GET['add']) . "");
  confirm($query);
  while ($row = mysqli_fetch_array($query)) {
   if ($row['product_quantity'] != $_SESSION['product_' . $_GET["add"]]) {
    $_SESSION['product_' . $_GET["add"]] += 1;
    redirect("../../../public/cart.php");
   } else {
    set_alert("nous avons juste " . $row['product_quantity'] . " " . "{$row['product_title']}" . " disponible", "danger");
    redirect("../../../public/cart.php");
   }
  }
 }
}




if (isset($_GET['reduce'])) {

 $_SESSION['product_' . $_GET["reduce"]]--;
 if ($_SESSION['product_' . $_GET["reduce"]] < 1) {
  unset($_SESSION['product_' . $_GET["delete"]]);

  unset($_SESSION['item_total']);
  unset($_SESSION['item_total_frais']);


  redirect("../../../public/cart.php");
 } else {
  redirect("../../../public/cart.php");
 }
}

if (isset($_GET['delete_all'])) {

 // foreach ($_SESSION as $name => $value) {
 //  if ($value > 0) {
 //   if (substr($name, 0, 8) == "product_") {
 //    $length = strlen($name) - 8;
 //    $id = escape_string(substr($name, 8, $length));
 //    unset($_SESSION['product_' . $id]);
 //   }
 //  }
 // }
 // unset($_SESSION['item_total']);
 // unset($_SESSION['item_total_frais']);
 // redirect("cart.php");
}

if (isset($_GET['delete'])) {
 unset($_SESSION['product_' . $_GET["delete"]]);
 // $_SESSION['product_' . $_GET["delete"]] = '0';
 unset($_SESSION['item_total']);
 unset($_SESSION['item_total_frais']);


 redirect("../../../public/cart.php");
}


 // $query = query("SELECT * FROM users");
  // confirm($query);

//   while ($row = fetch_array($query)) {
//     $id = $row['user_id'];
//     $user_name = $row['user_name'];
//     $user_email = $row['user_email'];
//     $user_tel = $row['user_tel'];
//     $role = $row['role'];
//     $user_photo = $row['user_photo'];
//     if ($_SESSION['role'] == "super admin") {
//       $users = <<<DELIMETER
//      <tr>  
//           <td>$id</td>
//           <td>$user_name</td>
//           <td>$user_email</td>
//           <td>$user_tel</td>
//           <td>$role</td>
//           <td>$user_photo</td>
//           <td><img class="img-fluid" src="../../resources/uploads/{$user_photo}" alt=""></td>
//           <td style="text-align: right">
//             <a class="danger delete-btn table-delete-btn" href="../../resources/templates/back/ajax/users.php?delete={$id}"><i class="bx bxs-trash-alt"></i></a>
//           </td>
//      </tr>
  
  
// DELIMETER;
//       echo $users;
//     } else {
//       $users = <<<DELIMETER
//      <tr>  
//           <td>$id</td>
//           <td>$user_name</td>
//           <td>$user_email</td>
//           <td>$user_tel</td>
//           <td>$role</td>
//           <td>$user_photo</td>
//           <td><img class="img-fluid" src="../../resources/uploads/{$user_photo}" alt=""></td>
//      </tr>
  
  
// DELIMETER;
//       echo $users;
//     }
//   }

?>