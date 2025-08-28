<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id>0){
  $st=$conn->prepare("SELECT image FROM certificates WHERE id=?");
  $st->bind_param('i',$id); $st->execute();
  $img=$st->get_result()->fetch_assoc()['image'] ?? '';
  if($img){
    $path=__DIR__ . '/../../assets/img/certificates/' . $img;
    if(is_file($path)) @unlink($path);
  }
  $st=$conn->prepare("DELETE FROM certificates WHERE id=?");
  $st->bind_param('i',$id); $st->execute();
}
header('Location: index.php'); exit;
