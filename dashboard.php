<?php
session_start();
include_once('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>User Dashboard</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #f0f0f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
header {
    padding: 40px 20px 20px;
    text-align: center;
}
header h1 {
    font-size: 2.8rem;
    margin-bottom: 10px;
    font-weight: 900;
    text-shadow: 2px 2px 6px rgba(0,0,0,0.3);
}
header p {
    font-size: 1.2rem;
    opacity: 0.9;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
}
main {
    flex-grow: 1;
    display: flex;
    justify-content: center;
    padding: 30px 20px;
}
.button-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    max-width: 650px;
    width: 100%;
}
.btn {
    background: linear-gradient(120deg, #6a11cb, #2575fc);
    border: none;
    color: white;
    padding: 18px 0;
    font-size: 1.2rem;
    font-weight: 700;
    border-radius: 14px;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    transition: background 0.3s ease, transform 0.2s ease;
    user-select: none;
}
.btn:hover {
    background: linear-gradient(120deg, #2575fc, #6a11cb);
    transform: scale(1.08);
}
footer {
    text-align: center;
    padding: 15px 10px;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.75);
    background-color: rgba(0,0,0,0.1);
    box-shadow: inset 0 1px 2px rgba(255,255,255,0.1);
}
@media (max-width: 500px) {
    header h1 {
        font-size: 2.2rem;
    }
    .btn {
        font-size: 1rem;
        padding: 15px 0;
    }
}
</style>
</head>
<body>

<header>
  <h1>Welcome, <?=htmlspecialchars($username)?></h1>
  <p>Your portfolio management dashboard</p>
</header>

<main>
  <div class="button-group" role="navigation" aria-label="User dashboard actions">
    <a href="add_portfolio.php" class="btn" title="Add a new portfolio">Add Portfolio</a>
    <a href="profile_edit.php" class="btn" title="Edit your profile">Edit Profile</a>
    <a href="add_skill.php" class="btn" title="Add new skills">Add Skill</a>
    <a href="view_portfolios.php" class="btn" title="View portfolios">View All Portfolios</a>
    <a href="add_project.php" class="btn" title="Add a new project">Add Project</a>
    <a href="all_projects.php" class="btn" title="View all projects">View All Projects</a>
    <a href="logout.php" class="btn" title="Logout">Logout</a>
  </div>
</main>

<footer>
  &copy; 2025 Responsive Portfolio Platform. All rights reserved.
</footer>

</body>
</html>
