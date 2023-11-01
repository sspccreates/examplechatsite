<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_POST['file'];
    $content = $_POST['content'];

    if (file_exists($file)) {
        file_put_contents($file, $content);
        echo "File $file has been updated.";
    } else {
        echo "File not found: $file";
    }
}

$files = glob('*.*'); // Get a list of all files in the current directory
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        textarea {
            height: 300px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Files</h1>

    <form method="post">
        <select name="file" id="fileSelect">
            <?php
            foreach ($files as $file) {
                echo "<option value=\"$file\">$file</option>";
            }
            ?>
        </select>
        <br><br>
        <textarea name="content" id="fileContent" rows="10" cols="50">
            <?php
            if (isset($_POST['file'])) {
                $selectedFile = $_POST['file'];
                if (file_exists($selectedFile)) {
                    $fileContent = file_get_contents($selectedFile);
                    echo htmlspecialchars($fileContent, ENT_QUOTES);
                }
            }
            ?>
        </textarea>
        <br><br>
        <input type="submit" value="Save Changes">
    </form>

    <script>
        // Add event listener to update the textarea when the file selection changes
        document.getElementById('fileSelect').addEventListener('change', function() {
            var selectedFile = this.value;
            if (selectedFile) {
                var textarea = document.getElementById('fileContent');
                // Make an AJAX request to get the content of the selected file
                var xhr = new XMLHttpRequest();
                xhr.open('GET', selectedFile, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        textarea.value = xhr.responseText;
                    }
                };
                xhr.send();
            }
        });
    </script>
</body>
</html>
