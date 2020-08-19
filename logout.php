<?php // line added to turn on color syntax highlight
session_start();
unset($pdo);
require_once "pdo.php";
unset($_SESSION['name']);
header('Location: index.php');
return;
?>
