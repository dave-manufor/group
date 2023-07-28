<?php
    $view = (isset($_GET['view'])) ? $_GET['view'] : "";
?>
<div class="container">
    <div class="sidebar">
        <nav class="sidebar-links">
            <a href="./dashboard.php" <?php if($view=="") echo "class='active'"?>><img src="./Resources/images/dashboard-icon.svg" alt="dashboard-icon"> Dashboard</a>
            <a href="./dashboard.php?view=account-profile"<?php if($view=="account-profile") echo "class='active'"?>><img src="./Resources/images/profile-icon.svg" alt="">Account Profile</a>
            <a href="./dashboard.php?view=manage-patients"<?php if($view=="manage-patients") echo "class='active'"?>><img src="./Resources/images/patients-icon.png" alt="">Manage Patients</a>
            <a href="./dashboard.php?view=manage-doctors"<?php if($view=="manage-doctors") echo "class='active'"?>><img src="./Resources/images/doctors-icon.png" alt="">Manage Doctors</a>
            <a href="./dashboard.php?view=manage-pharmacies"<?php if($view=="manage-pharmacies") echo "class='active'"?>><img src="./Resources/images/pharmacy-icon.png" alt="">Manage Pharmacies</a>
            <a href="./dashboard.php?view=manage-admins"<?php if($view=="manage-admins") echo "class='active'"?>><img src="./Resources/images/admin-icon.png" alt="">Manage Administrators</a>
            <a href="./dashboard.php?view=manage-drugs"<?php if($view=="manage-drugs") echo "class='active'"?>><img src="./Resources/images/drug-icon.png" alt="">Manage Drugs</a>
        </nav>
        <a href="./includes/Authentication/logout.php"><button class="button-secondary-alternate">Logout</button></a>
    </div>
    <div class="main">
       <?php 
       switch($view){
        case "account-profile":
            include_once("./Views/admin/account_profile.php");
            break;
        case "manage-patients":
            include_once("./Views/admin/manage_patients.php");
            break;
        case "manage-doctors":
            include_once("./Views/admin/manage_doctors.php");
            break;
        case "manage-pharmacies":
            include_once("./Views/admin/manage_pharmacies.php");
            break;
        case "manage-admins":
            include_once("./Views/admin/manage_admins.php");
            break;
        case "manage-drugs":
            include_once("./Views/admin/manage_drugs.php");
            break;
        default:
            include_once("./Views/admin/default.php");
            break;
       }
       ?>
    </div>
</div>