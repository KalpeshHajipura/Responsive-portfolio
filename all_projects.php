<?php
// all_projects.php
session_start();
include_once('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT p.*, u.username FROM user_projects p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>All Projects</title>
<style>
body {
  font-family: Arial, sans-serif;
  background: linear-gradient(135deg,#667eea,#764ba2);
  color: #f0f0f5;
  min-height: 100vh;
  margin: 0;
  padding: 30px;
}
h1 {
  text-align: center;
  margin-bottom: 40px;
}
.project-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 25px;
}
.project-card {
  background: white;
  color: #333;
  border-radius: 15px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  width: 320px;
  padding: 20px;
  box-sizing: border-box;
  transition: transform 0.25s ease;
  display: flex;
  flex-direction: column;
}
.project-card:hover {
  transform: scale(1.05);
}
.project-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 12px;
  margin-bottom: 15px;
  cursor: pointer;
}
.project-card h3 {
  margin: 0 0 12px;
  color: #222;
}
.project-card p {
  font-size: 0.95em;
  margin: 6px 0;
  white-space: pre-wrap;
}
.project-card a {
  margin-top: auto;
  color: #2575fc;
  text-decoration: none;
  font-weight: bold;
  word-break: break-word;
}
.project-card a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<h1>All Projects</h1>

<div class="project-list">
<?php if (count($projects) === 0): ?>
  <p style="color:#f8f8f8; width:100%; text-align:center;">No projects found.</p>
<?php else: ?>
  <?php foreach ($projects as $p): ?>
    <div class="project-card">
      <?php if (!empty($p['project_image'])): ?>
        <img src="<?=htmlspecialchars($p['project_image'])?>" alt="Project: <?=htmlspecialchars($p['project_title'])?>">
      <?php endif; ?>
      <h3><?=htmlspecialchars($p['project_title'])?></h3>
      <p><strong>User:</strong> <?=htmlspecialchars($p['username'])?></p>
      <p><strong>Description:</strong><br><?=nl2br(htmlspecialchars($p['project_description']))?></p>
      <p><strong>Technologies:</strong> <?=htmlspecialchars($p['project_technologies'])?></p>
      <?php if (!empty($p['project_link'])): ?>
        <a href="<?=htmlspecialchars($p['project_link'])?>" target="_blank" rel="noopener noreferrer">Project Link</a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</div>

</body>
</html>
