<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* LOGO FIX */
/* LOGO */
/* LOGO */
.logo {
    width: 150px;
    height: 80px;
    display: inline-block;
    vertical-align: middle;
    margin-right: 20px;
    border-radius: 100px;
}

/* NAVBAR */
nav {
    height: 70px;
    display: flex;
    align-items: center;        /* vertical center */
    justify-content: center;
    gap: 15px;
    background-color: #fff;
    margin-bottom: 20px;
}

/* NAV LINKS */
nav a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 8px 14px;
    display: inline-block;      /* 🔑 VERY IMPORTANT */
    white-space: nowrap;        /* 🔑 ek line me rakhega */
}
        .banner {
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        .banner h1 {
            margin-bottom: 10px;
        }
        .banner p {
            margin-bottom: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px 0;
        }
        i{
            font-size: 24px;
            margin-right: 10px;
        }
        </style>
    <title>Gym Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- <?php session_start(); ?> -->

<nav>

<nav>
    <img src="logo.png" alt="Gym Logo" class="logo">
    <a href="index.php">Home</a>
    <a href="#services">Services</a>
    <!-- <a href="membership.php">Membership</a> -->
    <a href="#contact">Contact</a>
    <a href="login.php">Login</a>
    <nav class="navbar">
    <!-- <a href="admin_dashboard.php">Dashboard</a> -->
    <a href="gallery.php" style = "margin-top: 37px;">Gallery</a>
        <a href="admin_login.php" style = "margin-top: 39px;">admin Login</a>

    <!-- <a href="admin_logout.php" style = "margin-top: 37px;">Logout</a> -->
    
</nav>

</nav>
<div>
    <?php if (isset($_SESSION['user_id'])) { ?>
    <a href="profile.php" style= "margin-bottom:28px" >My Profile</a>
    <a href="logout.php">Logout</a>
<?php } else { ?>
    <!-- <a href="login.php">Login</a> -->
<?php } ?>
</nav>

</div>
<div class="banner">
    <h1>Welcome to Power Gym</h1>
    <p>Build Your Body, Transform Your Life</p>
    <a href="register.php"><button>New Membership</button></a>
</div>

<div class="container" id="services">
    <h2>Our Services</h2>
    <ul>
        <li>Cardio Training</li>
        <li>Weight Training</li>
        <li>Yoga</li>
        <li>Personal Trainer</li>
    </ul>
</div>

<div class="container" id="contact">
    <h2>Contact Us</h2>
    <iframe    <i class="fa-brands fa-instagram"></i></iframe>
    <i class="fa-brands fa-whatsapp"></i>
    <i class="fa-brands fa-facebook"></i>



    
    <p>📞 9876543210</p>
    <p>📧 powergym@gmail.com</p>
    <p>📍 Delhi, India</p>

    <iframe 
        src="https://www.google.com/maps?q=delhi&output=embed"
        width="100%" height="250">
    </iframe>
</div>

</body>
</html>
