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
    <link rel="stylesheet" href="./css/global.css">
    <link rel="icon" href="./Resources/images/favicon.ico" type="image/x-icon">
    <title>Dashboard | <?php echo $_SESSION['name'] ?></title>
</head>
<body>
    <div class="app">
        <header>
           <a href="./index.php"> <img class="logo" src="./Resources/images/logo-light.svg"/></a>
            <div class="welcome">
                <p>Welcome back <strong><?php echo $_SESSION['name'] ?>!</strong></p>
                <?php if(isset($_SESSION['profile-url']) && $_SESSION['profile-url'] != ""){?>
                    <div class="profile-img"><img src="<?php echo $_SESSION['profile-url']?>" alt="<?php echo substr($_SESSION['name'],0,1)?>"></div>
                <?php }else{?>
                    <div class="profile-img"><?php echo substr($_SESSION['name'],0,1)?></div>
                <?php }?>
            </div>
        </header>
        <?php
            switch($user_level){
                case 'patient':
                    include("./Views/patient/patient_dashboard.php");
                    break;
                case 'admin':
                    include("./Views/admin/admin_dashboard.php");
                    break;
                case 'pharmacy':
                    include("./Views/pharmacy/pharmacy_dashboard.php");
                    break;
                case 'doctor':
                    include("./Views/doctor/doctor_dashboard.php");
                    break;
                default:
                    echo "Something went terribly wrong!";
                    break;
            }
        ?>
    </div>
    <script src="./js/dashboard.js"></script>
</body>
</html>