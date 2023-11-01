$(document).ready(function() {
    function updateChat() {
        $.ajax({
            url: 'get_messages.php',
            type: 'GET',
            success: function(data) {
                // Wrap chat messages in div elements with the 'chat-message' class
                var chatMessages = data.split('\n');
                var formattedMessages = '';
                chatMessages.forEach(function(chatMessage) {
                    if (chatMessage.trim() !== '') {
                        // Split the chat message into name and message
                        var parts = chatMessage.split(': ');
                        if (parts.length > 1) {
                            // Display only the message part, excluding the name
                            formattedMessages += '<div class="chat-message">' + parts[1] + '</div>';
                        } else {
                            // If there's no name part, display the entire chat message
                            formattedMessages += '<div class="chat-message">' + chatMessage + '</div>';
                        }
                    }
                });
                $('#chat-messages').html(formattedMessages);
            },
            error: function() {
                console.log('Error fetching chat messages.');
            }
        });
    }

    $('#image-upload').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;

                // Resize the image (e.g., maximum width of 100px)
                img.style.maxWidth = '100px';

                $('#chat-messages').append(img);

                // Scroll to the bottom after displaying the image
                scrollChatToBottom();
            };
            reader.readAsDataURL(file);

            // Upload the file using FormData and AJAX to the server
            var formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url: 'upload_image.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    // Handle successful upload (if needed)
                },
                error: function() {
                    console.log('Error uploading image.');
                }
            });
        }
    });

    // ... the rest of your code ...

    // Periodically call the updateChat function to refresh messages
    setInterval(updateChat, 0100);

    // Submit message using AJAX
    $('#chat-form').submit(function(e) {
        e.preventDefault();
        var message = $('#message').val();
        if (message.trim() !== '') {
            $.ajax({
                url: 'send_message.php',
                type: 'POST',
                data: { message: message },
                success: function() {
                    // Clear the input field
                    $('#message').val('');
                    // Immediately update chat after sending the message
                    updateChat();
                },
                error: function() {
                    console.log('Error sending chat message.');
                }
            });
        }
    });
});
