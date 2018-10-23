<? session_start();
header('Content-Type: text/html; charset=utf-8'); 
include("db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
</head>

<body>
    <div class="container">
        <div class="row wrap-content">
            <div class="col-md-8">
               <div class='jumbotron'>
                <?
                if(empty($_GET["page"])) { // Общий вид блога, отображение всех постов
                    $query = mysql_query(
                        "SELECT contents.*, users.login 
                        FROM contents, users
                        WHERE contents.user_id = users.id
                        ORDER BY date DESC, time DESC"
                    );
                    while($data = mysql_fetch_array($query, MYSQL_ASSOC)) {
                    echo "<h2>".$data["header"]."</h2>
                    <span>Опубликовано ".$data["date"]."<br> в ".$data["time"]."<br>by ".$data["login"]."</span>";
                    if(!empty($data["pics"])) {
                        echo "<img class='img-responsive img-thumbnail' src='".$data["pics"]."' alt='pic".$data["id"]."' max-width='250px'>";
                    }
                     echo "<p>".$data["content"]."</p>
                        <p><a class='btn btn-primary btn-lg' role='button' href='?page=".$data['id']."'>Читать далее</a></p><hr>";
                }
            } else { // Отображение одного поста при переходе через кнопку
                $page = $_GET["page"];
                $query = mysql_query(
                    "SELECT contents.*, users.login 
                    FROM contents, users 
                    WHERE contents.id = $page AND contents.user_id = users.id"
                );
                $data = mysql_fetch_array($query, MYSQL_ASSOC);
                echo "<h1 class='text-center'>".$data["header"]."</h1>";
                if(!empty($data["pics"])) {
                        echo "<img class='img-responsive img-thumbnail' src='".$data["pics"]."' alt='pic".$data["id"]."' max-width='300px'>";
                    }
                echo "<p>".$data["content"]."</p>
                <span class='signature'>Опубликовано ".$data["date"]." в ".$data["time"]." by ".$data["login"]."</span>
                <p><a class='btn btn-default btn-lg' role='button' href='?'>Назад</a></p>";
            }
            ?>
                </div>
            </div>
            <div class="col-md-4 wrap-admin">
            <?
            if($_SESSION["user"]) {
                include('admin.php');
            } else if($_SESSION["wrong"]) {
                include('login.php');
                echo "<div class='alert alert-danger' role='alert'>Неправильный логин или пароль.</div>";
                $_SESSION = array();
            } else {
                include('login.php');
            }

            ?>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>