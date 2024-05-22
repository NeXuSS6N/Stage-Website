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
    <h5>
      <?php echo $resultats['J_Username'] ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo $resultats['J_Mail'] ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo $resultats['J_Mdp'] ?>
    </h5>
    <!-- Formulaire pour modifier les informations de l'utilisateur -->
    <form method="post" action="../CRUD/update_user.php">
      <input type="hidden" name="user_id" value="<?php echo $resultats['J_Id'] ?>">
      <input type="text" name="new_username" placeholder="Nouveau nom d'utilisateur">
      <input type="email" name="new_email" placeholder="Nouvelle adresse e-mail">
      <input type="password" name="new_password" placeholder="Nouveau mot de passe">
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
<div class="user-content">
  <!-- Formulaire pour ajouter un nouvel utilisateur -->
  <form method="post" action="../CRUD/add_user.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur">
    <input type="email" name="email" placeholder="Adresse e-mail">
    <input type="password" name="password" placeholder="Mot de passe">
    <button type="submit">Ajouter utilisateur</button>
  </form>
</div>