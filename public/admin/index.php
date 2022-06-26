<?php require_once("../../resources/config.php") ?>
<?php
login_user()
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <title>Login</title>
</head>

<body>
  <div class="wrapper">
    <div class="title">DASHBOARD</div>
    <form action="" method="post">
      <?php
      display_alert()
      ?>
      <div class="field">
        <input type="email" name="user_email" required>
        <label>Email Address</label>
      </div>
      <div class="field">
        <input type="password" name="user_password" required>
        <label>Password</label>
      </div>
      <div class="content">
        <!-- <div class="checkbox">
     <input type="checkbox" id="remember-me">
     <label for="remember-me">Remember me</label>
    </div> -->
        <div class="pass-link"><a href="#">Forgot password?</a></div>
      </div>
      <div class="field">
        <input type="submit" name="login" value="Login">
      </div>
      <div class="signup-link">change your password? <a href="#">Click here</a></div>
    </form>
  </div>
</body>

</html>