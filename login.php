<?php
    // echo "LOGIN PAGE";
    // echo urldecode($_GET['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | Drug Dispenser LLC</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/general.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
        <h1 class="form-title">Log in
            <hr class="form-title-line"/>
        </h1>
        <div class="error-message closed" id="error-container"></div>
        <form action="" method="post" id="login-form">
            <div class="form-tab" id="tab1">
                <div class="field full-field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="example@gmail.com">
                </div>
                <div class="field full-field">
                  <label for="password">Password</label>
                  <div class="pass-field">
                    <input type="password" id="password" name="password" required/>
                    <img
                      id="password-view-btn"
                      src="./Resources/images/close-eye.png"
                      alt="closed-eye-icon"
                    />
                  </div>
                </div>
                <div class="field full-field">
                    <label for="user-type">User Type</label>
                    <select name="account-type" id="user-type" required>
                        <option value="">Select Type</option>
                        <option value="patient">Patient</option>
                        <option value="admin">Administrator</option>
                        <option value="pharmacy">Pharmacy</option>
                    </select>
                </div>
                <button type="submit" class="form-btn" name="login-btn">Sign in</button>
            </div>
        </form>
        <span class="info">Or <a href="./signup.php" class="link">Sign Up</a></span>
        </div>
    </div>
    <script src="./js/login.js"></script>
</body>
</html>