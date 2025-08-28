<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Education — Siyam Khan</title>
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
        <a href="about.php">About</a>
        <a href="education.php" class="active">Education</a>
        <a href="projects.php">Projects</a>
        <a href="certificates.php">Certificates</a>
        <a href="contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="edu-card">
      <h1>Education</h1>
      <p class="edu-intro">
        A snapshot of my academic journey—from school foundations to university engineering studies.
      </p>

      <div class="edu-timeline">
        <!-- Item 1 -->
        <!-- Item 3 -->
        <article class="edu-item">
          <div class="edu-dot"></div>
          <div class="edu-logo">
            <!-- Put your file here: assets/img/edu/kuet.png -->
            <img src="assets/img/edu/kuet.png" alt="Khulna University of Engineering & Technology (KUET) logo">
          </div>
          <div class="edu-body">
            <h2 class="edu-title">Khulna University of Engineering & Technology (KUET)</h2>
            <p class="edu-meta">BSc in Computer Science & Engineering |
              CGPA (first 4 semesters): <strong>3.39</strong>/4.00
            </p>
            <p class="edu-desc">
              Core CS foundation, algorithms, and software development. Parallel focus on competitive programming and web projects.
            </p>
          </div>
        </article>

        <!-- Item 2 -->
        <article class="edu-item">
          <div class="edu-dot"></div>
          <div class="edu-logo">
            <!-- Put your file here: assets/img/edu/brahmanbaria.png -->
            <img src="assets/img/edu/brahmanbaria.png" alt="Brahmanbaria Govt. College logo">
          </div>
          <div class="edu-body">
            <h2 class="edu-title">Brahmanbaria Govt. College</h2>
            <p class="edu-meta">College | GPA: <strong>5.00</strong>/5.00</p>
            <p class="edu-desc">
              Higher Secondary studies with consistent academic performance and active participation in competitive exams.
            </p>
          </div>
        </article>

        
        
        <article class="edu-item">
          <div class="edu-dot"></div>
          <div class="edu-logo">
            <!-- Put your file here: assets/img/edu/shyamagram.png -->
            <img src="assets/img/edu/shyamagram.png" alt="Shyamagram Mohinikishore School & College logo">
          </div>
          <div class="edu-body">
            <h2 class="edu-title">Shyamagram Mohinikishore School & College</h2>
            <p class="edu-meta">School | GPA: <strong>5.00</strong>/5.00</p>
            <p class="edu-desc">
              A strong focus on fundamentals—mathematics, science, and discipline—that shaped my problem-solving mindset.
            </p>
          </div>
        </article>

      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>© <?php echo date('Y'); ?> Siyam Khan.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
