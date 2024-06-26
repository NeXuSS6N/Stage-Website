<?php
// session_start();
?>

<?php if ((isset($_SESSION["LoggedIn"]) === false) || (($_SESSION['Id']) != 999)) {
  echo $_SESSION['Id'];
  header("Location: ./accueil.php");
  exit;
}
?>

<?php

require_once "../BDD/DB_Conn.php";


$sqlQuery = "SELECT * FROM account";


$resultat = mysqli_query($conn, $sqlQuery);

foreach ($resultat as $resultats) {
  ?>
  <link rel="icon" type="image/x-icon" href="../assets/Dirisiico.png" />

  <div class="user-content">
    <br>
    <!-- Formulaire pour modifier les informations de l'utilisateur -->
    <form method="post" action="../CRUD/update_user.php">
      <input type="hidden" name="user_id" value="<?php echo $resultats['J_Id'] ?>">
      <input type="text" name="new_username" placeholder="<?php echo $resultats['J_Username'] ?>">
      <br>
      <input type="email" name="new_email" placeholder="<?php echo $resultats['J_Mail'] ?>">
      <br>
      <input type="password" name="new_password" placeholder="<?php echo $resultats['J_Mdp'] ?>">
      <br>
      <button type="submit">Modifier</button>
    </form>
    <!-- Formulaire pour supprimer l'utilisateur -->
    <form method="post" action="../CRUD/delete_user.php">
      <input type="hidden" name="user_id" value="<?php echo $resultats['J_Id'] ?>">
      <button type="submit">Supprimer</button>
    </form>
  </div>
  <?php
}
?>
<div class="add-user">
  <!-- Formulaire pour ajouter un nouvel utilisateur -->
  <br>
  <br>
  <form method="post" action="../CRUD/add_user.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur">
    <input type="email" name="email" placeholder="Adresse mail">
    <input type="password" name="password" placeholder="Mot de passe">
    <br>
    <button type="submit">Ajouter utilisateur</button>
    <br>
  </form>
</div>