<?php
//connexion bdd
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdd stage";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}


$sqlQuery = "SELECT * FROM bdd";
$resultat = $conn->query($sqlQuery);

if ($resultat->num_rows > 0) {
    // Créer un tableau pour stocker les résultats
    $data = array();
    while ($row = $resultat->fetch_assoc()) {
        $data[] = $row;
    }

    // Convertir les données en JSON
    $json_data = json_encode($data, JSON_PRETTY_PRINT);

    // nom du fichier + chemin définis
    $filename = "bdd.json";
    $filepath = __DIR__ . '/' . $filename;

    // Enregistrer les données JSON dans un fichier
    file_put_contents($filepath, $json_data);

    // téléchargement
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename=' . $filename);
    readfile($filepath);

    // Supprimer le fichier après dl
    unlink($filepath);
} else {
    echo "0 résultats";
}
$conn->close();
?>