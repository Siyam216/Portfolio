<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Siyam Khan — Portfolio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="is-dark">
  <!-- Navbar -->
  <header class="site-header">
    <div class="container nav">
      <a class="brand" href="home.php">Siyam Khan</a>
      <button class="hamburger" id="hamburger" aria-label="Toggle menu">☰</button>
      <nav id="nav">
        <a href="home.php" class="active">Home</a>
        <a href="about.php">About</a>
        <a href="education.php">Education</a>
        <a href="projects.php">Projects</a>
        <a href="certificates.php">Certificates</a>
        
        <a href="contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main -->
  <main class="container">
    <!-- Hero Card -->
    <section class="hero-card big">
      <div class="hero-left">
        <div class="avatar-wrap">
          <img src="assets/img/siyam.png" alt="Photo of Siyam Khan" />
        </div>
      </div>
      <div class="hero-right">
        <p class="badge">Portfolio</p>
        <h1 class="name">Siyam Khan</h1>
        <p class="tagline">Software Developer • Web & PHP • JavaScript</p>
        <p class="bio">
          I’m a passionate developer who loves building clean, usable web
          experiences. I work with PHP, JavaScript, HTML/CSS and I’m exploring
          databases to power dynamic projects. I enjoy learning in public and
          turning ideas into products.
        </p>

        <div class="cta-row">
          <a class="btn primary" href="projects.php">See Projects</a>
          <a class="btn ghost" href="contact.php">Get in Touch</a>
        </div>

        <div class="socials">
          <!-- GitHub -->
          <a href="https://github.com/Siyam216" target="_blank" title="GitHub">
            <i class="fa-brands fa-github"></i>
          </a>

          <!-- WhatsApp -->
          <a href="https://wa.me/8801647080061" target="_blank" title="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
          </a>

          <!-- Codeforces -->
          <a href="https://codeforces.com/profile/khansiyam216" target="_blank" title="Codeforces">
            <img src="assets/icons/codeforces.png" alt="Codeforces" />
          </a>

          <!-- LeetCode -->
          <a href="https://leetcode.com/u/SIYAM_KHAN/" target="_blank" title="LeetCode">
            <img src="assets/icons/leetcode.png" alt="LeetCode" />
          </a>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <p>© <?php echo date('Y'); ?> Siyam Khan.</p>
    </div>
  </footer>

  <!-- Font Awesome for GitHub + WhatsApp -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
