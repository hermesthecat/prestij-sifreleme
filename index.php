<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenère Cipher Encryption</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 150px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: none;
        }
    </style>
</head>
<body>
    <h1>Vigenère Cipher Encryption</h1>
    <form action="encrypt.php" method="POST">
        <div class="form-group">
            <label for="key">Encryption Key:</label>
            <input type="text" id="key" name="key" required placeholder="Enter your encryption key">
        </div>
        <div class="form-group">
            <label for="plaintext">Text to Encrypt:</label>
            <textarea id="plaintext" name="plaintext" required placeholder="Enter the text you want to encrypt"></textarea>
        </div>
        <button type="submit">Encrypt and Save</button>
    </form>
    <div id="result" class="result"></div>
</body>
</html>