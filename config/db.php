<?php
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'portfolio';

$conn = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
  die('DB connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
