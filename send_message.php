<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];

    // Validate that the message is not empty
    if (!empty($message)) {
        // Sanitize input
        $message = htmlspecialchars($message);

        // Create the message format without the name
        $message = $message . "\n";

        // Open and append to the chat.txt file
        $file = fopen('chat.txt', 'a');

        if ($file) {
            fwrite($file, $message);
            fclose($file);
            echo "Message sent successfully!";
        } else {
            echo "Error: Unable to open chat file.";
        }
    } else {
        echo "Error: Message cannot be empty.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
