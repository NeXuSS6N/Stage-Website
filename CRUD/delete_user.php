<?php
require_once "../BDD/DB_Conn.php";

// Vérifie si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $user_id = $_POST['user_id'];

    // Prépare une déclaration SQL avec un paramètre lié
    $sqlQuery = "DELETE FROM account WHERE J_ID = ?";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {
        // Lie la variable au paramètre dans la déclaration préparée
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        // Exécute la déclaration préparée
        mysqli_stmt_execute($stmt);

        // Ferme la déclaration
        mysqli_stmt_close($stmt);
    }

    // Redirection vers la page précédente après la suppression
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>
