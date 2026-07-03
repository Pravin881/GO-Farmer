<?php

session_start();

require_once "../../app/controllers/LoadController.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

$loadController = new LoadController();

$totalLoads = $loadController->countTotalLoads($user['id']);

$openLoads = $loadController->countLoadsByStatus($user['id'], 'OPEN');

$bookedLoads = $loadController->countLoadsByStatus($user['id'], 'BOOKED');

$deliveredLoads = $loadController->countLoadsByStatus($user['id'], 'DELIVERED');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmer Dashboard | GO-Farmer</title>

    <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>

<div class="sidebar">

    <h2>🚜 GO-Farmer</h2>

    <ul>

        <li><a href="dashboard.php">🏠 Dashboard</a></li>

        <li><a href="post-load.php">📦 Post New Load</a></li>

        <li><a href="my-loads.php">📋 My Loads</a></li>

        <li><a href="booked-transport.php">🚚 Booked Transport</a></li>

        <li><a href="profile.php">👤 My Profile</a></li>

        <li><a href="settings.php">⚙️ Settings</a></li>

        <li><a href="../logout.php">🚪 Logout</a></li>

    </ul>

</div>

<div class="main-content">

    <div class="topbar">

        <h1>🚜 Farmer Dashboard</h1>

        <p>Welcome, <strong><?php echo htmlspecialchars($user['full_name']); ?></strong></p>

    </div>

    <div class="cards">

        <div class="card">
            <h3>📦 Total Loads</h3>
            <p><?php echo $totalLoads; ?></p>
        </div>

        <div class="card">
            <h3>🟢 Open Loads</h3>
            <p><?php echo $openLoads; ?></p>
        </div>

        <div class="card">
            <h3>🚚 Booked Loads</h3>
            <p><?php echo $bookedLoads; ?></p>
        </div>

        <div class="card">
            <h3>✅ Delivered Loads</h3>
            <p><?php echo $deliveredLoads; ?></p>
        </div>

    </div>

</div>

</body>

</html>