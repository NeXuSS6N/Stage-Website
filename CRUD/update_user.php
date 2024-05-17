<?php
require_once "../BDD/DB_Conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    $sqlQuery = "UPDATE account SET J_Username='$new_username', J_Mail='$new_email', J_Mdp='$new_password' WHERE J_ID='$user_id'";
    mysqli_query($conn, $sqlQuery);

    // if ($new_email = )

    // Redirection vers la page actuelle après la mise à jour
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>