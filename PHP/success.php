<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/LoLStatsIco.png" />
    <link rel="stylesheet" href="../css/success.css">
    <title>Utilisateur ajouté avec succès !</title>
</head>

<body>
    <p>L'utilisateur <?= $_GET['email'] ?> a bien été ajouté.</p>
    <p>Détails : </p>
    <p><?= $_GET['msg'] ?></p>

</body>

</html>