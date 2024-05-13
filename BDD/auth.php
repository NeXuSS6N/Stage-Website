<?php
session_start();

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
    $msg = "Méthode POSt attendue. Reçu :" . $_SERVER["REQUEST_METHOD"];
    header("Location: error.php?msg=" . $msg);
    exit();
}

// Récupère les valeurs du formulaire
$login = isset($_POST['login']) ? $_POST['login'] : "";
$pwd_unhashed = isset($_POST['password']) ? $_POST['password'] : "";





//------------------------------------  
//  _____ _               _      _____                    
// /  __ \ |             | |    |  ___|                   
// | /  \/ |__   ___  ___| | __ | |__ _ __ _ __ ___  _ __ 
// | |   | '_ \ / _ \/ __| |/ / |  __| '__| '__/ _ \| '__|
// | \__/\ | | |  __/ (__|   <  | |__| |  | | | (_) | |   
//  \____/_| |_|\___|\___|_|\_\ \____/_|  |_|  \___/|_|   
//------------------------------------                    

// Vérifie si les champs requis ne sont pas vides
if (
    $login == "" ||
    $pwd_unhashed == ""
) {
    $msg = "Une des valeurs est vide :" . "<br>";
    $msg = $msg . " - Login -> " . $login . "<br>";
    $msg = $msg . " - Password -> " . $pwd_unhashed . "<br>";
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
$dbname = 'lolstats';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo_conn = new PDO($dsn, $user, $password, $options);

} catch (PDOException $e) {
    $msg = $e->getMessage();
    header("Location: error.php?msg=" . $msg);
    die("Connection failed: " . $e->getMessage() . ' <br> Wtih error n° ' . (int) $e->getCode());
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
$msg = "";

$sql = "SELECT *
            FROM account
            WHERE J_Username = :login";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    $pwd_hashed = $row["J_Mdp"];


    // Vérifie si le mot de passe est correct
    // if (password_verify($pwd_unhashed, $pwd_hashed)) {
    if ($pwd_unhashed === $pwd_hashed) {

        //------------------------------------
        //  _____      _     _____ _____ _____ _____ _____ _____ _   _ 
        // /  ___|    | |   /  ___|  ___/  ___/  ___|_   _|  _  | \ | |
        // \ `--.  ___| |_  \ `--.| |__ \ `--.\ `--.  | | | | | |  \| |
        //  `--. \/ _ \ __|  `--. \  __| `--. \`--. \ | | | | | | . ` |
        // /\__/ /  __/ |_  /\__/ / |___/\__/ /\__/ /_| |_\ \_/ / |\  |
        // \____/ \___|\__| \____/\____/\____/\____/ \___/ \___/\_| \_/
        //------------------------------------
        $_SESSION['user'] = $login;
        $_SESSION['LoggedIn'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['Id'] = $row['J_Id'];

        //------------------------------------
    } else {
        $msg = $msg . "Le mot de passe est incorrect.";
    }

} else {
    $msg = "Login doesn't exists or is duplicate.";
}
//------------------------------------
// ______         _ _               _   
// | ___ \       | (_)             | |  
// | |_/ /___  __| |_ _ __ ___  ___| |_ 
// |    // _ \/ _` | | '__/ _ \/ __| __|
// | |\ \  __/ (_| | | | |  __/ (__| |_ 
// \_| \_\___|\__,_|_|_|  \___|\___|\__|
//------------------------------------     
// Redirige vers la page d'erreur si un message d'erreur est présent        
if ($msg != "") {
    header("Location: error.php?msg=" . $msg);
    exit();
} else {
    header("Location: ../PHP/login.php");
}
//------------------------------------

?>