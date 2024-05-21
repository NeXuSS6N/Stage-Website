<?php
require_once "../BDD/DB_Conn.php";

// Vérifie si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifie que tous les champs sont remplis
    if (empty($username) || empty($email) || empty($password)) {
        // Affiche un message d'erreur en JavaScript
        echo "<script>alert('Tous les champs doivent être remplis.'); window.history.back();</script>";
        exit;
    }

    // Prépare une déclaration SQL avec des paramètres liés
    $sqlQuery = "INSERT INTO account (J_Username, J_Mail, J_Mdp) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {
        // Lie les variables aux paramètres dans la déclaration préparée
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

        // Exécute la déclaration préparée
        mysqli_stmt_execute($stmt);

        // Ferme la déclaration
        mysqli_stmt_close($stmt);
    }

    // Redirection vers la page précédente après l'ajout
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>
