<?php
require_once "../BDD/DB_Conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifie que tous les champs sont remplis
    if (empty($username) || empty($email) || empty($password)) {
        // Affiche un message d'erreur en JavaScript avec du CSS pour styliser le popup
        echo "<style>
                .popup {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: #ffffff;
                    border: 1px solid #ccc;
                    padding: 20px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
                    z-index: 9999;
                    font-size: 1.125rem;
                    text-anchor: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    user-select: none;
                }
                .popup button {
                    background-color: #712cf9;
                    border: none;
                    color: white;
                    padding: 10px 20px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 1.125rem;
                    margin: 4px 2px;
                    cursor: pointer;
                    border-radius: 8px;
                    --bd-violet-bg: #712cf9;
                    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
                    --bs-btn-font-weight: 600;
                    --bs-btn-color: var(--bs-white);
                    --bs-btn-bg: var(--bd-violet-bg);
                    --bs-btn-border-color: var(--bd-violet-bg);
                    --bs-btn-hover-color: var(--bs-white);
                    --bs-btn-hover-bg: #6528e0;
                    --bs-btn-hover-border-color: #6528e0;
                    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
                    --bs-btn-active-color: var(--bs-btn-hover-color);
                    --bs-btn-active-bg: #5a23c8;
                    --bs-btn-active-border-color: #5a23c8;
                }
                .popup button:hover {
                    background-color: #6528e0;
                }
              </style>";
        echo "<div class='popup'>Tous les champs doivent être remplis.<br><button onclick='goBack()' class='btn-bd-primary'>OK</button></div>";
        echo "<script>
                function goBack() {
                    window.history.back();
                }
              </script>";
        exit;
    }

    $sqlQuery = "INSERT INTO account (J_Username, J_Mail, J_Mdp) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sqlQuery)) {

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>