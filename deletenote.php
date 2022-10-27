<?php
require_once("mysitedb.php");
$note_id = $_GET['note'];
mysqli_select_db($link, $db);
$query = "DELETE FROM notes WHERE id = $note_id";
$res = mysqli_query($link, $query);
//Работа с заголовками (см. документацию php)
//header("Location: default.php");
header( "refresh:5;url = default.php" ); 
 echo 'Your note was deleted. You\'ll be redirected in about 5 secs. 
 If not, click <a href=" default.php">here</a>.'; 
?>