<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$editing = $id>0;
$title=$issuer=$issue_date=$verify_url=$image='';

if($editing){
  $st=$conn->prepare("SELECT * FROM certificates WHERE id=?");
  $st->bind_param('i',$id); $st->execute();
  if($row=$st->get_result()->fetch_assoc()){
    $title=$row['title']; $issuer=$row['issuer']; $issue_date=$row['issue_date'];
    $verify_url=$row['verify_url']; $image=$row['image'];
  }
}

$notice='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $title=trim($_POST['title']??'');
  $issuer=trim($_POST['issuer']??'');
  $issue_date=trim($_POST['issue_date']??'');
  $verify_url=trim($_POST['verify_url']??'');

  $upload=$image;
  if(!empty($_FILES['image']['name'])){
    $dir=__DIR__ . '/../../assets/img/certificates/';
    if(!is_dir($dir)) mkdir($dir,0777,true);
    $ext=strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if(in_array($ext,['jpg','jpeg','png','webp','gif'])){
      $upload='c_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
      move_uploaded_file($_FILES['image']['tmp_name'], $dir.$upload);
    } else { $notice='Invalid image type.'; }
  }

  if($title && !$notice){
    if($editing){
      $st=$conn->prepare("UPDATE certificates SET title=?, issuer=?, issue_date=?, image=?, verify_url=? WHERE id=?");
      $st->bind_param('sssssi',$title,$issuer,$issue_date,$upload,$verify_url,$id);
      $st->execute();
    }else{
      $st=$conn->prepare("INSERT INTO certificates (title,issuer,issue_date,image,verify_url) VALUES (?,?,?,?,?)");
      $st->bind_param('sssss',$title,$issuer,$issue_date,$upload,$verify_url);
      $st->execute();
    }
    header('Location: index.php'); exit;
  } elseif(!$title){ $notice='Title is required.'; }
}
?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $editing?'Edit':'Add' ?> Certificate — Admin</title>
<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head><body class="is-dark">
<main class="container">
  <section class="about-card" style="max-width:760px">
    <h1 style="margin-top:0"><?= $editing?'Edit':'Add' ?> Certificate</h1>
    <?php if($notice): ?><p style="color:#fca5a5"><?= htmlspecialchars($notice) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data" style="display:grid;gap:.8rem">
      <label>Title
        <input name="title" value="<?= htmlspecialchars($title) ?>" required
         style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Issuer
        <input name="issuer" value="<?= htmlspecialchars($issuer) ?>"
         style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Issue Date
        <input type="date" name="issue_date" value="<?= htmlspecialchars($issue_date) ?>"
         style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Verify URL
        <input name="verify_url" value="<?= htmlspecialchars($verify_url) ?>"
         style="width:100%;padding:.7rem;border-radius:.6rem;border:1px solid var(--border);background:#111827;color:#e5e7eb">
      </label>
      <label>Image (optional)
        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.gif" style="color:#e5e7eb">
        <?php if($image): ?>
          <div style="margin-top:.4rem">
            <img src="<?= BASE_URL . 'assets/img/certificates/' . htmlspecialchars($image) ?>" alt="" style="max-width:220px;border-radius:.6rem;border:1px solid var(--border)">
          </div>
        <?php endif; ?>
      </label>

      <div style="display:flex;gap:.6rem">
        <button class="btn primary" type="submit"><?= $editing?'Update':'Create' ?></button>
        <a class="btn ghost" href="index.php">Cancel</a>
      </div>
    </form>
  </section>
</main>
</body></html>
