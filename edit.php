<?php
session_start();
require_once "pdo.php";
if(!(isset($_SESSION['name']))){
die("ACCESS DENIED");
}
if(isset($_GET['rows_id'])){
  $_SESSION['rows_id']=$_GET['rows_id'];
}
if(isset($_POST['cancel'])){
  header("Location:index.php");
  return;
}
if(isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])){
      if (strlen($_POST['make']) < 1 || strlen($_POST['model'])<1 || strlen($_POST['year'])<1 || strlen($_POST['mileage'])<1) {
          $_SESSION['error'] = "All fields are required";
          header("Location: edit.php");
          return;
      }elseif(!is_numeric($_POST['year']) & !is_numeric($_POST['mileage'])){
        $_SESSION['error']="Year and mileage must be numeric";
        header("Location:edit.php");
        return;
      }
      elseif (!is_numeric($_POST['year'])) {
          $_SESSION['error'] = "Year must be numeric";
          header("Location: edit.php");
          return;
      }elseif (!is_numeric($_POST['mileage'])) {
        $_SESSION['error']="Mileage must be numeric";
        header("Location:edit.php");
        return;
      }
      else {
        $sql ="UPDATE autos SET make=:mk,model=:md,year=:yr,mileage=:mi WHERE autos_id='".$_SESSION['rows'][$j]['autos_id']."'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
       ':mk' => htmlentities($_POST['make']),
       ':md' => htmlentities($_POST['model']),
       ':yr' => htmlentities($_POST['year']),
       ':mi' => htmlentities($_POST['mileage'])]);
        $stmt = $pdo->query("SELECT * FROM autos");
        $_SESSION['rows']=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['success'] = "Record edited";
        header("Location: index.php");
        return;
      }
  }
?>
<!DOCTYPE=html>
<html>
<head>
  <style>
  .container{
    margin-left: 50px;
  }
  input{
    margin-top: 10px;
    margin-bottom: 10px;
  }
  </style>
<title>Venkat Vuddagiri</title>
</head>
<body>
  <div class="container">
  <h1>Tracking Automobiles for <?=$_SESSION['name'];?></h1>
  <?php
  $j=$_SESSION['rows_id'];
  if(isset($_SESSION['error'])){
  echo '<p style="color:red;">'.$_SESSION['error']."</p>\n";
  unset($_SESSION['error']);
}
?>
  <form method="post">
    Make:<input type="text" name="make" value=<?='"'.$_SESSION['rows'][$j]['make'].'"'?>><br>
    Model:<input type="text" name="model" value=<?php echo '"'.$_SESSION['rows'][$j]['model'].'"';?>><br>
    Year:<input type="text" name="year" value=<?php echo '"'.$_SESSION['rows'][$j]['year'].'"';?>><br>
    Mileage:<input type="text" name="mileage" value=<?php echo '"'.$_SESSION['rows'][$j]['mileage'].'"';?>><br>
    <input type="submit" name="add" value="Save"/>
    <input type="submit" name="cancel" value="Cancel"/>
  </form>
</div>
</body>
</html>
