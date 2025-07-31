<?php
require_once "bdd-crud.php";

$userId = null;

if (
    isset($_POST['nom']) && $_POST['nom'] != "" &&
    isset($_POST['email']) && $_POST['email'] != "" &&
    isset($_POST['password']) && $_POST['password'] != "" &&
    isset($_POST['confirm_password']) && $_POST['confirm_password'] != ""
) {
    // Vérification que les mots de passe correspondent
    if ($_POST['password'] == $_POST['confirm_password']) {
        $userId = create_user($_POST['nom'], $_POST['email'], $_POST['password']);

        // Redirection vers l'accueil si le compte a été créé
        if ($userId != null) {
            header("Location: /index.php");
        }
    } else {
        $afficherErreur = true;
    }
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
</head>

<body>
    <header>
    </header>
    <h1>Création de compte</h1>
    <div class="conteneur">
        <?php if ($afficherErreur) : ?>
            <div class="magie">
                <p>Les mots de passe ne correspondent pas</p>
            </div>
        <?php endif; ?>
        <form method="post" action="/inscription.php">
             <div class="jisipa">
                <label for="nom">Nom d'utilisateur</label>
                <input class="remplissage" name="nom" type="text" placeholder="Nom" />
            </div>
            <div class="jisipa">
                <label for="email">Email:</label>
                <input class="remplissage" name="email" type="email" placeholder="Email" />
            </div>
            <div class="jisipa">
                <label for="password">Mot de passe:</label>
                <input class="remplissage" name="password" type="password" placeholder="Mot de passe" />
            </div>
              <div class="jisipa">
                <label for="confirm_password">Confirmer le mot de passe:</label>
                <input class="remplissage" name="confirm_password" type="password" placeholder="Confirmer mot de passe" />
            </div>

            <input class="clic" type="submit" value="Créer le compte">
        </form>
    </div>
</body>

</html>