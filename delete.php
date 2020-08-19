<?php
session_start();
require_once "pdo.php";
$k=$_GET['rows_id'];
if(!isset($_SESSION['name'])){
  die('ACCESS DENIED');
}
if(isset($_POST['delete'])){
  $sql = "DELETE FROM autos WHERE autos_id = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':zip' => $_SESSION['rows'][$k]['autos_id']));
  $stmt = $pdo->query("SELECT * FROM autos");
  $_SESSION['rows']=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $_SESSION['error']="Record deleted";
  header("Location:index.php");
  return;
}
 ?>
<!DOCTYPE=html>
<html>
<head>
  <title>Venkat Vuddagiri</title>
  <style>
  body{
    padding-left: 50px;
    padding-top: 30px;
  }
  </style>
</head>
<body>
  Confirm:Deleting <?=$_SESSION['rows'][$k]['model'] ?>?
  <br>
  <br>
  <form method="POST">
    <input type="submit" name="delete" value="Delete"/>
    <a href="index.php">Cancel</a>
  </form>
</body>
</html>
