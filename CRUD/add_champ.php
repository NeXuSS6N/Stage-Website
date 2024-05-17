<?php
require_once "../BDD/DB_Conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $popularity = $_POST['popularity'];
    $victory = $_POST['victory'];
    $banrate = $_POST['banrate'];

    $sqlQuery = "INSERT INTO champions (name, popularity, victory, banrate) VALUES ('$name', '$popularity', '$victory', '$banrate')";
    mysqli_query($conn, $sqlQuery);

    // Redirection vers la page actuelle après l'ajout
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>