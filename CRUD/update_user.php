<?php
require_once "../BDD/DB_Conn.php";

// Vérifie si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    // Prépare une déclaration SQL avec des paramètres liés
    $sqlQuery = "UPDATE account SET J_Username = ?, J_Mail = ?, J_Mdp = ? WHERE J_ID = ?";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {
        // Lie les variables aux paramètres dans la déclaration préparée
        mysqli_stmt_bind_param($stmt, "sssi", $new_username, $new_email, $new_password, $user_id);

        // Exécute la déclaration préparée
        mysqli_stmt_execute($stmt);

        // Ferme la déclaration
        mysqli_stmt_close($stmt);
    }

    // Redirection vers la page précédente après la mise à jour
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>
