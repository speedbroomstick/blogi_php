<?php require_once("MySiteDB.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Главная страница сайта</title>
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
      <p>Рад приветствовать вас на страницах моего сайта, посвященного путешествиям. </p>
      <h3>Поиск по содержанию</h3>
      <input type="text" name="usersearch" id="usersearch">
      <input class="hollow button secondary" id="pokaz" type="submit" value="ПОИСК" onclick="knopka()">
      <br>
<?php
$query = "SELECT * FROM notes ORDER BY id DESC";
$select_note = mysqli_query($link, $query);
while ($note = mysqli_fetch_array($select_note)){


   echo' <div class="card" style="width: 100%;"><div class="card-body"><h5 class="card-title">';
    echo $note['id'], "<br>";
    ?>
    <a href="comments.php?note=<?php echo $note['id']; ?>">
    <?php echo $note ['title'], "<br>";?></a>
     
    <?php 
    echo '</h5>
    <p class="card-text">',$note ['created'], '<br>', $note ['article'] ,'</p>
  </div>
</div>';
    }
    ?>

    <script>
        function knopka(){
            stroka = document.getElementById('usersearch').value;
        window.location.href = 'default.php?click=1&search='+stroka;
        }
    </script>
      <?php 
      if($_GET['click']){
    require_once("MySiteDB.php");
//Поиск по фразе (по содержанию заметки)
$user_search = $_GET["search"];
if(isset($_GET["search"])){
  
    $user_search = $_GET["search"];
}

echo  "<br>";
$where_list = array();
$query_usersearch = "SELECT * FROM notes";
$clean_search = str_replace(',', ' ', $user_search);
$search_words = explode(' ', $user_search);
//Создаем еще один массив с окончательными результатами
$final_search_words = array();
//Проходим в цикле по каждому элементу массива $search_words. 
//Каждый непустой элемент добавляем в массив $final_search_words
if (count($search_words) > 0)
{
foreach($search_words as $word)
{
if (!empty($word))
{
$final_search_words[] = $word;
}
}
}
//работа с использованием массива $final_search_words
foreach ($final_search_words as $word)
{
$where_list[] = " article LIKE '%$word%'";
}
$where_clause = implode (' OR ', $where_list);
if (!empty($where_clause))
{
 $query_usersearch .=" WHERE $where_clause";
}
$res_query = mysqli_query($link, $query_usersearch);
echo "<h2>Результаты поиска<h2>";
while ($res_array = mysqli_fetch_array($res_query))
{
echo "<h6></h6>", $res_array['id'], "<br>";
echo "<h6></h6>",  $res_array['article'], "<br>", "<hr>", "<br>";
}
      }
?>
      </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<body>
</html>

