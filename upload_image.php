<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $uploadDir = 'uploads/';  // Specify the directory to store uploads
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error: Unable to upload image.";
        }
    } else {
        echo "Error: Image file not received.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
