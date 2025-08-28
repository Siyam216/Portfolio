<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Certificates — <?= SITE_NAME ?></title>
<link rel="stylesheet" href="css/style.css">
</head><body class="is-dark">
<header class="site-header">
  <div class="container nav">
    <a class="brand" href="home.php"><?= SITE_NAME ?></a>
    <button class="hamburger" id="hamburger" aria-label="Toggle menu">☰</button>
    <nav id="nav">
      <a href="home.php">Home</a>
        <a href="about.php">About</a>
      <a href="education.php">Education</a>
      <a href="projects.php">Projects</a>
      <a class="active" href="certificates.php">Certificates</a>
    
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
  <h1 class="projects-title">Certificates</h1>
  <div class="projects-grid">
    <?php
    $res = $conn->query("SELECT title, issuer, issue_date, image, verify_url FROM certificates ORDER BY created_at DESC");
    while($c = $res->fetch_assoc()):
      $img = !empty($c['image']) ? BASE_URL.'assets/img/certificates/'.htmlspecialchars($c['image']) : null;
    ?>
      <article class="project-card">
        <div class="project-thumb">
          <?php if($img): ?><img src="<?= $img ?>" alt="<?= htmlspecialchars($c['title']) ?>">
          <?php else: ?><div class="project-thumb--placeholder">No Image</div><?php endif; ?>
        </div>
        <div class="project-body">
          <h3 class="project-title"><?= htmlspecialchars($c['title']) ?></h3>
          <p class="project-summary">
            <?= htmlspecialchars($c['issuer'] ?: '') ?>
            <?php if(!empty($c['issue_date'])): ?> • <?= htmlspecialchars($c['issue_date']) ?><?php endif; ?>
          </p>
          <div class="project-actions">
            <?php if(!empty($c['verify_url'])): ?>
              <a class="btn ghost small" target="_blank" rel="noopener" href="<?= htmlspecialchars($c['verify_url']) ?>">Verify</a>
            <?php endif; ?>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<script src="js/app.js"></script>
</body></html>
