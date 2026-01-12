<?php
include 'db.php';

if (isset($_POST['submit'])) {

    $user_id = $_POST['user_id'];
    $type    = $_POST['membership_type'];
    $date    = $_POST['start_date'];
    $fees    = $_POST['fees'];

    $sql = "INSERT INTO memberships (user_id, membership_type, start_date, fees)
            VALUES ('$user_id', '$type', '$date', '$fees')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Membership Added Successfully');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
