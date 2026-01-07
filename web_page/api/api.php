<?php
// Reuse your previous connection logic
$host = 'db'; // Use localhost for local PHP -> Docker DB
$port = '5432';      // The port you mapped in Docker
$db   = 'blog_db';  // Default database name
$user = 'user';  // Default username
$pass = 'password';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";
$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$action = $_GET['action'] ?? '';


// First create table if not exists

// Create table
$stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);");


$stmt->execute();
echo json_encode(['status' => 'success']);

// READ
if ($action == 'read') {
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// CREATE
if ($action == 'create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email']]);
    echo json_encode(['status' => 'success']);
}

// DELETE
if ($action == 'delete') {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    echo json_encode(['status' => 'deleted']);
}
?>