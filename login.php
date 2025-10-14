<?php
// login.php
session_start();
include_once('db_connect.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login - Portfolio Platform</title>
<style>
/* CSS styling is same as previous message login page */
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
    background-color: #fff;
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    width: 400px;
    box-sizing: border-box;
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
}
label {
    font-weight: bold;
    display: block;
    margin: 15px 0 5px;
    color: #333;
}
input[type="email"], input[type="password"] {
    width: 100%;
    padding: 12px 10px;
    border-radius: 10px;
    border: 2px solid #ccc;
    outline: none;
    font-size: 1rem;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}
input[type="email"]:focus, input[type="password"]:focus {
    border-color: #667eea;
    box-shadow: 0 0 10px #667eea;
}
button {
    width: 100%;
    margin-top: 25px;
    padding: 15px 0;
    border: none;
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}
button:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    transform: scale(1.05);
}
.error {
    color: #cc3333;
    font-weight: bold;
    text-align: center;
    margin-top: 15px;
}
.register-link {
    text-align: center;
    margin-top: 20px;
    font-size: 1rem;
}
.register-link a {
    color: #667eea;
    font-weight: bold;
    text-decoration: none;
}
.register-link a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required autofocus>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <?php if ($error): ?>
    <div class="error"><?=htmlspecialchars($error)?></div>
    <?php endif; ?>

    <div class="register-link">
        Don't have an account? <a href="register.php">Register here</a>
    </div>
</div>

</body>
</html>
