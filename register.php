<?php
include 'db.php';

if (isset($_POST['register'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass   = $_POST['password'];

    // Password Hashing
    $password = password_hash($pass, PASSWORD_DEFAULT);

    // Email check
    $check = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered!";
    } else {
        $sql = "INSERT INTO user (name, email, mobile, password)
                VALUES ('$name','$email','$mobile','$password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
        } else {
            $error = "Registration Failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

/* Background Image */
body {
    height: 100vh;
    background: linear-gradient(
        rgba(0,0,0,0.6),
        rgba(0,0,0,0.6)
    ),
    url("gym-bg.jpg") no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Form Card */
.form-container {
    background-color: grey;
    padding: 30px 25px;
    width: 320px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* Heading */
.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #222;
}

/* Inputs */
.form-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.form-container input:focus {
    outline: none;
    border-color: #e63946;
}

/* Button */
.form-container button {
    width: 100%;
    padding: 10px;
    background: #e63946;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.form-container button:hover {
    background: #c62828;
}

/* Error Message */
.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}

/* Login Text */
.login-text {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.login-text a {
    color: #e63946;
    text-decoration: none;
    font-weight: bold;
}

.login-text a:hover {
    text-decoration: underline;
}
h2{  text-align: center;
    color: white;
    margin-left: 100px;
}
input{
    display: block;
    margin: 10px auto;
}
button{
    display: block;
    margin: 20px auto;
}
p,a{
    text-align: center;

    display: block;
    margin: 20px auto;

}
</style>
    
<body>

<h2  >Gym Registration</h2>

<form method="POST" style="width:300px;margin:auto;">
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="register">Register</button>
    <p>Already Registered? <a href="login.php">Login</a></p>
</form>

</body>
</html>
 