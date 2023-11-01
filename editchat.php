<?php
// Define the file to edit
$filename = 'chat.txt';

// Check if the file exists
if (file_exists($filename)) {
    // Read the content of the file
    $chatContent = file_get_contents($filename);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
        // Handle form submission
        $newContent = $_POST['content'];
        
        // Open the file for writing
        if ($file = fopen($filename, 'w')) {
            // Write the new content to the file
            fwrite($file, $newContent);
            fclose($file);
            $chatContent = $newContent;
            echo "File has been updated successfully.";
        } else {
            echo "Failed to open the file for writing.";
        }
    }
} else {
    $chatContent = 'Chat file not found.';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Chat</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Edit Chat</h1>
    <form method="post">
        <textarea name="content" rows="10" cols="50"><?php echo $chatContent; ?></textarea>
        <br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
