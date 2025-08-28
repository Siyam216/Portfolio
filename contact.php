<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/config.php';

$ok = '';
$err = '';

/* CSRF token */
if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token  = $_POST['_csrf'] ?? '';
  $hp     = trim($_POST['website'] ?? '');            // honeypot (should be empty)
  $name   = trim($_POST['name'] ?? '');
  $email  = trim($_POST['email'] ?? '');
  $subject= trim($_POST['subject'] ?? '');
  $message= trim($_POST['message'] ?? '');

  if (!hash_equals($_SESSION['csrf'], $token)) {
    $err = 'Invalid form token. Please try again.';
  } elseif ($hp !== '') {
    $err = 'Spam detected.';
  } elseif ($name === '' || $email === '' || $message === '') {
    $err = 'Name, email, and message are required.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err = 'Please provide a valid email address.';
  } else {
    $st = $conn->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)");
    $st->bind_param('ssss', $name, $email, $subject, $message);
    if ($st->execute()) {
      $ok = 'Thanks! Your message has been sent.';
      // refresh token so resubmits require new one
      $_SESSION['csrf'] = bin2hex(random_bytes(16));
    } else {
      $err = 'Something went wrong. Please try again.';
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Contact — <?= SITE_NAME ?></title>
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
      <a href="projects.php">Projects</a>
      <a href="certificates.php">Certificates</a>
      <a class="active" href="contact.php">Contact</a>
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
  <section class="contact-hero">
    <h1>Contact</h1>
    <p>Have a question, project idea, or opportunity? Send a message—I'll get back to you.</p>
  </section>

  <section class="contact-card">
    <?php if ($ok): ?>
      <div class="alert success"><?= htmlspecialchars($ok) ?></div>
    <?php elseif ($err): ?>
      <div class="alert error"><?= htmlspecialchars($err) ?></div>
    <?php endif; ?>

    <form method="post" class="contact-form" novalidate>
      <input type="hidden" name="_csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
      <!-- Honeypot (keep hidden) -->
      <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;top:-9999px" aria-hidden="true">

      <div class="form-row">
        <label>
          <span>Name</span>
          <input name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        </label>

        <label>
          <span>Email</span>
          <input name="email" type="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </label>
      </div>

      <label>
        <span>Subject (optional)</span>
        <input name="subject" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
      </label>

      <label>
        <span>Message</span>
        <textarea name="message" rows="6" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
      </label>

      <div class="actions">
        <button class="btn primary" type="submit">Send Message</button>
      </div>
    </form>
  </section>
</main>

<script src="js/app.js"></script>
</body>
</html>
