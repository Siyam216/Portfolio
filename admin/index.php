<?php
require_once __DIR__ . '/_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/config.php';

$res = $conn->query("SELECT id, title, image, link, created_at FROM projects ORDER BY created_at DESC");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin — Projects</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body class="is-dark">
<header class="site-header">
  <div class="container nav">
    <div class="brand">Admin — Projects</div>
    <nav id="nav" style="margin-left:auto;display:flex;gap:.6rem">
      <a class="btn ghost" href="<?= BASE_URL ?>home.php">View Site</a>
      <a class="btn ghost" href="logout.php">Logout (<?= htmlspecialchars($_SESSION['admin_name'] ?? '') ?>)</a>
    </nav>
  </div>
</header>

<main class="container">
  <section class="about-card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:1rem">
      <h1 style="margin:0">Projects</h1>
      <a class="btn primary" href="project_form.php">+ Add Project</a>
    </div>
    <div style="margin-top:1rem;display:grid;gap:.6rem">
      <?php while($row = $res->fetch_assoc()): ?>
      <div class="edu-item">
        <div class="edu-logo">
          <?php if($row['image']): ?>
            <img src="<?= BASE_URL . 'assets/img/projects/' . htmlspecialchars($row['image']) ?>" alt="">
          <?php else: ?>
            <img src="<?= BASE_URL ?>assets/img/projects/placeholder.png" alt="">
          <?php endif; ?>
        </div>
        <div class="edu-body">
          <h2 class="edu-title"><?= htmlspecialchars($row['title']) ?></h2>
          <p class="edu-meta">Created: <?= htmlspecialchars($row['created_at']) ?></p>
          <?php if($row['link']): ?>
            <p><a class="btn ghost" href="<?= htmlspecialchars($row['link']) ?>" target="_blank">Open Link</a></p>
          <?php endif; ?>
          <div style="display:flex;gap:.4rem;margin-top:.4rem">
            <a class="btn primary" href="project_form.php?id=<?= (int)$row['id'] ?>">Edit</a>
            <a class="btn ghost" href="project_delete.php?id=<?= (int)$row['id'] ?>"
               onclick="return confirm('Delete this project?')">Delete</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>
</body>
</html>
