<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';

$id = (int)($_GET['id'] ?? 0);
if($id>0){
  $st=$conn->prepare("DELETE FROM messages WHERE id=?");
  $st->bind_param('i',$id);
  $st->execute();
}
header('Location: index.php');
exit;
