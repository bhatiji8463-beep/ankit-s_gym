<?php
include 'db.php';

// Admin check
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background: #111;
            color: white;
        }
    </style>
</head>
<body>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="admin_logout.php">Logout</a>
</nav>

<h2>Welcome Admin</h2>

<h3>Membership Details</h3>

<table>
<tr>
    <th>User Name</th>
    <th>Email</th>
    <th>Membership Type</th>
    <th>Start Date</th>
    <th>Fees</th>
</tr>

<?php
$sql = "
SELECT user.name, user.email, memberships.membership_type,
       memberships.start_date, memberships.fees
FROM memberships
JOIN user ON memberships.user_id = user.id
";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['membership_type']; ?></td>
    <td><?php echo $row['start_date']; ?></td>
    <td>₹<?php echo $row['fees']; ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>
