<?php
session_start();

/* ===============================
   LOGIN CHECK
=============================== */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* ===============================
   DATABASE CONNECTION
=============================== */
$conn = mysqli_connect("localhost", "root", "", "gym");
if (!$conn) {
    die("Database connection failed");
}

$user_id = $_SESSION['user_id'];

/* ===============================
   FETCH USER + MEMBERSHIP DATA
=============================== */
$sql = "
SELECT 
    user.name,
    user.email,
    
    memberships.membership_type,
    memberships.start_date,
    
    memberships.fees
FROM user
INNER JOIN memberships 
ON memberships.user_id = user.id
WHERE user.id = '$user_id'
";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

/* ===============================
   MEMBERSHIP EXPIRY STATUS
=============================== */
$status = "Active";
if (!empty($data['end_date'])) {
    $today = date("Y-m-d");
    $days_left = (strtotime($data['end_date']) - strtotime($today)) / 86400;

    if ($days_left < 0) {
        $status = "Expired";
    } elseif ($days_left <= 7) {
        $status = "Expiring Soon";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<style>
body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f2f2f2;
}

/* NAVBAR */
.navbar{
    background:#111;
    padding:15px;
    text-align:center;
}
.navbar a{
    color:#fff;
    text-decoration:none;
    margin:0 20px;
    font-weight:bold;
}
.navbar a:hover{
    color:#ff4d4d;
}

/* PROFILE CARD */
.profile-card{
    width:420px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.profile-card h2{
    text-align:center;
    margin-bottom:20px;
}

.row{
    display:flex;
    justify-content:space-between;
    padding:8px 0;
    border-bottom:1px solid #eee;
}

.label{
    font-weight:bold;
    color:#555;
}

.value{
    color:#222;
}

.status{
    margin-top:15px;
    padding:10px;
    text-align:center;
    border-radius:5px;
    font-weight:bold;
    background:#e6f7ff;
}

@media(max-width:500px){
    .profile-card{
        width:90%;
    }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="profile.php">My Profile</a>
    <a href="logout.php">Logout</a>
</div>

<!-- PROFILE -->
<div class="profile-card">
    <h2>My Profile</h2>

    <div class="row">
        <div class="label">Name</div>
        <div class="value"><?php echo $data['name']; ?></div>
    </div>

    <div class="row">
        <div class="label">Email</div>
        <div class="value"><?php echo $data['email']; ?></div>
    </div>

    <div class="row">
        <div class="label">Date of Birth</div>
        <div class="value"><?php echo $data['dob'] ?? 'N/A'; ?></div>
    </div>

    <div class="row">
        <div class="label">Membership Type</div>
        <div class="value"><?php echo $data['membership_type']; ?></div>
    </div>

    <div class="row">
        <div class="label">Start Date</div>
        <div class="value"><?php echo $data['start_date']; ?></div>
    </div>

    <!-- <div class="row">
        <div class="label">End Date</div>
        <div class="value"><?php echo $data['end_date']; ?></div>
    </div> -->

    <div class="row">
        <div class="label">Fees Paid</div>
        <div class="value">₹<?php echo $data['fees']; ?></div>
    </div>

    <div class="status">
        Membership Status: <?php echo $status; ?>
    </div>
</div>

</body>
</html>
