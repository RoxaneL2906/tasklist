<?php
require_once "bdd-crud.php";
session_start();

$afficherErreur = false;
// Si le formulaire est complété
if (isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['password']) && $_POST['password'] != "") {
    // Récupère l'utilisateur avec ces identifiants de connexion
    $user = get_user_by_login($_POST['email'], $_POST['password']);
    // Si l'utilisateur existe bien en base
    if ($user != null) {
        // Sauvegarde de son id en session
        $_SESSION['user_id'] = $user['id'];
        // Sauvegarde du nom pour afficher dans le header
        $_SESSION['user_nom'] = $user['nom'];

        // Redirection vers la liste des taches
        header("Location: /index.php");
    } else {
        // Affichage du message d'erreur si l'utilisateur n'existe pas
        $afficherErreur = true;
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header>
    </header>
    <h1>Connexion</h1>
    <div class="conteneur">
        <?php if ($afficherErreur) : ?>
            <div class="magie">
                <p>Email ou mot de passe incorrect</p>
            </div>
        <?php endif; ?>

        <form method="post" action="/login.php">
            <div class="jisipa">
                <label for="email">Email:</label>
                <input class="remplissage" name="email" type="email" placeholder="Email" />
            </div>
            <div class="jisipa">
                <label for="password">Mot de passe:</label>
                <input class="remplissage" name="password" type="password" placeholder="Mot de passe" />
            </div>
            <input class="clic" type="submit" value="Se connecter">
        </form>

    </div>
    <a href="inscription.php">Pas de compte ? S'inscrire</a>
</body>

</html>