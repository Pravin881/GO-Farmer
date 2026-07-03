<?php

session_start();

require_once "../app/models/User.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mobile_number = trim($_POST['mobile_number']);
    $password = $_POST['password'];

    if (empty($mobile_number)) {
        $errors[] = "Mobile Number is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {

        $userModel = new User();

        $user = $userModel->findByMobile($mobile_number);

        if (!$user) {

            $errors[] = "Invalid mobile number or password.";

        } elseif (!password_verify($password, $user['password'])) {

            $errors[] = "Invalid mobile number or password.";

        } else {

            $_SESSION['user'] = $user;

            switch ($user['role']) {

                case 'FARMER':
                    header("Location: farmer/dashboard.php");
                    break;

                case 'TRANSPORT_PROVIDER':
                    header("Location: transport-provider/dashboard.php");
                    break;

                case 'ADMIN':
                    header("Location: admin/dashboard.php");
                    break;
            }

            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | GO-Farmer</title>

    <link rel="stylesheet" href="css/farmer-register.css">

</head>

<body>

<div class="container">

<div class="register-card">

<h1>🚜 GO-Farmer</h1>

<h2>Login</h2>

<?php if (!empty($errors)): ?>

<div class="error-box">

<ul>

<?php foreach ($errors as $error): ?>

<li><?php echo htmlspecialchars($error); ?></li>

<?php endforeach; ?>

</ul>

</div>

<?php endif; ?>

<form method="POST">

<div class="input-group">

<label>Mobile Number</label>

<input
type="tel"
name="mobile_number"
maxlength="10"
required>

</div>

<div class="input-group">

<label>Password</label>

<input
type="password"
name="password"
required>

</div>

<button type="submit">

Login

</button>

</form>

</div>

</div>

</body>

</html>