<?php

//------------------------------------
//  _____ _               _    
// /  __ \ |             | |   
// | /  \/ |__   ___  ___| | __
// | |   | '_ \ / _ \/ __| |/ /
// | \__/\ | | |  __/ (__|   < 
//  \____/_| |_|\___|\___|_|\_\
//------------------------------------  

// Vérifie si la méthode HTTP est POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $msg = "Méthode POST attendue. Reçu :" . $_SERVER["REQUEST_METHOD"];
    header("Location: error.php?msg=" . $msg);
    exit();
}

// Vérifie et filtre l'e-mail
if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
} else {
    $email = false;
}



// Récupère le login
$login = isset($_POST['login']) ? $_POST['login'] : "";

// Vérifie et récupère les mots de passe
$pwd_unhashed = isset($_POST['password']) ? $_POST['password'] : "";
$pwd_unhashed_check = isset($_POST['password_check']) ? $_POST['password_check'] : "";

// $pwd_unhashed = (isset($_POST['password']) && preg_match($pattern, $_POST['password'])) ? $_POST['password'] : "";
// $pwd_unhashed_check = (isset($_POST['password_check']) && preg_match($pattern, $_POST['password_check'])) ? $_POST['password_check'] : "";



function isValidPassword($password)
{
    // Vérifier si le mot de passe contient au moins une lettre majuscule
    $hasUppercase = preg_match('/[A-Z]/', $password);
    // Vérifier si le mot de passe contient au moins une lettre minuscule
    $hasLowercase = preg_match('/[a-z]/', $password);
    // Vérifier si le mot de passe contient au moins un chiffre
    $hasDigit = preg_match('/\d/', $password);
    // Vérifier si le mot de passe contient au moins un caractère spécial
    $hasSpecialChar = preg_match('/[\W_]/', $password); // \W est pour tout caractère non alphabétique, non numérique

    // Vérifier que toutes les conditions sont remplies
    return $hasUppercase && $hasLowercase && $hasDigit && $hasSpecialChar;
}

// Vérifie si les mots de passe correspondent
// if ($pwd_unhashed != $pwd_unhashed_check) {
//     $msg = "Les deux mots de passes ne correspondent pas.";
//     header("Location: error.php?msg=" . $msg);
//     exit();
// }


if (isValidPassword($password)) {
    echo "Le mot de passe est valide.";
} else {
    echo "Le mot de passe n'est pas valide.";
}



//------------------------------------  
//  _____ _               _      _____                    
// /  __ \ |             | |    |  ___|                   
// | /  \/ |__   ___  ___| | __ | |__ _ __ _ __ ___  _ __ 
// | |   | '_ \ / _ \/ __| |/ / |  __| '__| '__/ _ \| '__|
// | \__/\ | | |  __/ (__|   <  | |__| |  | | | (_) | |   
//  \____/_| |_|\___|\___|_|\_\ \____/_|  |_|  \___/|_|   
//------------------------------------                                                  
if (
    $login == "" ||
    $pwd_unhashed == "" ||
    $email == "" ||
    $email == false
) {
    $msg = "Une des valeurs est vide :" . "<br>";
    $msg = $msg . " - Login -> " . $login . "<br>";
    $msg = $msg . " - Password -> " . $pwd_unhashed . "<br>";
    $msg = $msg . " - Email -> " . $email . "<br>";
    header("Location: error.php?msg=" . $msg);
    exit();
}
//------------------------------------








//------------------------------------
//  _____      _ _    ____________ 
// |_   _|    (_) |   |  _  \ ___ \
//   | | _ __  _| |_  | | | | |_/ /
//   | || '_ \| | __| | | | | ___ \
//  _| || | | | | |_  | |/ /| |_/ /
//  \___/_| |_|_|\__| |___/ \____/ 
//------------------------------------

// Paramètres de connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'bdd stage';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Crée une nouvelle connexion PDO
    $pdo_conn = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, redirige vers une page d'erreur
    $msg = $e->getMessage();
    header("Location: error.php?msg=" . $msg);
    die("La connexion à échoué: " . $e->getMessage() . ' <br> Code erreur n° ' . (int) $e->getCode());
}
//------------------------------------






//------------------------------------
// ____________   _____ _               _    
// |  _  \ ___ \ /  __ \ |             | |   
// | | | | |_/ / | /  \/ |__   ___  ___| | __
// | | | | ___ \ | |   | '_ \ / _ \/ __| |/ /
// | |/ /| |_/ / | \__/\ | | |  __/ (__|   < 
// |___/ \____/   \____/_| |_|\___|\___|_|\_\
//------------------------------------

// Vérifie si le login ou l'e-mail existe déjà dans la base de données
$msg = "";

$sql = "SELECT COUNT(*) AS cnt
            FROM account
            WHERE J_Username = :login
            OR J_Mail = :email";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($row = $stmt->fetch()) {
    if ((int) $row["cnt"] != 0) {
        $msg = "Login ou mail existe déjà dans la BDD";
    }
} else {
    $msg = "Erreur SQL ?";
}
if ($msg != "") {
    header("Location: error.php?msg=" . $msg);
    exit();
}



//------------------------------------
// ____________   _____                    _   
// |  _  \ ___ \ |_   _|                  | |  
// | | | | |_/ /   | | _ __  ___  ___ _ __| |_ 
// | | | | ___ \   | || '_ \/ __|/ _ \ '__| __|
// | |/ /| |_/ /  _| || | | \__ \  __/ |  | |_ 
// |___/ \____/   \___/_| |_|___/\___|_|   \__|                                    
//------------------------------------          
//$pwd_hashed = password_hash($pwd_unhashed, PASSWORD_DEFAULT);
$pwd_hashed = $pwd_unhashed; //password_hash($pwd_unhashed, PASSWORD_DEFAULT);

// Insère l'utilisateur dans la base de données
$sql = "INSERT INTO account (J_Username, J_Mdp, J_Mail) 
            VALUES (:login, :password, :email)";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $pwd_hashed);
$stmt->bindParam(':email', $email);
$stmt->execute();
//------------------------------------





//------------------------------------
//  _____                             
// /  ___|                            
// \ `--. _   _  ___ ___ ___  ___ ___ 
//  `--. \ | | |/ __/ __/ _ \/ __/ __|
// /\__/ / |_| | (_| (_|  __/\__ \__ \
// \____/ \__,_|\___\___\___||___/___/
//------------------------------------
header("Location: ../PHP/success.php");
exit();
//------------------------------------

?>