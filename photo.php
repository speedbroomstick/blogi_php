
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<?php
//Сценарий отправки файла на сервер
//Проверяем, была ли выполнена отправка файла. Далее реализуем сценарий. 
if (isset($_POST["MAX_FILE_SIZE"]))
{
$tmp_file_name = $_FILES["file_upload"]["tmp_name"];
$dest_file_name = "./photot/".$_FILES["file_upload"]["name"];
move_uploaded_file($tmp_file_name, $dest_file_name);
}
?>
<?php 
//Сценарий удаления файла
//Сначала проверяем, было ли запущено удаление файла
if (isset($_POST["file_delete"]))
{
//Формируем полное имя файла
$file_name = "./photot/".$_POST["file_delete"];
//Функция unlink() удаляет файл
unlink($file_name);
}
?>
<?php
//Получаем полный путь к папке, где хранятся графические файлы 
$image_dir_path = ".\photot";
//Запускаем просмотр папки. Функция opendir() возвращает идентификатор //папки
$image_dir_id = opendir($image_dir_path);
//$array_files - массив, в который будут помещаться все найденные файлы
$array_files = null;
//Служебная переменная, используемая для вычисления индекса следующего 
//элемента массива $array_files
$i = 0;
//Запускаем цикл просмотра
while(($path_to_file = readdir($image_dir_id)) !== false)
//Функция readdir() возвращает полный путь к очередному файлу, хранящемуся //в папке, идентификатор которой был возвращен функцией opendir() и передан //в качестве параметра. 
//$path_to_file получает полный путь к файлу для дальнейшей обработки. Если в папке нет непросмотренных файлов - возвращается логическое значение false 
{
if(($path_to_file !=".") && ($path_to_file !=".."))
//Точки обозначают вложенные файлы: одна точка - текущая папка, две точки // - папка, в которую вложена текущая папка. 
{
$array_files[$i] = basename($path_to_file);
$i++;
//Помещаем имя найденного файла в массив $array_files. Функция basename() //позволяет получить имя файла из полного пути к нему. 
}
}
closedir($image_dir_id);
//closedir() удаляет из памяти переданный ей идентификатор папки, таким 
//образом завершая просмотр. 
?>
<?php
//Получаем количество элементов массива $array_files, т.е. количество 
//найденных файлов. 
$array_files_count = count($array_files);
if ($array_files_count)
{
?>
<hr />
 <?php
sort($array_files);
for ($i=0; $i<$array_files_count; $i++)
{
//Выводим мена хранящихся в массиве файлов на страницу
?>
<p><a href="/MyTravelNotes/photot/<?php echo $array_files[$i]; ?>" 
target="_blank">
 <?php echo $array_files[$i]; ?></a></p>
<?php
}
?>
<hr />
 <?php
}
?>
<!-- Форма для отправки файла на сервер -->
<form name = "file_upload" action="photo.php" enctype="multipart/form-data" method="post">
<input type="file" name="file_upload" />
<input type="hidden" name="MAX_FILE_SIZE" value="65536" />
<input type="submit" name="submit" value="Добавить" />
</form>
<form name="file_delete" action="photo.php" method="post" enctype=" multipart/form-data ">
<select name = "file_delete" size="1">
<?php for ($i=0; $i<$array_files_count; $i++) 
{ ?>
<option><?php echo $array_files[$i]; ?></option>
<?php } ?>
</select>
<input type="submit" name="submit" value="Удалить" />
</form>

<br>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>