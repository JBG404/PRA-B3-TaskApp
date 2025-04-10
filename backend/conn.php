<?php

//Haal de configuratie op
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Test query to ensure connection works
    $conn->query("SELECT 1");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
