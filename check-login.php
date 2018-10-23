<? session_start();
header('Content-Type: text/html; charset=utf-8');
include("db.php");

$login = $_POST["login"];
$password = $_POST["password"];

if(!empty($login) && !empty($password)) {
    $query = mysql_query("SELECT * FROM users WHERE login = '$login' AND password = '$password'");
    $result = mysql_fetch_array($query, MYSQL_ASSOC);
    if($result) {
        $_SESSION = array(
            "user" => $result["login"], 
            "user_id" => $result["id"]
        );
        header('location: index.php');
        exit;
    } else {
        $_SESSION["wrong"] = 1;
        header('location: index.php');
        exit;
    }
}

?>