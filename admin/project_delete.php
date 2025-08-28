<?php
require_once __DIR__ . '/_auth.php';
require_once __DIR__ . '/../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
  // Optional: delete image file
  $stmt = $conn->prepare("SELECT image FROM projects WHERE id=?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $img = $stmt->get_result()->fetch_assoc()['image'] ?? '';
  if ($img) {
    $path = __DIR__ . '/../assets/img/projects/' . $img;
    if (is_file($path)) @unlink($path);
  }

  $stmt = $conn->prepare("DELETE FROM projects WHERE id=?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
}
header('Location: index.php');
exit;
