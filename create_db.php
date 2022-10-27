<?php
//Создать соединение с сервером 
$link = mysqli_connect ("localhost", "root", "root");
if ($link) {
echo "Соединение с сервером установлено", "<br>";
} else {
echo "Нет соединения с сервером";
}
//Создать БД MySiteDB
//Сначала формирование запроса на создание
$db = "MySiteDB";
$query = "CREATE DATABASE $db";
//Затем реализация запроса на создание. Важна последовательность аргументов функции: соединение с сервером, SQL-запрос. 
$create_db = mysqli_query($link, $query);
if ($create_db) {
echo "База данных $db успешно создана";
} else {
echo "База не создана";
}
?>
