<? session_start();
include("db.php");

$date = date("d.m.y");
$time = date("H:i:s");
$header = $_POST["header"];
$content = $_POST["content"];
$user_id = $_SESSION["user_id"];
// Обработка файла, если есть
if(!empty($header) && !empty($content)) {
    mysql_query("INSERT INTO contents(header, date, time, content, user_id) VALUES('$header','$date', '$time', '$content', '$user_id')");
    if($_FILES["picture"]["size"] != 0) {
        $name = $_FILES["picture"]["name"];
        $link = "pictures/".$name;
        // Если файл загружен, перемещаем его в папку с проектом
        move_uploaded_file($_FILES["picture"]["tmp_name"], $link);
        // Добавляем запись в БД
        mysql_query("UPDATE contents SET pics='$link' WHERE date='$date' AND time='$time'");
    }
}
header('location: index.php');
?>