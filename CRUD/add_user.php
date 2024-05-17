<?php
require_once "../BDD/DB_Conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlQuery = "INSERT INTO account (J_Username, J_Mail, J_Mdp) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $sqlQuery);

    // Redirection vers la page actuelle après l'ajout
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>