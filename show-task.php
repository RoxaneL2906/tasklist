<?php
require_once "bdd-crud.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
}

// BONUS Afficher les détails d'une tâche spécifique en fonction de son ID passé en $_GET

$task = null;
if (isset($_GET['taskId']) && isset($_SESSION['user_id'])) {
    // Récupération de la tache par son id et l'id user pour vérifier que la tache appartient à l'utilisateur connecté
    $task = get_task($_GET['taskId']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Task</title>
    <link rel="stylesheet" href="show-task.css">
</head>

<body>
    <header>
        <div class="align">
            <img class="logo" src="online.png" alt="">
            <p class="co"><?php echo $_SESSION['user_nom']; ?> </p>
        </div>
        <a href="logout.php">Logout</a>
    </header>


    <?php if ($task == false) : ?>
        <p>Vous n'avez pas accès à cette tache.</p>
    <?php endif; ?>
    <div class="detail">
        <div class="jisipaUn">
            <h3>Titre</h3>
            <p><?php echo $task['name']; ?></p>
        </div>
        <div class="jisipaDeux">
            <h3>Description</h3>
            <?php if ($task['description'] != null): ?>
            <p><?php echo $task['description']; ?></p>
            <?php else :?>
            <p> <em> Pas de description pour cette tache </em> </p>
            <?php endif; ?>
        </div>
    </div>


    <a href="index.php">Retour à la liste des taches</a>
</body>

</html>