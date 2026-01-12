<?php
if (isset($_GET['file'])) {

    $file = $_GET['file'];
    $path = "uploads/" . $file;

    // Security: only delete files from uploads folder
    if (file_exists($path)) {
        unlink($path);
    }
}

// Delete ke baad gallery page pe wapas
header("Location: media_gallery.php");
exit;
?>
