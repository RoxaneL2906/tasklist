<?php
require_once "bdd-crud.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
}

// TODO Suppréssion d'une tâche en fonction de son ID passé en $_GET
$task = null;
if (isset($_GET['taskId']) && isset($_SESSION['user_id'])) {
    $task = delete_task($_GET['taskId']);
    header("Location: /index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une tache</title>
</head>

<body>
    <header>
    </header>
</body>

</html>