<?php
session_start();
include_once(__DIR__ . '/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $skills = trim($_POST['skills']);
    $user_id = $_SESSION['user_id'];
    $image_path = '';

    if (isset($_FILES['portfolio_image']) && $_FILES['portfolio_image']['error'] === 0) {
        $upload_dir = __DIR__ . '/uploads/projects/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $filename = uniqid() . '_' . basename($_FILES['portfolio_image']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['portfolio_image']['tmp_name'], $target_file)) {
            $image_path = 'uploads/projects/' . $filename;
        } else {
            $message = 'Error uploading image.';
        }
    }

    if ($title && $description && $skills) {
        $stmt = $conn->prepare("INSERT INTO projects (user_id, title, description, project_image_path, technologies) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $description, $image_path, $skills]);
        $message = 'Portfolio added successfully!';
    } else {
        $message = 'Please fill all required fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Add Portfolio</title>
<style>
/* Reuse styles from previous examples for familiarity */
body { font-family: Arial,sans-serif; background: linear-gradient(135deg,#667eea,#764ba2); margin:0; padding:30px; color:#333; }
.container { max-width: 450px; margin: 0 auto; background: #fff; padding:30px; border-radius:15px; box-shadow:0 6px 15px rgba(0,0,0,0.2);}
h2 {text-align:center;color:#444;margin-bottom:20px;}
label {font-weight:bold;display:block;margin:15px 0 5px;}
input, textarea {width:100%;padding:10px; border-radius:8px; border:2px solid #ccc; outline:none; transition: border-color 0.3s;}
input:focus, textarea:focus {border-color:#667eea;box-shadow: 0 0 8px #667eea;}
button {width:100%;padding:12px;margin-top:25px;background:linear-gradient(45deg,#6a11cb,#2575fc);color:#fff;border:none;border-radius:10px;font-weight:bold;cursor:pointer;transition: background 0.3s, transform 0.3s;}
button:hover {background:linear-gradient(45deg,#2575fc,#6a11cb);transform:scale(1.05);}
.message {text-align:center; margin-top: 15px; color: green; font-weight:bold;}
</style>
</head>
<body>
<div class="container">
  <h2>Add Portfolio</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="title" required>

    <label>Description:</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Skills (comma-separated):</label>
    <input type="text" name="skills" required>

    <label>Portfolio Image:</label>
    <input type="file" name="portfolio_image" accept="image/*" >

    <button type="submit">Add Portfolio</button>
  </form>
  <?php if ($message): ?>
  <p class="message"><?=htmlspecialchars($message)?></p>
  <?php endif; ?>
</div>
</body>
</html>
