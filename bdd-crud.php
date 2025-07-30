<?php
session_start();

function connect_database(): PDO
{
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
    return $database;
}

// CRUD User
// Create (signin)
function create_user(string $nom, string $email, string $password): int | null
{
    $database = connect_database();

    // Hash du mot de passe pour ne pas l'enregisrer tel quel en base de données
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // Ajout du nouvel utilisateur dans la base
    $stmt = $database->prepare("INSERT INTO user (nom, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $password_hash]);
    // Récupération du dernier id ajouter dans la base de données
    $user_id = $database->lastInsertId();

    return $user_id;
}
// Read (id)
function get_user(int $id): array | null
{
    $database = connect_database();

    // Recherche l'utilisateur dont l'id est $id
    $stmt = $database->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}
// Read (login)
function get_user_by_login(string $email, string $password): array | null
{
    $database = connect_database();

    // Recherche l'utilisateur dont l'email est $email
    $stmt = $database->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe entre celui écrit et celui hashé enregistré en base
    if (password_verify($password, $user["password"])) {
        return $user;
    } else {
        return null;
    }
}

// CRUD Task
// Create
function add_task(string $name, string $description): int | null
{
    $database = connect_database();

    // Ajout d'une tache dans la base
    $stmt = $database->prepare("INSERT INTO task (name, description, userId) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $_SESSION['user_id']]);
    $task_id = $database->lastInsertId();

    return $task_id;
}

//Read
function get_task(int $id): array | null | false
{
    $database = connect_database();

    // Recherche une tacne dont l'id est $id
    $stmt = $database->prepare("SELECT * FROM task WHERE id = ? AND userId = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    return $task;
}

function get_all_task_for_user(): array | null
{
    $database = connect_database();

    // Recherche toutes les taches de la base
    $stmt = $database->prepare("SELECT * FROM task WHERE userId = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

// Delete (BONUS)
function delete_task(int $id): bool
{
    $database = connect_database();

    // Supprime une tache par son id
    $stmt = $database->prepare("DELETE FROM task WHERE id = ? AND userId = ?");
    $isSuccessful = $stmt->execute([$id, $_SESSION['user_id']]);

    return $isSuccessful;
}

// Validate (BONUS)
function validate_task(int $id, bool $checked): bool
{
    $database = connect_database();

    // Valider une tache par son id
    $stmt = $database->prepare("UPDATE task SET checked = ? WHERE id = ? AND userId = ?");
    // Conversion de $checked en entier pour la base de données
    $isSuccessful = $stmt->execute([$checked ? 1 : 0, $id, $_SESSION['user_id']]);

    return $isSuccessful;
}
