<?php
session_start();
require_once "../../app/controllers/LoadController.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [
        'farmer_id' => $user['id'],
        'crop_name' => trim($_POST['crop_name']),
        'quantity' => trim($_POST['quantity']),
        'unit' => $_POST['unit'],
        'vehicle_type' => $_POST['vehicle_type'],
        'pickup_state' => trim($_POST['pickup_state']),
        'pickup_district' => trim($_POST['pickup_district']),
        'pickup_taluka' => trim($_POST['pickup_taluka']),
        'pickup_village' => trim($_POST['pickup_village']),
        'destination_state' => trim($_POST['destination_state']),
        'destination_district' => trim($_POST['destination_district']),
        'destination_taluka' => trim($_POST['destination_taluka']),
        'destination_village' => trim($_POST['destination_village']),
        'expected_price' => trim($_POST['expected_price']) ?: null,
        'pickup_date' => $_POST['pickup_date'],
        'description' => trim($_POST['description'])
    ];

    foreach ([
        'crop_name','quantity','unit','vehicle_type',
        'pickup_state','pickup_district','pickup_taluka','pickup_village',
        'destination_state','destination_district','destination_taluka','destination_village',
        'pickup_date'
    ] as $f){
        if(empty($data[$f])) $errors[] = ucfirst(str_replace('_',' ',$f))." is required.";
    }

    if(empty($errors)){
        $controller = new LoadController();
        if($controller->create($data)){
            $success = "Load posted successfully.";
        }else{
            $errors[] = "Failed to post load.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Post Load | GO-Farmer</title>
<link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="main-content">
<h1>📦 Post New Load</h1>

<?php if($errors): ?>
<div class="error-box"><ul>
<?php foreach($errors as $e): ?>
<li><?= htmlspecialchars($e) ?></li>
<?php endforeach; ?>
</ul></div>
<?php endif; ?>

<?php if($success): ?>
<div class="success-box"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="POST">

<label>Crop Name</label>
<input type="text" name="crop_name" required>

<label>Quantity</label>
<input type="number" step="0.01" name="quantity" required>

<label>Unit</label>
<select name="unit" required>
<option value="">Select</option>
<option value="KG">KG</option>
<option value="QUINTAL">QUINTAL</option>
<option value="TON">TON</option>
</select>

<label>Vehicle Type</label>
<select name="vehicle_type" required>
<option value="">Select</option>
<option value="PICKUP">Pickup</option>
<option value="TATA_407">Tata 407</option>
<option value="TRUCK">Truck</option>
<option value="CONTAINER">Container</option>
</select>

<label>Pickup State</label><input type="text" name="pickup_state" required>
<label>Pickup District</label><input type="text" name="pickup_district" required>
<label>Pickup Taluka</label><input type="text" name="pickup_taluka" required>
<label>Pickup Village</label><input type="text" name="pickup_village" required>

<label>Destination State</label><input type="text" name="destination_state" required>
<label>Destination District</label><input type="text" name="destination_district" required>
<label>Destination Taluka</label><input type="text" name="destination_taluka" required>
<label>Destination Village</label><input type="text" name="destination_village" required>

<label>Expected Price</label><input type="number" step="0.01" name="expected_price">
<label>Pickup Date</label><input type="date" name="pickup_date" required>
<label>Description</label><textarea name="description" rows="5"></textarea>

<button type="submit">🚜 Post Load</button>
</form>
</div>
</body>
</html>
