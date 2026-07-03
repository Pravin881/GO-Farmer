<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

echo "<h1>🚚 Transport Provider Dashboard</h1>";
echo "<h2>Welcome " . htmlspecialchars($_SESSION['user']['full_name']) . "</h2>";
echo "<a href='../logout.php'>Logout</a>";