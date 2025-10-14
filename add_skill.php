<?php
session_start();
include_once(__DIR__ . '/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill = trim($_POST['skill']);
    $user_id = $_SESSION['user_id'];

    if ($skill !== '') {
        $stmt = $conn->prepare("INSERT INTO skills (user_id, skill_name) VALUES (?, ?)");
        $stmt->execute([$user_id, $skill]);
        $message = 'Skill added successfully!';
    } else {
        $message = 'Please enter a skill.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Add Skill</title>
<style>
body { font-family: Arial,sans-serif; background: linear-gradient(135deg,#667eea,#764ba2); margin:0; padding:30px; color:#333; }
.container { max-width: 400px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 6px 12px rgba(0,0,0,0.2);}
h2 {text-align:center;color:#444;margin-bottom:20px;}
input[type=text] {width:100%;padding:10px; border-radius:8px; border:2px solid #ccc; outline:none; transition: 0.3s;}
input[type=text]:focus {border-color:#667eea; box-shadow:0 0 8px #667eea;}
button {width:100%;padding:12px;margin-top:20px;background:linear-gradient(45deg,#6a11cb,#2575fc);color:#fff;border:none;border-radius:10px;font-weight:bold;cursor:pointer; transition: background 0.3s, transform 0.3s;}
button:hover {background:linear-gradient(45deg,#2575fc,#6a11cb); transform: scale(1.05);}
.message {text-align:center; color: green; font-weight: bold; margin-top: 10px;}
</style>
</head>
<body>
<div class="container">
    <h2>Add Skill</h2>
    <form method="POST">
        <input type="text" name="skill" placeholder="e.g. JavaScript" required>
        <button type="submit">Add Skill</button>
    </form>
    <?php if ($message): ?>
    <p class="message"><?=htmlspecialchars($message)?></p>
    <?php endif; ?>
</div>
</body>
</html>
