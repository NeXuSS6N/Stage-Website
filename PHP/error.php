<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../assets/Dirisiico.png" />
    <link rel="stylesheet" href="../css/error.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <title>Erreur</title>
</head>

<body>
    <p>Une erreur est survenue. Veuillez retourner à la page d'accueil et recommencer.</p>
    <?php
    if (isset($_GET['msg'])) {
        echo "<p>Détail de l'erreur</p>";
        echo "<p>";
        echo $_GET['msg'];
        echo "</p>";
    }
    ?>
</body>

</html>