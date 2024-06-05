<?php
//------------------------------------
//  _____      _ _    ____________ 
// |_   _|    (_) |   |  _  \ ___ \
//   | | _ __  _| |_  | | | | |_/ /
//   | || '_ \| | __| | | | | ___ \
//  _| || | | | | |_  | |/ /| |_/ /
//  \___/_| |_|_|\__| |___/ \____/ 
//------------------------------------
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'bdd stage';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("La connexion à échoué");
}