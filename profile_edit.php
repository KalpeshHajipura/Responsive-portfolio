<?php
session_start();
include_once(__DIR__ . '/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bio = trim($_POST['bio']);
    $image_path = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $upload_dir = __DIR__ . '/uploads/profiles/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $filename = uniqid() . '_' . basename($_FILES['profile_image']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $image_path = 'uploads/profiles/' . $filename;
        } else {
            $message = 'Error uploading image.';
        }
    }

    if ($image_path) {
        $stmt = $conn->prepare("UPDATE users SET bio=?, profile_image_path=? WHERE id=?");
        $stmt->execute([$bio, $image_path, $user_id]);
    } else {
        $stmt = $conn->prepare("UPDATE users SET bio=? WHERE id=?");
        $stmt->execute([$bio, $user_id]);
    }
    $message = 'Profile updated successfully!';
}

// Fetch current bio and image
$stmt = $conn->prepare("SELECT bio, profile_image_path FROM users WHERE id=?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Edit Profile</title>
<style>
body { font-family: Arial,sans-serif; background: linear-gradient(135deg,#667eea,#764ba2); margin:0; padding:30px; color:#333; }
.container { max-width: 450px; margin: 0 auto; background: #fff; padding:30px; border-radius:15px; box-shadow:0 6px 15px rgba(0,0,0,0.2);}
h2 {text-align:center;color:#444;margin-bottom:20px;}
label {font-weight:bold;display:block;margin:15px 0 5px;}
textarea, input[type="file"] {width:100%;padding:10px; border-radius:8px; border:2px solid #ccc; outline:none; transition: border-color 0.3s;}
textarea:focus, input[type="file"]:focus {border-color:#667eea;box-shadow: 0 0 8px #667eea;}
button {width:100%;padding:12px;margin-top:25px;background:linear-gradient(45deg,#6a11cb,#2575fc);color:#fff;border:none;border-radius:10px;font-weight:bold;cursor:pointer;transition: background 0.3s, transform 0.3s;}
button:hover {background:linear-gradient(45deg,#2575fc,#6a11cb);transform:scale(1.05);}
.message {text-align:center; margin-top: 15px; color: green; font-weight:bold;}
img { max-width: 150px; border-radius: 10px; display: block; margin-bottom: 15px; }
</style>
</head>
<body>
<div class="container">
  <h2>Edit Profile</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Bio:</label>
    <textarea name="bio" rows="5"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>

    <label>Profile Image:</label>
    <?php if (!empty($user['profile_image_path'])): ?>
        <img src="<?=htmlspecialchars($user['profile_image_path'])?>" alt="Profile Image" />
    <?php endif; ?>
    <input type="file" name="profile_image" accept="image/*">

    <button type="submit">Save Profile</button>
  </form>
  <?php if ($message): ?>
  <p class="message"><?=htmlspecialchars($message)?></p>
  <?php endif; ?>
</div>
</body>
</html>
