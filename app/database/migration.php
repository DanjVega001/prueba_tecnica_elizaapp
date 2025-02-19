<?php
require_once 'database.php';

$conn = Database::getConnection();

$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(150) NOT NULL,
    completed TINYINT(1) NOT NULL
)";

try {
    $conn->exec($sql);
} catch (PDOException $e) {
    die("Error al crear la tabla: " . $e->getMessage());
}