<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$error = '';
$redirect = $_GET['redirect'] ?? 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  if ($username !== '' && $password !== '') {
    $stmt = $conn->prepare('SELECT id, password_hash FROM admins WHERE username=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row && password_verify($password, $row['password_hash'])) {
      $_SESSION['admin_id'] = (int)$row['id'];
      $_SESSION['admin_name'] = $username;
      header("Location: $redirect");
      exit;
    } else {
      $error = 'Invalid username or password.';
    }
  } else {
    $error = 'Please enter username and password.';
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="is-dark">
  <main class="container">
    <section class="about-card" style="max-width:480px">
      <h1>Admin Login</h1>
      <?php if($error): ?><p style="color:#fca5a5"><?= htmlspecialchars($error) ?></p><?php endif; ?>
      <form method="post" style="display:grid;gap:.6rem">
        <input name="username" placeholder="Username" required
               style="padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
        <input name="password" type="password" placeholder="Password" required
               style="padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
        <button class="btn primary" type="submit">Sign in</button>
      </form>
    </section>
  </main>
</body>
</html>
