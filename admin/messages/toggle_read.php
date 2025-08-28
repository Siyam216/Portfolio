<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';

$id = (int)($_GET['id'] ?? 0);
$read = (int)($_GET['read'] ?? 1);
if($id>0){
  $st=$conn->prepare("UPDATE messages SET is_read=? WHERE id=?");
  $st->bind_param('ii', $read, $id);
  $st->execute();
}
header('Location: index.php');
exit;
