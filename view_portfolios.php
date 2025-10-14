<?php
session_start();
include_once('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT p.*, u.username FROM projects p JOIN users u ON p.user_id = u.id ORDER BY p.id DESC");
$stmt->execute();
$portfolios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>All Portfolios</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#667eea,#764ba2);
    color: #f0f0f5;
    padding: 30px;
    min-height: 100vh;
    margin: 0;
}
h1 {
    text-align: center;
    margin-bottom: 40px;
}
.portfolio-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 25px;
}
.portfolio-card {
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
.portfolio-card:hover {
    transform: scale(1.05);
}
.portfolio-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 15px;
    cursor: pointer;
}
.portfolio-card h3 {
    margin: 0 0 12px;
    color: #222;
}
.portfolio-card p {
    font-size: 0.95em;
    margin: 6px 0;
    overflow-wrap: break-word;
    white-space: pre-wrap;
}
.portfolio-card a {
    margin-top: auto;
    color: #2575fc;
    text-decoration: none;
    font-weight: bold;
    word-break: break-word;
}
.portfolio-card a:hover {
    text-decoration: underline;
}

/* Modal styling */
.modal {
  position: fixed;
  z-index: 1000;
  padding-top: 60px;
  left: 0; top: 0; width: 100%; height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.8);
  display: none;
  justify-content: center;
  align-items: center;
}

.modal-content {
  max-width: 90%;
  max-height: 80%;
  border-radius: 10px;
  box-shadow: 0 0 20px black;
}

.close {
  position: absolute;
  top: 30px;
  right: 40px;
  color: white;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
  user-select: none;
  transition: color 0.3s;
}

.close:hover {
  color: #ccc;
}

#caption {
  margin-top: 10px;
  color: #ddd;
  font-size: 14px;
  text-align: center;
}

</style>
</head>
<body>

<h1>All Portfolios</h1>

<div class="portfolio-list">
<?php if (count($portfolios) === 0): ?>
    <p style="color:#f8f8f8; width:100%; text-align:center;">No portfolios found.</p>
<?php else: ?>
    <?php foreach ($portfolios as $p): ?>
        <div class="portfolio-card">
            <?php if (!empty($p['project_image_path'])): ?>
                <img src="<?=htmlspecialchars($p['project_image_path'])?>"
                     alt="Project: <?=htmlspecialchars($p['title'])?>"
                     class="portfolio-image"
                >
            <?php endif; ?>
            <h3><?=htmlspecialchars($p['title'])?></h3>
            <p><strong>User:</strong> <?=htmlspecialchars($p['username'])?></p>
            <p><strong>Description:</strong><br><?=nl2br(htmlspecialchars($p['description']))?></p>
            <p><strong>Technologies:</strong> <?=htmlspecialchars($p['technologies'])?></p>
            <?php if (!empty($p['project_link'])): ?>
                <a href="<?=htmlspecialchars($p['project_link'])?>" target="_blank" rel="noopener noreferrer">View Project</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<!-- Image Modal -->
<div id="imgModal" class="modal" aria-hidden="true" tabindex="-1">
  <span class="close" role="button" aria-label="Close image preview">&times;</span>
  <img class="modal-content" id="modalImg" alt="Full Size Portfolio Image">
  <div id="caption"></div>
</div>

<script>
  const modal = document.getElementById('imgModal');
  const modalImg = document.getElementById('modalImg');
  const caption = document.getElementById('caption');
  const closeBtn = modal.querySelector('.close');

  document.querySelectorAll('.portfolio-image').forEach(img => {
    img.addEventListener('click', () => {
      modal.style.display = 'flex';
      modalImg.src = img.src;
      caption.textContent = img.alt || '';
      modal.setAttribute('aria-hidden', 'false');
      modal.focus();
    });
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden', 'true');
  });

  modal.addEventListener('click', e => {
    if (e.target === modal) {
      modal.style.display = 'none';
      modal.setAttribute('aria-hidden', 'true');
    }
  });

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && modal.style.display === 'flex') {
      modal.style.display = 'none';
      modal.setAttribute('aria-hidden', 'true');
    }
  });
</script>

</body>
</html>
