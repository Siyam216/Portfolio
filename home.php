<?php
// Home page for Siyam Khan — vanilla PHP + HTML
?>
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
        <a href="projects.php">Projects</a>
        <a href="certificates.php">Certificates</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main -->
  <main class="container">
    <!-- Hero Card -->
    <section class="hero-card">
      <div class="hero-left">
        <div class="avatar-wrap">
          <!-- Replace with your real image path when ready -->
          <img src="assets/img/siyam.jpg" alt="Photo of Siyam Khan" />
        </div>
      </div>
      <div class="hero-right">
        <p class="badge">Portfolio</p>
        <h1 class="name">Siyam Khan</h1>
        <p class="tagline">Software Developer • Web & PHP • JavaScript</p>
        <p class="bio">
          I’m a passionate developer who loves building clean, usable web experiences.
          I work with PHP, JavaScript, HTML/CSS and I’m exploring databases to power
          dynamic projects. I enjoy learning in public and turning ideas into products.
        </p>

        <div class="cta-row">
          <a class="btn primary" href="projects.php">See Projects</a>
          <a class="btn ghost" href="contact.php">Get in Touch</a>
        </div>

        <div class="socials">
          <!-- Put your links later -->
          <a href="#" aria-label="GitHub" title="GitHub">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M12 .5a12 12 0 0 0-3.79 23.4c.6.11.82-.26.82-.57 0-.28-.01-1.02-.02-2-3.34.73-4.04-1.61-4.04-1.61-.55-1.4-1.33-1.77-1.33-1.77-1.09-.75.08-.74.08-.74 1.21.09 1.85 1.24 1.85 1.24 1.07 1.84 2.8 1.31 3.48 1 .11-.77.42-1.31.76-1.61-2.67-.31-5.47-1.34-5.47-5.95 0-1.32.47-2.39 1.24-3.23-.12-.31-.54-1.57.12-3.27 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 6 0c2.29-1.55 3.3-1.23 3.3-1.23.66 1.7.24 2.96.12 3.27.77.84 1.24 1.91 1.24 3.23 0 4.62-2.81 5.63-5.49 5.93.43.37.81 1.1.81 2.23 0 1.61-.02 2.9-.02 3.29 0 .31.22.69.83.57A12 12 0 0 0 12 .5Z"/>
            </svg>
          </a>
          <a href="#" aria-label="LinkedIn" title="LinkedIn">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.2h.05c.53-1 1.82-2.2 3.75-2.2 4.01 0 4.75 2.64 4.75 6.08V24h-4v-7.1c0-1.69-.03-3.86-2.35-3.86-2.36 0-2.72 1.84-2.72 3.74V24h-4V8z"/>
            </svg>
          </a>
          <a href="#" aria-label="Email" title="Email">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M12 13 0 6V4l12 7L24 4v2z"/><path d="M0 6v14h24V6l-12 7z"/>
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- Highlights -->
    <section class="grid">
      <article class="card">
        <h2>Skills</h2>
        <p>PHP, JavaScript, HTML, CSS, MySQL (soon), Responsive UI, Basic CRUD.</p>
      </article>
      <article class="card">
        <h2>Focus</h2>
        <p>Clean code, fast pages, simple UX, and building a dynamic project section.</p>
      </article>
      <article class="card">
        <h2>Next</h2>
        <p>Connect MySQL to manage projects & certificates via an admin panel.</p>
      </article>
    </section>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <p>© <?php echo date('Y'); ?> Siyam Khan.</p>
    </div>
  </footer>

  <script src="js/app.js"></script>
</body>
</html>
