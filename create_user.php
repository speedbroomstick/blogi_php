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
$query = "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'admin' 
 WITH GRANT OPTION";
//Затем реализация запроса на создание. Важна последовательность аргументов функции: соединение с сервером, SQL-запрос. 
$create_db = mysqli_query($link, $query);
if ($create_db) {
echo "Запрос  успешен";
} else {
echo "Увы";
}
?>