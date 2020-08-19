<?php
session_start();
require_once "pdo.php";
$i=0;
?>
<!DOCTYPE=html>
<html>
<head>
  <title>Venkat Vuddagiri</title>
  <style>
  .container{
    margin-left: 50px;
  }
  </style>
</head>
<body>
  <div class="container">
  <h1>Welcome to the Automobiles Database</h1>
<?php
  if(!isset($_SESSION['name'])){
  echo '<p><a href="login.php">Please log in</a></p>';
  echo '<p>Attempt to <a href="add.php">add data</a> without login</p>';
}
else {
  if ( isset($_SESSION['success']) ) {
  echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>");
  unset($_SESSION['success']);
  }
  if (isset($_SESSION['error'])){
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>");
    unset($_SESSION['error']);
  }
  if(isset($_SESSION['rows'])){
    echo '<table border="1"';
    echo "<thead> <tr>";
    echo "<th>Make </th>";
    echo "<th>Model </th>";
    echo "<th>Year </th>";
    echo "<th>Mileage </th>";
    echo "<th>Action</th>";
    echo "</tr> </thead>";
    echo "<br>";
    foreach ( $_SESSION['rows'] as $row ) {
        echo "<tr>";
        echo "<td>".$row['make']."</td>";
        echo "<td>".$row['model']."</td>";
        echo "<td>".$row['year']."</td>";
        echo "<td>".$row['mileage']."</td>";
        echo '<td><a href="edit.php?rows_id='.$i.'">Edit</a> / <a href="delete.php?rows_id='.$i.'">Delete</a></td>';
        echo "</tr>";
        echo "<br>";
        $i+=1;
    }
    echo "</td>";
    echo "</table>";
    echo "<br>";
  }

  else{
    echo "No rows found";
    echo "<br>";
    echo "<br>";
  }
  echo '<a href="add.php">Add New Entry</a>';
  echo "<br>";
  echo "<br>";
  echo '<a href="logout.php">Logout</a>';
}
?>
</div>
</body>
</html>
