<?php
require_once "bdd-crud.php";
session_start();

$user = null;
$taches = [];
if (isset($_SESSION['user_id'])) {
    // Afficher la liste des tâches de l'utilisateur connecté
    $taches = get_all_task_for_user();
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /login.php");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les taches</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <div class="align">
            <img class="logo" src="online.png" alt="">
            <p class="co"><?php echo $_SESSION['user_nom']; ?> </p>
        </div>
        <a href="logout.php">Logout</a>
    </header>
    <h1>Liste des taches</h1>
    <?php if (count($taches) == 0): ?>
        <p> Aucune tache en cours </p>
    <?php endif; ?>
    <a href="add-task.php">Ajouter une tache</a>

    <?php if (count($taches) > 0): ?>
        <table class="tasks">
            <thead>
                <th>Nom</th>
                <th>Valider</th>
                <th>Supprimer</th>
            </thead>
            <!-- TODO Afficher la liste des tâches de l'utilisateur connecté -->
            <tbody>
                <?php foreach ($taches as $tache): ?>
                    <tr>
                        <td>
                            <a class="lienTache" href="show-task.php?taskId=<?php echo $tache['id'] ?>"><?php echo $tache['name'] ?></a>
                        </td>
                        <td>
                            <!-- TODO Ajouter dans la page de détail un bouton pour valider la tache -->
                            <input id="checkbox-<?php echo $tache['id'] ?>" class="valid" type="checkbox" <?php if ($tache['checked']) {
                                                                                                                echo 'checked';
                                                                                                            } ?> />
                        </td>
                        <td>
                            <!-- Ajout de l'id pour l'avoir au moment du clic sur la corbeille -->
                            <img id="corbeille-<?php echo $tache['id'] ?>" class="corbeille" src="corbeille.png">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <script>
        // Liste de toutes les corbeilles
        const corbeilles = document.querySelectorAll(".corbeille");

        // Ajouter la fonction sur toutes les corbeilles
        for (const corbeille of corbeilles) {
            // Ajout d'une fontion au clic sur une corbeille
            corbeille.addEventListener("click", (event) => {
                // On récupère l'id de la corbeille et extrait l'id de la tache
                const corbeilleId = event.target.id;
                const taskId = corbeilleId.split('-').pop();
                if (confirm("Confirmer suppression de cette tache") == true) {
                    // Ouverture de la page delete-task avec l'id à supprimer
                    window.location.href = 'delete-task.php?taskId=' + taskId;
                }
            });
        }

        // Liste de toutes les checkboxes
        const checkboxes = document.querySelectorAll(".valid");

        // Ajouter la fonction sur toutes les checkboxes
        for (const checkbox of checkboxes) {
            // Ajout d'une fontion au changement d'une checkbox
            checkbox.addEventListener("change", (event) => {
                // On récupère l'id de la checkbox et extrait l'id de la tache
                const checkboxId = event.target.id;
                const taskId = checkboxId.split('-').pop();
                const checked = event.target.checked;

                window.location.href = 'validate-task.php?taskId=' + taskId + '&checked=' + checked;

            });
        }
    </script>
</body>

</html>