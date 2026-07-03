<?php

require_once "../../app/controllers/FarmerController.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $full_name = trim($_POST['full_name']);
    $mobile_number = trim($_POST['mobile_number']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $taluka = $_POST['taluka'];
    $village = $_POST['village'];
    $terms = isset($_POST['terms']);

    if (empty($full_name)) {
        $errors[] = "Full Name is required.";
    }

    if (!preg_match('/^[0-9]{10}$/', $mobile_number)) {
        $errors[] = "Mobile Number must be exactly 10 digits.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($state)) {
        $errors[] = "Please select a State.";
    }

    if (empty($district)) {
        $errors[] = "Please select a District.";
    }

    if (empty($taluka)) {
        $errors[] = "Please select a Taluka.";
    }

    if (empty($village)) {
        $errors[] = "Please select a Village.";
    }

    if (!$terms) {
        $errors[] = "You must accept the Terms & Conditions.";
    }

    if (empty($errors)) {

        $controller = new FarmerController();

        $result = $controller->register([
            'full_name' => $full_name,
            'mobile_number' => $mobile_number,
            'password' => $password,
            'state' => $state,
            'district' => $district,
            'taluka' => $taluka,
            'village' => $village
        ]);

        if ($result['success']) {
            $success = $result['message'];
        } else {
            $errors[] = $result['message'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration | GO-Farmer</title>

    <link rel="stylesheet" href="../css/farmer-register.css">
</head>

<body>

    <div class="container">

        <div class="register-card">

            <h1>🚜 GO-Farmer</h1>

            
          <h2>Create Farmer Account</h2>

<?php if (!empty($errors)): ?>

<div class="error-box">

    <ul>

        <?php foreach ($errors as $error): ?>

        <li><?php echo htmlspecialchars($error); ?></li>

        <?php endforeach; ?>

    </ul>

</div>

<?php endif; ?>

<?php if (!empty($success)): ?>

<div class="success-box">
    <?php echo htmlspecialchars($success); ?>
</div>

<?php endif; ?>

<form action="" method="POST" autocomplete="off">

    <!-- Your input fields here -->

</form>

            <form action="" method="POST" autocomplete="off">

                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        placeholder="Enter your full name"
                        required
                    >
                </div>

                <div class="input-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input
                        type="tel"
                        id="mobile_number"
                        name="mobile_number"
                        placeholder="Enter 10-digit mobile number"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        required
                    >
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create password"
                        required
                    >
                </div>

                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Confirm password"
                        required
                    >
                </div>

                <div class="input-group">
    <label for="state">State</label>
    <select id="state" name="state" required>
        <option value="" selected disabled>Select State</option>
        <option value="Maharashtra">Maharashtra</option>
    </select>
</div>

<div class="input-group">
    <label for="district">District</label>
    <select id="district" name="district" required>
        <option value="" selected disabled>Select District</option>
        <option value="Dhule">Dhule</option>
    </select>
</div>

<div class="input-group">
    <label for="taluka">Taluka</label>
    <select id="taluka" name="taluka" required>
        <option value="" selected disabled>Select Taluka</option>
        <option value="Shirpur">Shirpur</option>
    </select>
</div>

<div class="input-group">
    <label for="village">Village</label>
    <select id="village" name="village" required>
        <option value="" selected disabled>Select Village</option>
        <option value="Boradi">Boradi</option>
    </select>
</div>

                <div class="terms">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required
                    >
                    <label for="terms">I agree to the Terms & Conditions</label>
                </div>

                <button type="submit">
                    Register
                </button>

            </form>

        </div>

    </div>

</body>
</html>