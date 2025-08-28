<?php
// Run once, then DELETE this file!
require_once __DIR__ . '/../config/db.php';

$username = 'admin';
$newPass  = 'admin123'; // change after first login
$hash = password_hash($newPass, PASSWORD_DEFAULT);

$conn->query("CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$stmt = $conn->prepare("
  INSERT INTO admins (username, password_hash) VALUES (?, ?)
  ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)
");
$stmt->bind_param('ss', $username, $hash);
$stmt->execute();

echo 'Admin reset complete. Now DELETE this file.';
