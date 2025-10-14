<?php
session_start();
include_once('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $project_link = trim($_POST['project_link']);
    $project_image = '';

    // Handle image upload
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === 0) {
        $upload_dir = __DIR__ . '/uploads/projects/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $filename = uniqid() . '_' . basename($_FILES['project_image']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['project_image']['tmp_name'], $target_file)) {
            $project_image = 'uploads/projects/' . $filename;
        } else {
            $message = 'Error uploading image.';
        }
    }

    if ($title !== '' && $description !== '') {
        $stmt = $conn->prepare("INSERT INTO user_projects (user_id, project_title, project_description, project_image, project_technologies, project_link) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $description, $project_image, $technologies, $project_link]);
        $message = 'Project added successfully!';
    } else {
        $message = 'Please fill in required fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Add Project</title>
<style>
body {
    font-family: Arial,sans-serif;
    background: linear-gradient(135deg,#667eea,#764ba2);
    margin:0; padding:30px; color:#333;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:flex-start;
}
.container {
    background: white;
    border-radius: 15px;
    padding: 30px;
    width: 450px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
h2 {
    text-align:center;
    margin-bottom: 20px;
    color: #444;
}
label {
    font-weight: bold;
    display:block;
    margin:15px 0 5px;
}
input[type="text"], input[type="url"], textarea, input[type="file"] {
    width: 100%;
    padding:10px;
    border-radius:8px;
    border: 2px solid #ccc;
    outline:none;
    box-sizing: border-box;
    transition: border-color 0.3s;
}
input[type="text"]:focus, input[type="url"]:focus, textarea:focus {
    border-color:#667eea;
    box-shadow: 0 0 8px #667eea;
}
textarea {
    resize: vertical;
    min-height: 100px;
}
button {
    background: linear-gradient(45deg,#6a11cb,#2575fc);
    width:100%;
    padding:15px;
    margin-top:25px;
    border:none;
    color:white;
    font-size:1.1rem;
    font-weight:bold;
    border-radius:10px;
    cursor:pointer;
    transition:background 0.3s, transform 0.2s;
}
button:hover {
    background: linear-gradient(45deg,#2575fc,#6a11cb);
    transform: scale(1.05);
}
.message {
    margin-top:15px;
    font-weight:bold;
    text-align:center;
    color: green;
}
</style>
</head>
<body>

<div class="container">
    <h2>Add New Project</h2>
    <form method="POST" enctype="multipart/form-data" novalidate>
        <label for="title">Project Title *</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description *</label>
        <textarea id="description" name="description" required></textarea>

        <label for="technologies">Technologies (comma-separated)</label>
        <input type="text" id="technologies" name="technologies" placeholder="HTML, CSS, PHP">

        <label for="project_link">Project Link (URL)</label>
        <input type="url" id="project_link" name="project_link" placeholder="https://">

        <label for="project_image">Project Image</label>
        <input type="file" id="project_image" name="project_image" accept="image/*">

        <button type="submit">Add Project</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?=htmlspecialchars($message)?></div>
    <?php endif; ?>
</div>

</body>
</html>
