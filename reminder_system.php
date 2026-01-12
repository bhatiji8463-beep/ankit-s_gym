<?php
// db connection (adjust credentials if needed)
$conn = mysqli_connect("localhost", "root", "", "gym");
if (!$conn) {
    die("Database connection failed");
}

// Today's date
$today = date("Y-m-d");

// Fetch membership + user data
$sql = "
SELECT 
user.id,
    user.name,
    user.email,
    user.mobile,

    memberships.membership_type,
    
FROM memberships
JOIN user ON memberships.user_id = user.id
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reminder System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .box {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 5px solid #ff4d4d;
        }
        .birthday {
            border-left-color: #4caf50;
        }
    </style>
</head>

<body>

<h2>Membership Reminders & Birthday Wishes</h2>

<?php
while ($row = mysqli_fetch_assoc($result)) {

    $end_date = $row['end_date'];
    $name = $row['name'];
    $type = $row['membership_type'];

    // Calculate days left
    $days_left = (strtotime($end_date) - strtotime($today)) / (60 * 60 * 24);

    // Membership reminders
    if (in_array($days_left, [7, 3, 1])) {
        echo "<div class='box'>
            Reminder: <b>$name</b>, your <b>$type</b> membership will expire on <b>$end_date</b>.
            ($days_left days left)
        </div>";
    }

    // Birthday check
    if (!empty($row['dob'])) {
        $dob_today = date("m-d", strtotime($row['dob']));
        if ($dob_today == date("m-d")) {
            echo "<div class='box birthday'>
                🎉 Happy Birthday <b>$name</b> 🎂
            </div>";
        }
    }
}
?>

</body>
</html>
