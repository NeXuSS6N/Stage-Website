<?php
// Démarre la session
session_start();
require_once '../PHP/constList.php';

// Vide les données de la session
$_SESSION = array();

// Si les cookies de session sont utilisés, détruit le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Définit la variable de session "loggedin" sur false
$_SESSION[LOGGEDIN] = false;

// Détruit la session
session_destroy();

// Redirige vers la page de connexion
header("Location: ../php/login.php");
exit;
?>