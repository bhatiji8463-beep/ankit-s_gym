<!DOCTYPE html>
<html>
<head>
    <title>Media Gallery</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .media-item {
            background: #fff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        img, video {
            width: 300px;
            display: block;
            margin-bottom: 10px;
        }
        .delete-btn {
            background: red;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        .delete-btn:hover {
            background: darkred;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Uploaded Media</h2>

<?php
$folder = "uploads/";
$files = scandir($folder);

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        echo "<div class='media-item'>";

        if (in_array($ext, ['jpg','jpeg','png'])) {
            echo "<img src='$folder$file'>";
        }

        if ($ext == 'mp4') {
            echo "<video controls>
                    <source src='$folder$file' type='video/mp4'>
                  </video>";
        }

        echo "<a class='delete-btn' 
              href='delete_media.php?file=$file'
              onclick=\"return confirm('Are you sure you want to delete this file?');\">
              Delete
              </a>";

        echo "</div>";
    }
}
?>

</div>

</body>
</html>
