<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config/config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About — Siyam Khan</title>
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
        <a href="home.php">Home</a>
        <a href="about.php" class="active">About</a>
        <a href="education.php">Education</a>
        <a href="projects.php">Projects</a>
        <a href="certificates.php">Certificates</a>
        <a href="contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <!-- About Section -->
  <main class="container">
    <section class="about-card">
      <h1>About Me</h1>
      <p class="intro">
        Hello, I’m <strong>Siyam Khan</strong> — a dedicated competitive programmer and web developer.
        With a strong problem-solving mindset and a passion for building clean, efficient solutions, 
        I enjoy taking on challenges both in coding contests and real-world projects.
      </p>

      <div class="about-grid">
        <article class="about-box">
          <h2>Competitive Programming</h2>
         <p>

    I actively participate on <strong>Codeforces</strong>, where I have achieved a 
  <strong>1400+ rating</strong> and solved over <strong>1400 problems</strong>. 
  Along with Codeforces, I also practice and solve problems on platforms like 
  <strong>LeetCode</strong>, <strong>CSES</strong>, <strong>AtCoder</strong>, and 
  <strong>HackerRank</strong>. Tackling algorithmic challenges across these platforms 
  has helped me sharpen my analytical thinking, optimize solutions, and write 
  clean, efficient, and scalable code.
</p>
        </article>

        <article class="about-box">
          <h2>Web Development</h2>
<p>
  Alongside competitive programming, I’m deeply invested in <strong>web development</strong>.  
  I work with <strong>PHP, JavaScript, HTML, CSS</strong>, and also have experience with 
  <strong>C#</strong>, <strong>Android Studio</strong>, and <strong>AutoCAD</strong>.  
  I build responsive, dynamic applications while focusing on writing maintainable code, 
  crafting intuitive interfaces, and ensuring great user experiences across platforms.
</p>
        </article>

        <article class="about-box">
          <h2>Vision</h2>
<p>
  My goal is to merge my <strong>problem-solving skills</strong> from competitive programming 
  with my expertise in <strong>web development</strong> and passion for 
  <strong>AI and Machine Learning</strong>. I aim to create solutions that are not only 
  technically sound but also innovative and impactful. With a strong belief in 
  <strong>continuous learning</strong>, I constantly explore new algorithms, technologies, 
  and ideas to grow as a developer, programmer, and researcher.
</p>
        </article>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <p>© <?php echo date('Y'); ?> Siyam Khan.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
