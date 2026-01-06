<?php
// Reuse your previous connection logic
$host = 'localhost'; // Use localhost for local PHP -> Docker DB
$port = '8080';      // The port you mapped in Docker
$db   = 'postgres';  // Default database name
$user = 'postgres';  // Default username
$pass = 'example';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";
$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$action = $_GET['action'] ?? '';

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