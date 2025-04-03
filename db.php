<?php
$host = 'localhost';
$dbname = 'barcode_scanner';
$username = 'root'; // Change to your MySQL username
$password = '10052007bca'; // Change to your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
