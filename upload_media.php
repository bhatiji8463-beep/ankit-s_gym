<?php
$message = "";

if (isset($_POST['upload'])) {

    $allowed_types = ['jpg', 'jpeg', 'png', 'mp4'];
    $max_size = 10 * 1024 * 1024;

    $file = $_FILES['media'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_types)) {
        $message = "Only JPG, PNG, MP4 allowed";
    } elseif ($file_size > $max_size) {
        $message = "File size must be less than 10MB";
    } else {
        if (!is_dir("uploads")) {
            mkdir("uploads");
        }

        $new_name = time() . "_" . $file_name;
        move_uploaded_file($file_tmp, "uploads/" . $new_name);
        $message = "File uploaded successfully";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Media</title>
<style>
body{
    background:#eee;
    font-family:Arial;
}
.form-box{
    background:#fff;
    width:350px;
    margin:30px auto;
    padding:20px;
    text-align:center;
}
.media-box{
    width:90%;
    margin:20px auto;
}
.media-box img, video{
    width:40%;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="form-box">
<h3>Upload Image / Video</h3>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="media" required>
    <button name="upload">Upload</button>
</form>

<p><?php echo $message; ?></p>
</div>

<!-- DISPLAY UPLOADED FILES -->
<div class="media-box">
<h3 style="text-align:center;">Uploaded Media</h3>

<?php
$files = scandir("uploads");
foreach ($files as $file) {

    if ($file != "." && $file != "..") {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg','jpeg','png'])) {
            echo "<img src='uploads/$file'>";
        }

        if ($ext == 'mp4') {
            echo "<video controls>
                    <source src='uploads/$file' type='video/mp4'>
                  </video>";
        }
    }
}
?>
</div>

</body>
</html>
