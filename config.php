<?php
// Database connection
$host = '12.0.0.7';
$db = 'mock_payments';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Sandbox secret key for simulation
define('SANDBOX_SECRET_KEY', 'sk_test_4nZuhM53sis4p3Zh9YVzWTYc');
?>
