<?php
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, 
        "SELECT * FROM admin WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($query) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    } else {
        $error = "Invalid Admin Login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    min-height:100vh;
    background: #111; /* safe background */
}

/* OPTIONAL BACKGROUND IMAGE */
body::before{
    content:"";
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:url("gym-bg.jpg") no-repeat center/cover;
    opacity:0.4;
    z-index:-1;
}

.login-box{
    width:350px;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    margin:120px auto;   /* 👈 CENTER FIX */
}

.login-box h2{
    text-align:center;
    margin-bottom:20px;
}

input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border-radius:5px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:12px;
    background:#ff4d4d;
    border:none;
    color:white;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#e60000;
}

.error{
    color:red;
    text-align:center;
    margin-bottom:10px;
}

.home-link{
    text-align:center;
    margin-top:15px;
}

.home-link a{
    text-decoration:none;
    color:#ff4d4d;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <div class="home-link">
        <a href="index.php">← Gym Home Page</a>
    </div>
</div>

</body>
</html>
