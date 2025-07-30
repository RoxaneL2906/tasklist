<?php
// TODO Destruction de la session pour déconnecter l'utilisateur et redirection vers la page de connexion

session_start();
// Supprime toutes les variables de la session
session_unset();

// Détruit la session
session_destroy();

// Redirection vers la page de connexion
header("Location: /login.php");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disconnect</title>
</head>

<body>
    <header>
    </header>
</body>

</html>