<?php
require_once("../config/base.php");

$url = $_POST['url'];
$url = str_replace(" ", "%20", $url);

try {
    $conn = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT url FROM cesta WHERE url=:url');
    $stmt->execute(array('url' => $url));

    $row = $stmt->fetchAll();
        if(count($row)>0) {
            echo '<font color="red"><strong>'.WORDING_OA_ALREADY_EXISTS.'</strong></font>';
        }
        else
            echo 'OK';
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

/*
// Conexão com o banco de dados para verificação de URL via AJAX (frontend).
if(isset($_GET['url'])) {
$url = $_GET['url'];
$url = str_replace(" ", "%20", $url);
echo $url;
//$url = 'utlutlurl';
$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
if($db = $db_connection->prepare('SELECT url FROM cesta WHERE url=:url')){
$db->bindValue(':url', $url, PDO::PARAM_STR);
$result = $db->fetchAll();
print_r($result);

}
else
    echo 'Erro de conexão com o banco de dados';
}
*/
?>