<?php
include "includes/header.php";

/* ===== Upload Function ===== */
function uploadPortfolioFile($file) {
    if ($file['error'] !== 0) {
        throw new Exception("File upload error.");
    }

    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Only PDF, JPG, PNG allowed.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File size must be under 2MB.");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Uploads folder not found.");
    }

    $newName = "portfolio_" . time() . "." . $ext;
    move_uploaded_file($file['tmp_name'], "uploads/" . $newName);

    return $newName;
}
/* =========================== */

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES['portfolio']);
        $message = "File uploaded successfully: " . $fileName;
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<h3>Upload Portfolio File</h3>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio"><br><br>
    <button type="submit">Upload</button>
</form>

<p><?php echo $message; ?></p>

<?php include "includes/footer.php"; ?>