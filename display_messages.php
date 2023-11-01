<?php
// Read chat messages from a file (e.g., chat.txt)
$chatFile = 'chat.txt';
$chatMessages = file_get_contents($chatFile);

// Split chat messages into an array by newline character
$messagesArray = explode("\n", $chatMessages);

// Display each message
foreach ($messagesArray as $message) {
    if (!empty($message)) {
        // You can format the message as needed, e.g., by wrapping it in a <div> element
        echo '<div class="chat-message">' . htmlspecialchars($message) . '</div>';
    }
}
?>
