<?php
/*
 Sets up the PDO database connection
 */

// Connection details for EasyPHP local server
$connString = "mysql:host=localhost;dbname=bookcrm";
$user = "bookrep";
$password = "book@rep20";

try {
    // Create PDO connection
    $pdo = new PDO($connString, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
