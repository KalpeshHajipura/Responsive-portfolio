<?php
include_once(__DIR__ . '/db_connect.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        header("Location: login.php");
        exit();
    } else {
        $message = "Registration failed. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Register - Portfolio Platform</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: #444;
    }
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 400px;
    }
    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }
    label {
        font-weight: bold;
        display: block;
        margin-top: 15px;
    }
    input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 2px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s;
    }
    input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
        border-color: #667eea;
        box-shadow: 0 0 8px #667eea;
    }
    button {
        width: 100%;
        padding: 12px;
        margin-top: 25px;
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }
    button:hover {
        background: linear-gradient(45deg, #2575fc, #6a11cb);
        transform: scale(1.05);
    }
    .message {
        margin-top: 15px;
        color: red;
        text-align: center;
    }
    .link {
        margin-top: 15px;
        text-align: center;
    }
    .link a {
        color: #667eea;
        text-decoration: none;
        font-weight: bold;
    }
    .link a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
    <?php if ($message) echo '<div class="message">' . htmlspecialchars($message) . '</div>'; ?>
    <div class="link">Already have an account? <a href="login.php">Login here</a></div>
</div>

</body>
</html>
