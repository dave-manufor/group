<?php
    $view = (isset($_GET['view'])) ? $_GET['view'] : "";
?>
<div class="container">
    <div class="sidebar">
        <nav class="sidebar-links">
            <a href="./dashboard.php" <?php if($view=="") echo "class='active'"?>><img src="./Resources/images/dashboard-icon.svg" alt="dashboard-icon"> Dashboard</a>
            <a href="./dashboard.php?view=account-profile"<?php if($view=="account-profile") echo "class='active'"?>><img src="./Resources/images/profile-icon.svg" alt="">Account Profile</a>
        </nav>
        <a href="./includes/Authentication/logout.php"><button class="button-secondary-alternate">Logout</button></a>
    </div>
    <div class="main">
       <?php 
       switch($view){
        case "account-profile":
            include_once("./Views/patient/account_profile.php");
            break;
        default:
            include_once("./Views/patient/default.php");
            break;
       }
       ?>
    </div>
</div>