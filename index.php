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
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .result.success {
            border-color: #4CAF50;
            background-color: #f0fff0;
        }
        .result.error {
            border-color: #f44336;
            background-color: #fff0f0;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Vigenère Cipher Encryption</h1>
    <form id="encryptForm">
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
    <div id="result" class="result hidden">
        <h3>Result:</h3>
        <p id="message"></p>
        <div id="encryptedContent" class="hidden">
            <h4>Encrypted Text:</h4>
            <p id="encryptedText"></p>
            <h4>Saved to File:</h4>
            <p id="filename"></p>
        </div>
    </div>

    <script>
        document.getElementById('encryptForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // Disable submit button while processing
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Encrypting...';
            
            // Clear previous results
            const resultDiv = document.getElementById('result');
            const messageP = document.getElementById('message');
            const encryptedContent = document.getElementById('encryptedContent');
            resultDiv.className = 'result hidden';
            messageP.textContent = '';
            encryptedContent.className = 'hidden';
            
            // Send AJAX request
            fetch('encrypt.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Enable submit button
                submitButton.disabled = false;
                submitButton.textContent = 'Encrypt and Save';
                
                // Show result
                resultDiv.className = `result ${data.success ? 'success' : 'error'}`;
                resultDiv.classList.remove('hidden');
                messageP.textContent = data.message;
                
                // If successful, show encrypted content
                if (data.success) {
                    encryptedContent.classList.remove('hidden');
                    document.getElementById('encryptedText').textContent = data.encrypted_text;
                    document.getElementById('filename').textContent = data.filename;
                }
            })
            .catch(error => {
                // Enable submit button
                submitButton.disabled = false;
                submitButton.textContent = 'Encrypt and Save';
                
                // Show error
                resultDiv.className = 'result error';
                resultDiv.classList.remove('hidden');
                messageP.textContent = 'An error occurred while processing your request.';
            });
        });
    </script>
</body>
</html>