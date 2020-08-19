<?php
session_start();
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
if(isset($_POST['cancel'])){
  header("Location:index.php");
  return;
}
if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header("Location: login.php");
        return;
    } else if (strpos($_POST['email'], "@") == false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else {
        $check = hash('md5', $salt .$_POST['pass']);
        if ($check == $stored_hash) {
            error_log("Login success ".$_POST['email']);
            $_SESSION['name'] = htmlentities($_POST['email']);
            header("Location:index.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
            header("Location: login.php");
            return;
        }
    }
}
 ?>
<!DOCTYPE=html>
<html>
<head>
  <title>Venkat Vuddagiri</title>
</head>
<body>
  <h1>Please Log In</h1>
  <?php
  if(isset($_SESSION['error'])){
  echo '<p style="color:red;">'.$_SESSION['error']."</p>\n";
  unset($_SESSION['error']);
}
?>
  <form method="post">
    User Name <input type="text" name="email"><br/>
    <br/>
    Password <input type="text" name="pass"><br/>
    <br/>
    <input type="submit" name="Log In" value=Login>
    <a href="index.php">Cancel</a>
  </form>
</html>
