<?php
require_once ("MySiteDB.php");
$query = "SELECT * FROM authors";
$send_query = mysqli_query($link, $query);
$count = mysqli_num_rows($send_query);
$login = $_POST['login'];
$password = $_POST['password'];
$rights = $_POST['rights'];
if(($login)&&($password)&&($rights))
{
$query = "INSERT INTO authors VALUES ($count+1, '$login','$password', '$rights')";
mysqli_query($link, $query);
header( "refresh:1;url=admin.php" );
}
?>