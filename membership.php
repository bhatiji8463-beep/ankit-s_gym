<?php
include 'db.php';

// Login check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Membership</title>

    <style>
        /* RESET */
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* PAGE BACKGROUND */
        body{
            min-height: 100vh;
            background: linear-gradient(
                rgba(0,0,0,0.6),
                rgba(0,0,0,0.6)
            ),
            url("gym-bg.jpg") no-repeat center center/cover;
        }

        /* NAVBAR */
        nav{
            background: rgba(0,0,0,0.85);
            padding: 15px;
            text-align: center;
        }

        nav a{
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-weight: bold;
        }

        nav a:hover{
            color: #ff4d4d;
        }

        /* HEADING */
        h2{
            color: white;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        /* FORM CARD */
        form{
            width: 450px;
            margin: auto;
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        /* LABELS */
        label{
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        /* INPUTS & SELECT */
        input, select{
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus, select:focus{
            outline: none;
            border-color: #ff4d4d;
        }

        /* BUTTON */
        button{
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            background: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover{
            background: #e60000;
        }

        /* RESPONSIVE */
        @media(max-width: 500px){
            form{
                width: 90%;
            }
        }
    </style>

</head>

<body>

<nav>
    <a href="index.php">Home</a>
    <a href="logout.php">Logout</a>
</nav>

<h2 align="center">New Gym Membership</h2>

<form method="POST" action="membership_insert.php">

    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

    <label>Membership Type</label>
    <select name="membership_type" required>
        <option value="">Select</option>
        <option value="Monthly">Monthly</option>
        <option value="Quarterly">Quarterly</option>
        <option value="Yearly">Yearly</option>
    </select>

    <label>Start Date</label>
    <input type="date" name="start_date" required>

    <label>Fees (₹)</label>
    <input type="number" name="fees" required>

    <button type="submit" name="submit">Submit Membership</button>
</form>

</body>
</html>
