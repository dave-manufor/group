<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="icon" href="./Resources/images/favicon.ico" type="image/x-icon">
    <title>Home | Drug Dispenser LLC</title>
</head>
<body>
    <header class="hero-section" id="hero">
        <div class="container">
            <nav>
                <a href="./index.php"><img class="logo" src="./Resources/images/logo-light.svg" alt="drug dispenser logo"/></a>
                <ul class="links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#cta">Get Started</a></li>
                </ul>
                <div class="button-group">
                    <?php if(isset($_SESSION['id']) && strlen($_SESSION['id']) != 0){ ?>
                        <a href="./includes/Authentication/logout.php"><button class="button button-secondary-alternate">Logout</button></a>
                        <a href="./dashboard.php"><button class="button-primary-alternate">Dashboard</button></a>
                    <?php }else{ ?> 
                        <div class="dropdown">
                            <button class="button-secondary-alternate">Login <img src="./Resources/images/down-arrow-icon-white.svg"></button>
                            <div class="dropdown-content">
                                <div class="dropdown-content-list">
                                    <a href="./login.php?type=patient">Patient</a>
                                    <a href="./login.php?type=doctor">Doctor</a>
                                    <a href="./login.php?type=pharmacy">Pharmacy</a>
                                    <a href="./login.php?type=admin">Admin</a>
                                </div>
                            </div>
                        </div>
                        <a href="./signup.php"><button class="button-primary-alternate">Sign Up</button></a>
                    <?php } ?>
                </div>
            </nav>
            <div class="hero-text">
                <h1>Your One Stop For All Things <span>Medicine</span></h1>
                <p>The ultimate drug dispensing app for a speedy experience. Take control of your health with just a tap!</p>
                <a href="./signup.php"><button class="button-primary">Get Started</button></a>
            </div>

        </div>
    </header>
    <section class="statistics-section container">
        <div class="stats">
            <div class="stat">
                <h2>70<span>+</span></h2>
                <p>Doctors</p>
            </div>
            <div class="vl"></div>
            <div class="stat">
                <h2>150<span>+</span></h2>
                <p>Medicines</p>
            </div>
            <div class="vl"></div>
            <div class="stat">
                <h2>30<span>+</span></h2>
                <p>Pharmacies</p>
            </div>
        </div>
    </section>
    <section class="about-section" id="about">
        <div class="container">
            <h2>Why Choose Us?</h2>
            <div class="features container-grid">
                <div class="feature">
                    <img src="./Resources/images/time-feature-icon.svg" alt="">
                    <h3>Prescription Management</h3>
                    <p>Say goodbye to the stress of tracking your prescriptions. Our smart app organizes and reminds you about refills</p>
                </div>
                <div class="feature">
                    <img src="./Resources/images/doctor-feature-icon.svg" alt="">
                    <h3>Expert Consultations</h3>
                    <p>Access a pool of qualified healthcare professionals from the comfort of where ever you are</p>
                </div>
                <div class="feature">
                    <img src="./Resources/images/ui-feature-icon.svg" alt="">
                    <h3>Easy-to-Use Interface</h3>
                    <p>Our user-friendly app is designed to be intuitive, making it accessible to all age groups and types of users</p>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section container" id="cta">
        <div class="cta">
            <h2>Ready to Revolutionize Your Medication Experience?</h2>
            <p>Join thousands of satisfied users who have already embraced the future of drug dispensing. Sign up to DrugBank now and experience the convenience, speed, and peace of mind you deserve.</p>
        </div>
        <a href="./signup.php"><button class="button-primary">Get Started</button></a>
    </section>
    <footer>
        <div class="container">
            <div class="brand">
                <a href="./index.php"><img class="logo" src="./Resources/images/logo-light.svg" alt="drug dispenser logo"></a>
                <p>The ultimate drug dispensing app for a speedy experience. Take control of your health with just a tap!<br><br>&copy; 2023 DrugBank. All rights reserved.</p>
            </div>
            <div class="link-groups">
                <div class="link-group">
                    <h3>User Logins</h3>
                    <a href="./login.php?type=patient">Patient</a>
                    <a href="./login.php?type=doctor">Doctor</a>
                    <a href="./login.php?type=pharmacy">Pharmacy</a>
                    <a href="./login.php?type=admin">Administrator</a>
                </div>
                <div class="link-group">
                    <h3>Useful Links</h3>
                    <a href="#hero">Home</a>
                    <a href="#about">About Us</a>
                    <a href="#cta"">Get Started</a>
                </div>
                <div class="link-group">
                    <h3>Contact Us</h3>
                    <a href="mailto:info@drugdispenser.com">info@drugdispenser.com</a>
                    <a href="tel:+254111461097">+254 111 461 097</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>