<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/config.php';
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Projects — <?= SITE_NAME ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="is-dark">
<header class="site-header">
  <div class="container nav">
    <a class="brand" href="home.php"><?= SITE_NAME ?></a>
    <button class="hamburger" id="hamburger" aria-label="Toggle menu">☰</button>
    <nav id="nav">
      <a href="home.php">Home</a>
      <a href="about.php">About</a>
      <a href="education.php">Education</a>
      <a class="active" href="projects.php">Projects</a>
      <a href="certificates.php">Certificates</a>
      
      <a href="contact.php">Contact</a>
      <?php if (!empty($_SESSION['admin_id'])): ?>
        <a class="btn ghost" href="<?= BASE_URL ?>admin/index.php" style="margin-left:1rem">Dashboard</a>
        <a class="btn ghost" href="<?= BASE_URL ?>admin/logout.php">Logout</a>
      <?php else: ?>
        <a class="btn ghost" href="<?= BASE_URL ?>admin/login.php" style="margin-left:1rem">Admin</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<main class="container">
  <h1 class="projects-title">Projects</h1>

  <div class="projects-grid">
    <?php
    $res = $conn->query("SELECT id, title, summary, image, link, tags FROM projects ORDER BY created_at DESC");
    while ($row = $res->fetch_assoc()):
      $tags = array_filter(array_map('trim', explode(',', $row['tags'] ?? '')));
      $img  = !empty($row['image']) ? BASE_URL . 'assets/img/projects/' . htmlspecialchars($row['image']) : null;
    ?>
    <article class="project-card">
      <div class="project-thumb">
        <?php if ($img): ?>
          <img src="<?= $img ?>" alt="<?= htmlspecialchars($row['title']) ?>">
        <?php else: ?>
          <div class="project-thumb--placeholder">No Image</div>
        <?php endif; ?>
      </div>

      <div class="project-body">
        <h3 class="project-title"><?= htmlspecialchars($row['title']) ?></h3>
        <?php if (!empty($row['summary'])): ?>
          <p class="project-summary"><?= nl2br(htmlspecialchars($row['summary'])) ?></p>
        <?php endif; ?>

        <?php if (!empty($tags)): ?>
          <div class="project-tags">
            <?php foreach ($tags as $t): ?>
              <span class="chip"><?= htmlspecialchars($t) ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="project-actions">
          <?php if (!empty($row['link'])): ?>
            <a class="btn ghost small" href="<?= htmlspecialchars($row['link']) ?>" target="_blank" rel="noopener">View</a>
          <?php endif; ?>
        </div>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
</main>

<script src="js/app.js"></script>
</body>
</html>