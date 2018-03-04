<?php
$connect = mysqli_connect("localhost", "korzun","neto1653", "global");
//$connect = mysqli_connect("localhost", "root","", "lesson04-1");
mysqli_set_charset($connect,'utf8');

$isbn="";
if (isset($_GET['isbn'])) {
  $isbn=TRIM($_GET['isbn']);
}

$name="";
if (isset($_GET['name'])) {
  $name=TRIM($_GET['name']);
}

$author="";
if (isset($_GET['author'])) {
  $author=TRIM($_GET['author']);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Домашнее задание к лекции 4.1 «Реляционные базы данных и SQL»</title>
<style>
  table { 
    border-spacing: 0;
    border-collapse: collapse;
  }

  table td, table th {
    border: 1px solid #ccc;
    padding: 5px;
  }
    
  table th {
    background: #eee;
  }
</style>
</head>
<body>
  
<h1>Библиотека успешного человека</h1>

<form method="GET">
  <input type="text" name="isbn" placeholder="ISBN" value="<?php echo $isbn; ?>">
  <input type="text" name="name" placeholder="Название книги" value="<?php echo $name; ?>">
  <input type="text" name="author" placeholder="Автор книги" value="<?php echo $author; ?>">
  <input type="submit" value="Найти">
<?php
  if (empty($isbn or $name or $author)) {
    echo "<input type='reset' value='Очистить'>";
  }
  else {
    echo "&nbsp; <a href='index.php'><b>НОВЫЙ ЗАПРОС</b></a>";
  }
?>
</form>
<br>
<table>
  <tr>
    <th>Название</th>
    <th>Автор</th>
    <th>Год выпуска</th>
    <th>Жанр</th>
    <th>ISBN</th>
  </tr>

<?php
if (isset($_GET['isbn']) or isset($_GET['author']) or isset($_GET['name'])) {
  $sql = "select * FROM books WHERE isbn LIKE '%{$isbn}%' and author LIKE '%{$author}%' and name LIKE '%{$name}%'";
}
else {
  $sql = "SELECT * FROM books"; 
}
$res = mysqli_query($connect, $sql); // (куда сохраняем данные – это объект)
  while ($data = mysqli_fetch_array($res)) {
    echo
      "<tr>
      <td>".$data['name']."</td>
      <td>".$data['author']."</td>
      <td>".$data['year']."</td>
      <td>".$data['genre']."</td>
      <td>".$data['isbn']."</td>\n</tr>\n";
}
?>
</table>
</body>
</html>