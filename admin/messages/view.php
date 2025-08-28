<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/config.php';

$id = (int)($_GET['id'] ?? 0);
$st = $conn->prepare("SELECT * FROM messages WHERE id=?");
$st->bind_param('i',$id); $st->execute();
$m = $st->get_result()->fetch_assoc();
if(!$m){ header('Location: index.php'); exit; }

if(!$m['is_read']){
  $u=$conn->prepare("UPDATE messages SET is_read=1 WHERE id=?");
  $u->bind_param('i',$id); $u->execute();
}
?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Message #<?= $id ?> — Admin</title>
<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head><body class="is-dark">
<main class="container">
  <section class="about-card" style="max-width:800px">
    <h1 style="margin-top:0">Message</h1>
    <p><strong><?= htmlspecialchars($m['name']) ?></strong> • <a href="mailto:<?= htmlspecialchars($m['email']) ?>"><?= htmlspecialchars($m['email']) ?></a></p>
    <?php if($m['subject']): ?><p class="muted">Subject: <?= htmlspecialchars($m['subject']) ?></p><?php endif; ?>
    <p class="muted">Received: <?= htmlspecialchars($m['created_at']) ?></p>
    <hr style="border:0;border-top:1px solid var(--border);margin:1rem 0">
    <p style="white-space:pre-wrap"><?= htmlspecialchars($m['message']) ?></p>

    <div style="display:flex;gap:.6rem;margin-top:1rem">
      <a class="btn ghost" href="index.php">Back</a>
      <a class="btn ghost" href="delete.php?id=<?= $id ?>" onclick="return confirm('Delete this message?')">Delete</a>
    </div>
  </section>
</main>
</body></html>
