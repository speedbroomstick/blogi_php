<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Новая заметка</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>


<nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="/"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="login.html" id="par">Вход</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="default.php" id="par">Главная</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="newnote.php" id="par">Новая заметка</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="photo.php" id="par">Добавить фото</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="inform.php" id="par">Статистика</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="admin.php" id="par">Администратору</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php" id="par">Выход</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      
      <div class="main">
      <?php require_once("MySiteDB.php"); ?>
<?php
$note_id = $_GET['note'];
$query = "SELECT created, title, article FROM notes WHERE id = $note_id";
$select_note = mysqli_query($link, $query);
while ($note = mysqli_fetch_array($select_note)){
    echo $note ['created'], "<br>";
    echo $note ['title'], "<br>";
    echo $note ['article'], "<br><br><br>";
}
$query_comments = "SELECT * FROM comments WHERE art_id = $note_id";
$select_comments = mysqli_query($link, $query_comments);
while ($note = mysqli_fetch_array($select_comments)){
    echo $note ['created'], "<br>";
    echo $note ['comment'], "<br>";
}
?>

      <a href="edit.php?note=<?php echo $note_id;?>">Изменить заметку </a><br>
<a href="deletenote.php?note=<?php echo $note_id;?>">Удалить заметку</a><br>
<h3>Добавить новый комментарий: </h3>
<form method="post"> 
    <h5>Id автора</h5>
<input type="text" name="title" size="20" maxlength="20"/>
<h5>Текст комментария</h5>
<textarea name="article" cols="10" rows="5"></textarea>
<input type="hidden" name = "created" value ="<?php echo date("Y-m-d");?>"/><br>
<input class="hollow button secondary" id="pokaz" type="submit" name="submit" value="Отправить" />
</form>
<?php
//Подключение к серверу
require_once ("MySiteDB.php");
//Получение данных из формы
$title = $_POST['title'];
$created = $_POST['created'];
$article = $_POST['article'];
if (($title)&&($created)&&($article))
{
//Формирование запроса
$query = "INSERT INTO comments(id,created,author_id, comment, art_id) 
VALUES (NULL,'$created','$title','$article', '$note_id')";
//Реализация запроса
$result = mysqli_query ($link, $query);
}
?>
      </div>


    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>