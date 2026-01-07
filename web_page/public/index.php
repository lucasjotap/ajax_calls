<?php
// Database credentials
$host = 'db';
$dbname = 'blog_db';
$user = 'user';
$password = 'password';
$port = '5432';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

echo "<h1>Database Connection Test</h1>";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    echo "<p>✅ Successfully connected to the database!</p>";

    // 1. Create a table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS test_log (
        id SERIAL PRIMARY KEY,
        log_time TIMESTAMP NOT NULL
    )");
    echo "<p>✅ 'test_logs' table ensured.</p>";

    // 2. Insert the current time
    $stmt = $pdo->prepare("INSERT INTO test_logs (log_time) VALUES (?)");
    $stmt->execute([date('Y-m-d H:i:s')]);
    $lastInsertId = $pdo->lastInsertId();
    echo "<p>✅ Inserted new record with ID: $lastInsertId</p>";

    // 3. Read and display all logs
    echo "<h2>Current Logs:</h2>";
    $stmt = $pdo->query("SELECT * FROM test_logs ORDER BY log_time DESC");
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($logs) > 0) {
        echo "<ul>";
        foreach ($logs as $log) {
            echo "<li>Record ID: " . htmlspecialchars($log['id']) . " - Logged at: " . htmlspecialchars($log['log_time']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No logs found.</p>";
    }

} catch (PDOException $e) {
    // If connection fails, show the error
    echo "<p>❌ Database connection failed: </p>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}