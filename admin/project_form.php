<?php
require_once __DIR__ . '/_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$editing = $id > 0;

$title = $summary = $link = $tags = $image = '';
if ($editing) {
  $stmt = $conn->prepare("SELECT * FROM projects WHERE id=?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  if ($row) {
    $title = $row['title']; $summary = $row['summary']; $link = $row['link'];
    $tags = $row['tags']; $image = $row['image'];
  }
}

$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title   = trim($_POST['title'] ?? '');
  $summary = trim($_POST['summary'] ?? '');
  $link    = trim($_POST['link'] ?? '');
  $tags    = trim($_POST['tags'] ?? '');

  // Handle image upload (optional)
  $upload_name = $image; // keep old if none uploaded
  if (!empty($_FILES['image']['name'])) {
    $dir = __DIR__ . '/../assets/img/projects/';
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
      $upload_name = 'p_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
      move_uploaded_file($_FILES['image']['tmp_name'], $dir . $upload_name);
    } else {
      $notice = 'Invalid image type.';
    }
  }

  if ($title && !$notice) {
    if ($editing) {
      $stmt = $conn->prepare("UPDATE projects SET title=?, summary=?, image=?, link=?, tags=? WHERE id=?");
      $stmt->bind_param('sssssi', $title, $summary, $upload_name, $link, $tags, $id);
      $stmt->execute();
      header('Location: index.php');
      exit;
    } else {
      $stmt = $conn->prepare("INSERT INTO projects (title, summary, image, link, tags) VALUES (?,?,?,?,?)");
      $stmt->bind_param('sssss', $title, $summary, $upload_name, $link, $tags);
      $stmt->execute();
      header('Location: index.php');
      exit;
    }
  } else if (!$title) {
    $notice = 'Title is required.';
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $editing ? 'Edit' : 'Add' ?> Project — Admin</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body class="is-dark">
<main class="container">
  <section class="about-card" style="max-width:760px">
    <h1 style="margin-top:0"><?= $editing ? 'Edit' : 'Add' ?> Project</h1>
    <?php if($notice): ?><p style="color:#fca5a5"><?= htmlspecialchars($notice) ?></p><?php endif; ?>

    <form method="post" enctype="multipart/form-data" style="display:grid;gap:.8rem">
      <label>Title
        <input name="title" value="<?= htmlspecialchars($title) ?>" required
          style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Summary
        <textarea name="summary" rows="5" style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb"><?= htmlspecialchars($summary) ?></textarea>
      </label>
      <label>Project Link
        <input name="link" value="<?= htmlspecialchars($link) ?>"
          style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Tags (comma separated)
        <input name="tags" value="<?= htmlspecialchars($tags) ?>"
          style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Image (optional)
        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.gif" style="color:#e5e7eb">
        <?php if($image): ?>
          <div style="margin-top:.4rem">
            <img src="<?= BASE_URL . 'assets/img/projects/' . htmlspecialchars($image) ?>" alt="" style="max-width:200px;border-radius:.6rem;border:1px solid var(--border)">
          </div>
        <?php endif; ?>
      </label>

      <div style="display:flex;gap:.6rem">
        <button class="btn primary" type="submit"><?= $editing ? 'Update' : 'Create' ?></button>
        <a class="btn ghost" href="index.php">Cancel</a>
      </div>
    </form>
  </section>
</main>
</body>
</html>
