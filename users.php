<?php
include 'db.php';

// Admin check
if (!isset($_SESSION['admin'])) {
    header("Location: admin/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" href="css/style.css">
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
            background: #222;
            color: white;
        }
    </style>
</head>
<body>

<nav>
    <a href="admin/dashboard.php">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="admin/logout.php">Logout</a>
</nav>

<h2 align="center">Registered Users</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Register Date</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM user");
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['mobile']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>
