<?php
    $view = (isset($_GET['view'])) ? $_GET['view'] : "";
?>
<div class="container">
    <div class="sidebar">
        <nav class="sidebar-links">
            <a href="./dashboard.php" <?php if($view=="") echo "class='active'"?>><img src="./Resources/images/dashboard-icon.svg" alt="dashboard-icon"> Dashboard</a>
            <a href="./dashboard.php?view=account-profile"<?php if($view=="account-profile") echo "class='active'"?>><img src="./Resources/images/profile-icon.svg" alt="">Account Profile</a>
            <a href="./dashboard.php?view=manage-prescriptions"<?php if($view=="manage-prescriptions") echo "class='active'"?>><img src="./Resources/images/drug-icon.png" alt="">Prescriptions</a>
        </nav>
        <a href="./includes/Authentication/logout.php"><button class="button-secondary-alternate">Logout</button></a>
    </div>
    <div class="main">
       <?php 
       switch($view){
        case "account-profile":
            include_once("./Views/pharmacy/account_profile.php");
            break;
        case "manage-prescriptions":
            include_once("./Views/pharmacy/manage_prescriptions.php");
            break;
        default:
            include_once("./Views/pharmacy/default.php");
            break;
       }
       ?>
    </div>
</div>