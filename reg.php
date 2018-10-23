<? header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Blog : Registration</title>
</head>

<body>
    <div class="container">
            <div class="col-md-4 col-md-offset-4 wrap-admin">
                <h1>Регистрация</h1>
                <form action="" method="POST">
                    <div class="form-group">
                        <input class="form-control" name="login" placeholder="Ваш логин" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Ваш пароль" required>
                    </div>
                    <input class="btn btn-primary" type="submit">
                    <a class="" href="index.php" role="button">Вход</a>
                </form>


                <?
include("db.php");

$login = $_POST["login"];
$password = $_POST["password"];

if(!empty($login) && !empty($password)) {
    $query = mysql_query("SELECT login FROM users WHERE login = '$login'");
    $result = mysql_fetch_array($query, MYSQL_ASSOC);
    if(!$result) {
        mysql_query("INSERT INTO users(login, password) VALUES('$login','$password')");
        echo "<div class='alert alert-success' role='alert'>Данные добавлены в таблицу</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Такой логин уже существует</div>";
    }
}

?>
            </div>
        </div>

</body>

</html>
