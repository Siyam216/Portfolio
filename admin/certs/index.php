<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/config.php';

$res = $conn->query("SELECT * FROM certificates ORDER BY created_at DESC");
?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin — Certificates</title>
<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head><body class="is-dark">
<header class="site-header"><div class="container nav">
  <div class="brand">Admin — Certificates</div>
  <nav id="nav" style="margin-left:auto;display:flex;gap:.6rem">
       <a class="btn ghost" href="<?= BASE_URL ?>home.php" target="_blank" rel="noopener">View Site</a>
        
    <a class="btn ghost" href="<?= BASE_URL ?>admin/index.php">Projects Admin</a>
<a class="btn ghost" href="<?= BASE_URL ?>admin/messages/index.php">Messages</a>    
 


    <a class="btn ghost" href="<?= BASE_URL ?>admin/logout.php">Logout</a>
  </nav>
</div></header>

<main class="container">
  <section class="about-card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:1rem">
      <h1 style="margin:0">Certificates</h1>
      <a class="btn primary" href="form.php">+ Add Certificate</a>
    </div>

    <div class="projects-grid" style="margin-top:1rem">
      <?php while($c = $res->fetch_assoc()): ?>
      <article class="project-card">
        <div class="project-thumb">
          <?php if($c['image']): ?>
            <img src="<?= BASE_URL . 'assets/img/certificates/' . htmlspecialchars($c['image']) ?>" alt="">
          <?php else: ?>
            <div class="project-thumb--placeholder">No Image</div>
          <?php endif; ?>
        </div>
        <div class="project-body">
          <h3 class="project-title"><?= htmlspecialchars($c['title']) ?></h3>
          <p class="project-summary">
            <?= htmlspecialchars($c['issuer'] ?: ''); ?>
            <?php if(!empty($c['issue_date'])): ?> • <?= htmlspecialchars($c['issue_date']) ?><?php endif; ?>
          </p>
          <div class="project-actions">
            <?php if(!empty($c['verify_url'])): ?>
              <a class="btn ghost small" target="_blank" href="<?= htmlspecialchars($c['verify_url']) ?>">Verify</a>
            <?php endif; ?>
            <a class="btn primary small" href="form.php?id=<?= (int)$c['id'] ?>">Edit</a>
            <a class="btn ghost small" href="delete.php?id=<?= (int)$c['id'] ?>" onclick="return confirm('Delete this certificate?')">Delete</a>
          </div>
        </div>
      </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>
</body></html>
