<?php
require_once "../BDD/DB_Conn.php";

$user_img = "../assets/default.png";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_img = $_POST['user_img'];


    $sqlQuery = "UPDATE account SET J_Img = ? WHERE J_ID = ?";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {

        mysqli_stmt_bind_param($stmt, "i", $user_img);


        mysqli_stmt_execute($stmt);


        mysqli_stmt_close($stmt);
    }

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}   
?>