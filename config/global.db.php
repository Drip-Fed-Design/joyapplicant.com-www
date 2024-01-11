<?
// Use environment variables for credentials
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_DATABASE'];
$dbUser = $_ENV['DB_USERNAME'];
$dbPass = $_ENV['DB_PASSWORD'];


// Set up DSN (Data Source Name)
$dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";

// Set options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Establish connection
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    throw new Exception("Connection to the database failed: " . $e->getMessage());
}

// Return or store the connection instance
return $pdo;
