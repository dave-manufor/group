<?php
    session_start();
    require_once("./includes/Authentication/check_login.php");
    $user_level = $_SESSION['user-level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/general.css">
    <title>Dashboard | Drug Dispenser LLC</title>
</head>
<body>
    <div class="app">
        <header>
            <h1>Drug Dispenser LLC</h1>
            <p>Welcome back <?php echo $_SESSION['name'] ?>!</p>
        </header>
        <?php
            switch($user_level){
                case 'patient':
                    include("./Views/patient_dashboard.php");
                    break;
                case 'admin':
                    include("./Views/admin_dashboard.php");
                    break;
                case 'pharmacy':
                    include("./Views/pharmacy_dashboard.php");
                    break;
                default:
                    echo "Something went terribly wrong!";
                    break;
            }
        ?>
    </div>

</body>
</html>