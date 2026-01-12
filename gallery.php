<?php
$message = "";

/* ======================
   FILE UPLOAD LOGIC
====================== */
if (isset($_POST['upload'])) {

    $allowed_types = ['jpg','jpeg','png','mp4'];
    $max_size = 10 * 1024 * 1024; // 10MB

    $file = $_FILES['media'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_types)) {
        $message = "Only JPG, PNG & MP4 files allowed";
    } elseif ($file_size > $max_size) {
        $message = "File must be less than 10MB";
    } else {
        if (!is_dir("uploads")) {
            mkdir("uploads");
        }

        $new_name = time() . "_" . $file_name;
        move_uploaded_file($file_tmp, "uploads/" . $new_name);
        $message = "File uploaded successfully";
    }
}

/* ======================
   FILE DELETE LOGIC
====================== */
if (isset($_GET['delete'])) {
    $file = $_GET['delete'];
    $path = "uploads/" . $file;

    if (file_exists($path)) {
        unlink($path);
    }

    header("Location: gallery.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Gallery</title>

<style>
body{
    margin:0;
    font-family: Arial;
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

/* UPLOAD BOX */
.upload-box{
    background:#fff;
    width:350px;
    margin:30px auto;
    padding:20px;
    text-align:center;
    border-radius:8px;
}
.upload-box input, button{
    width:100%;
    padding:10px;
    margin-top:10px;
}
button{
    background:#ff4d4d;
    border:none;
    color:#fff;
    cursor:pointer;
}
.msg{
    margin-top:10px;
    color:green;
}

/* GALLERY */
.gallery{
    width:90%;
    margin:20px auto;
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    justify-content:center;
}
.item{
    background:#fff;
    padding:10px;
    border-radius:5px;
    text-align:center;
}
.item img, .item video{
    width:250px;
    display:block;
}
.delete-btn{
    display:inline-block;
    margin-top:10px;
    background:red;
    color:white;
    padding:6px 10px;
    text-decoration:none;
    border-radius:4px;
}
.delete-btn:hover{
    background:darkred;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="gallery.php">Gallery</a>
    <a href="admin_logout.php">Logout</a>
</nav>

<!-- UPLOAD FORM -->
<div class="upload-box">
    <h3>Upload Image / Video</h3>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="media" required>
        <button name="upload">Upload</button>
    </form>

    <?php if ($message) echo "<div class='msg'>$message</div>"; ?>
</div>

<!-- MEDIA GALLERY -->
<div class="gallery">
<?php
if (is_dir("uploads")) {
    $files = scandir("uploads");

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            echo "<div class='item'>";

            if (in_array($ext, ['jpg','jpeg','png'])) {
                echo "<img src='uploads/$file'>";
            }

            if ($ext == 'mp4') {
                echo "<video controls>
                        <source src='uploads/$file' type='video/mp4'>
                      </video>";
            }

            echo "<a class='delete-btn'
                   href='gallery.php?delete=$file'
                   onclick=\"return confirm('Delete this file?');\">
                   Delete
                  </a>";

            echo "</div>";
        }
    }
}
?>
</div>

</body>
</html>
