<?php

session_start();

require_once "../../app/controllers/LoadController.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

$controller = new LoadController();

$loads = $controller->getLoadsByFarmer($user['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Loads | GO-Farmer</title>

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

        <h1>📋 My Loads</h1>

        <p>Welcome,
            <strong><?php echo htmlspecialchars($user['full_name']); ?></strong>
        </p>

    </div>

    <div class="card">

        <table class="loads-table">

            <thead>
<tr>
    <th>Crop</th>
    <th>Quantity</th>
    <th>Vehicle</th>
    <th>Pickup</th>
    <th>Destination</th>
    <th>Status</th>
    <th>Posted</th>
    <th>Actions</th>
</tr>

            </thead>

            <tbody>

            <?php if (empty($loads)): ?>

                <tr>
                    <td colspan="7">No loads found.</td>
                </tr>

            <?php else: ?>

                <?php foreach ($loads as $load): ?>

                <tr>

                    <td><?= htmlspecialchars($load['crop_name']) ?></td>

                    <td>
                        <?= htmlspecialchars($load['quantity']) ?>
                        <?= htmlspecialchars($load['unit']) ?>
                    </td>

                    <td><?= htmlspecialchars($load['vehicle_type']) ?></td>

                    <td><?= htmlspecialchars($load['pickup_village']) ?></td>

                    <td><?= htmlspecialchars($load['destination_village']) ?></td>
<td>
    <?php if ($load['status'] == 'OPEN'): ?>
        <span class="status-open">🟢 OPEN</span>
    <?php elseif ($load['status'] == 'BOOKED'): ?>
        <span class="status-booked">🟡 BOOKED</span>
    <?php elseif ($load['status'] == 'DELIVERED'): ?>
        <span class="status-delivered">🔵 DELIVERED</span>
    <?php else: ?>
        <span class="status-cancelled">🔴 CANCELLED</span>
    <?php endif; ?>
</td>

                   <td>

<?php if ($load['status'] == 'OPEN'): ?>

    <a href="edit-load.php?id=<?= $load['id'] ?>">✏️ Edit</a>

  <a href="delete-load.php?id=<?= $load['id'] ?>" class="btn-delete">
    🗑️ Delete
</a>

<?php else: ?>

    <span style="color:gray;">Not Allowed</span>

<?php endif; ?>

</td>
                </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>