<?php
require_once "../BDD/DB_Conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['user_id'];


    $sqlQuery = "DELETE FROM account WHERE J_ID = ?";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {

        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>