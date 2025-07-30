<?php
require_once "bdd-crud.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
}

// BONUS Valider une tache dans la BDD et redirection vers la page d'accueil
$task = null;
if (isset($_GET['taskId']) && isset($_GET['checked']) && isset($_SESSION['user_id'])) {

    // Conversion de $_GET['checked'] en booléen pour la fonction
    $checked = false;
    if($_GET['checked'] === 'true') {
        $checked = true;
    }

    $task = validate_task($_GET['taskId'], $checked);
    header("Location: /index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validate Task</title>
</head>

<body>
    <header>
    </header>
</body>

</html>