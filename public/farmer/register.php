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

            <form action="" method="POST">

                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter your full name">
                </div>

                <div class="input-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_number" placeholder="Enter 10-digit mobile number">
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create password">
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm password">
                </div>

                <div class="input-group">
                    <label>State</label>
                    <select name="state">
                        <option>Select State</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>District</label>
                    <select name="district">
                        <option>Select District</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Taluka</label>
                    <select name="taluka">
                        <option>Select Taluka</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Village</label>
                    <select name="village">
                        <option>Select Village</option>
                    </select>
                </div>

                <div class="terms">
                    <input type="checkbox">
                    I agree to the Terms & Conditions
                </div>

                <button type="submit">
                    Register
                </button>

            </form>

        </div>

    </div>

</body>
</html>