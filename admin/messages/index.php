<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/config.php';

$res = $conn->query("SELECT id,name,email,subject,message,is_read,created_at FROM messages ORDER BY created_at DESC");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin — Messages</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body class="is-dark">

<header class="site-header">
  <div class="container nav">
    <div class="brand">Admin — Messages</div>
    <nav id="nav" style="margin-left:auto;display:flex;gap:.6rem">
    <a class="btn ghost" href="<?= BASE_URL ?>home.php" target="_blank" rel="noopener">View Site</a>
      <a class="btn ghost" href="<?= BASE_URL ?>admin/index.php">Projects Admin</a>
      <a class="btn ghost" href="<?= BASE_URL ?>admin/certs/index.php">Certificates Admin</a>
   
      <a class="btn ghost" href="<?= BASE_URL ?>admin/logout.php">Logout</a>
    </nav>
  </div>
</header>

<main class="container">
  <section class="msg-board">
    <div class="msg-board__head">
      <h1>Messages</h1>
      <p class="muted">Inbox of messages sent from your Contact page.</p>
    </div>

    <div class="msg-table">
      <?php while ($m = $res->fetch_assoc()):
        $initials = strtoupper(substr(trim($m['name'] ?: 'U'), 0, 1));
      ?>
      <article class="msg-row <?= $m['is_read'] ? 'is-read' : 'is-unread' ?>" data-row>
        <!-- left: avatar + meta -->
        <div class="msg-left">
          <div class="avatar"><?= htmlspecialchars($initials) ?></div>
          <div class="meta">
            <div class="meta-top">
              <span class="status <?= $m['is_read'] ? 'ok' : 'new' ?>"><?= $m['is_read'] ? 'Read' : 'New' ?></span>
              <strong class="name"><?= htmlspecialchars($m['name'] ?: 'Unknown') ?></strong>
              <a class="email" href="mailto:<?= htmlspecialchars($m['email']) ?>"><?= htmlspecialchars($m['email']) ?></a>
              <span class="time muted">• <?= htmlspecialchars($m['created_at']) ?></span>
            </div>
            <?php if (!empty($m['subject'])): ?>
              <div class="subject">Subject: <span><?= htmlspecialchars($m['subject']) ?></span></div>
            <?php endif; ?>
            <p class="preview" data-preview><?= nl2br(htmlspecialchars($m['message'])) ?></p>

            <div class="row-actions">
              <?php if(!$m['is_read']): ?>
                <a class="btn small ghost" href="toggle_read.php?id=<?= (int)$m['id'] ?>&read=1">Mark as read</a>
              <?php else: ?>
                <a class="btn small ghost" href="toggle_read.php?id=<?= (int)$m['id'] ?>&read=0">Mark as unread</a>
              <?php endif; ?>
              <a class="btn small primary" href="view.php?id=<?= (int)$m['id'] ?>">Open</a>
              <a class="btn small ghost" href="delete.php?id=<?= (int)$m['id'] ?>" onclick="return confirm('Delete this message?')">Delete</a>
              <button class="btn small ghost" type="button" data-toggle>Expand</button>
              <a class="btn small ghost" href="mailto:<?= htmlspecialchars($m['email']) ?>">Reply</a>
            </div>
          </div>
        </div>

        <!-- right: compact actions duplicate (for wide screens) -->
        <div class="msg-right">
          <?php if(!$m['is_read']): ?>
            <a class="btn small ghost" href="toggle_read.php?id=<?= (int)$m['id'] ?>&read=1">Mark read</a>
          <?php else: ?>
            <a class="btn small ghost" href="toggle_read.php?id=<?= (int)$m['id'] ?>&read=0">Mark unread</a>
          <?php endif; ?>
          <a class="btn small primary" href="view.php?id=<?= (int)$m['id'] ?>">Open</a>
          <a class="btn small ghost" href="delete.php?id=<?= (int)$m['id'] ?>" onclick="return confirm('Delete this message?')">Delete</a>
        </div>
      </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<script>
// expand/collapse inline (toggles line clamp)
document.querySelectorAll('[data-toggle]').forEach(btn => {
  btn.addEventListener('click', () => {
    const row = btn.closest('[data-row]');
    const pv  = row.querySelector('[data-preview]');
    const isOpen = row.classList.toggle('open');
    if (pv) pv.style['-webkit-line-clamp'] = isOpen ? 'unset' : '4';
    btn.textContent = isOpen ? 'Collapse' : 'Expand';
  });
});
// also allow clicking the row (except on links/buttons)
document.querySelectorAll('[data-row]').forEach(row => {
  row.addEventListener('click', (e) => {
    const tag = e.target.tagName.toLowerCase();
    if (['a','button'].includes(tag)) return;
    const btn = row.querySelector('[data-toggle]');
    if (btn) btn.click();
  });
});
</script>
</body>
</html>
