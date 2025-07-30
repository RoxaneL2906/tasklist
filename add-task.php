<?php
require_once "bdd-crud.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
}

$taskId = null;

if (
    isset($_POST['name']) && $_POST['name'] != "" &&
    isset($_POST['description']) &&
    isset($_SESSION['user_id']) && $_SESSION['user_id'] != null
) {
    $taskId = add_task($_POST['name'], $_POST['description']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add-task.css">
</head>

<body>
    <header>
        <div class="align">
            <img class="logo" src="online.png" alt="">
            <p class="co"><?php echo $_SESSION['user_nom']; ?> </p>
        </div>
        <a href="logout.php">Logout</a>
    </header>
    <h1>Ajouter une tache</h1>

    <div class="conteneur">
        <?php if ($taskId != null): ?>
            <div class="magie">
                <p>Tache <span> " <?php echo $_POST['name']; ?> " </span> ajoutée !</p>
                <p> Voulez-vous en ajouter une autre? </p>
            </div>
        <?php endif; ?>

        <form method="post" action="/add-task.php">
            <div class="jisipa">
                <label for="name">Titre de la tache:</label>
                <input class="remplissage" name="name" type="text" placeholder="Titre" />
            </div>
            <div class="jisipa">
                <label for="description">Description (optionnel):</label>
                <input class="remplissage" name="description" type="text" placeholder="Description" />
            </div>
            <input class="clic" type="submit" value="Créer une tache">
        </form>

    </div>
    <a class="direction" href="index.php">Retour à la liste des taches</a>

</body>

</html>