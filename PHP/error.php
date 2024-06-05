<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ruben Pénalvez">

    <link rel="icon" type="image/x-icon" href="../assets/Dirisiico.png" />
    <link rel="stylesheet" href="../css/error.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <title>Erreur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <button class="btn" onclick="window.location.href = './index.php';"><i class="fas fa-times-circle"></i></button>
</body>

</html>