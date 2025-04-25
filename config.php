<?php
session_start();
$host = 'localhost';
$dbname = 'lume';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function require_auth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function require_admin() {
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        header("HTTP/1.1 403 Forbidden");
        die("Admin access required");
    }
}
?>