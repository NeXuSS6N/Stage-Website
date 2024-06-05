<?php
require_once "../BDD/DB_Conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    // Récupère les valeurs actuelles de l'utilisateur
    $sqlGetUser = "SELECT J_Username, J_Mail, J_Mdp FROM account WHERE J_ID = ?";
    if ($stmt = mysqli_prepare($conn, $sqlGetUser)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $current_username, $current_email, $current_password);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Vérifie et remplace les valeurs vides par les valeurs actuelles
    $new_username = ($new_username === '') ? $current_username : $new_username;
    $new_email = ($new_email === '') ? $current_email : $new_email;
    $new_password = ($new_password === '') ? $current_password : $new_password;


    $sqlQuery = "UPDATE account SET J_Username = ?, J_Mail = ?, J_Mdp = ? WHERE J_ID = ?";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {

        mysqli_stmt_bind_param($stmt, "sssi", $new_username, $new_email, $new_password, $user_id);


        mysqli_stmt_execute($stmt);


        mysqli_stmt_close($stmt);
    }

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>
