<?php
include 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $user  = mysqli_fetch_assoc($query);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name']    = $user['name'];
        header("Location: membership.php");
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    /* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.logo {
    width: 150px;
    height:100px;
    display: inline-block;
    vertical-align: middle;
    margin-left: 600px;
    margin-bottom: 30px;
    border-radius: 100px
}
/* ===== BODY ===== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(
        rgba(0,0,0,0.7),
        rgba(0,0,0,0.7)
    ),
    url("https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b")
    no-repeat center center/cover;
    min-height: 100vh;
    color: #fff;
}

/* ===== NAVBAR ===== */
nav {
    background: rgba(0,0,0,0.85);
    padding: 15px 30px;
    text-align: center;
}

nav a {
    color: #fff;
    margin: 0 15px;
    text-decoration: none;
    font-weight: bold;
}

nav a:hover {
    color: #e91e63;
}

/* ===== HEADINGS ===== */
h1, h2, h3 {
    text-align: center;
    margin: 20px 0;
}

/* ===== FORM CARD ===== */
form {
    background: rgba(0, 0, 0, 0.85);
    max-width: 400px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.8);
}

/* ===== FORM INPUTS ===== */
form input,
form select {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: none;
    outline: none;
    border-radius: 5px;
    font-size: 15px;
}

/* ===== BUTTON ===== */
button {
    width: 100%;
    padding: 12px;
    background: #e91e63;
    border: none;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #c2185b;
}

/* ===== LINKS ===== */
form p {
    text-align: center;
    margin-top: 15px;
}

form a {
    color: #e91e63;
    text-decoration: none;
    font-weight: bold;
}

form a:hover {
    text-decoration: underline;
}

/* ===== ERROR MESSAGE ===== */
p[style*="color:red"] {
    background: #ff4444;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 10px;
}

/* ===== SUCCESS MESSAGE ===== */
.success {
    background: #4caf50;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}

/* ===== TABLE ===== */
table {
    width: 95%;
    margin: 30px auto;
    border-collapse: collapse;
    background: #fff;
    color: #000;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background: #111;
    color: #fff;
}

/* ===== BANNER (HOME) ===== */
.banner {
    height: 350px;
    text-align: center;
    padding-top: 120px;
    background: linear-gradient(
        rgba(0,0,0,0.6),
        rgba(0,0,0,0.6)
    ),
    url("https://images.unsplash.com/photo-1558611848-73f7eb4001a1")
    center/cover;
}

/* ===== RESPONSIVE ===== */
@media(max-width: 600px) {
    form {
        width: 90%;
    }

    nav a {
        display: block;
        margin: 10px 0;
    }
}

</style>
<body>
<img src="logo.png" alt="Gym Logo" class="logo">
<h2 align="center">User Login</h2>

<form  method="POST" style="width:300px;margin:auto;"   >
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="login">Login</button>
    <p>New User? <a href="register.php">Register</a></p>
</form>

</body>
</html>
