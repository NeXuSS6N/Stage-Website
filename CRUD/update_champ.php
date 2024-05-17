<?php
require_once "../BDD/DB_Conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $champ_id = $_POST['user_id'];
    $new_popularity = $_POST['new_popularity'];
    $new_victory = $_POST['new_victory'];
    $new_banrate = $_POST['new_banrate'];

    $sqlQuery = "UPDATE champions SET popularity='$new_popularity', victory='$new_victory', banrate='$new_banrate' WHERE id='$champ_id'";
    mysqli_query($conn, $sqlQuery);

    // Redirection vers la page actuelle après la mise à jour
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>