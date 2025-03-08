<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenère Cipher</title>
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
            margin-right: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
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
        .mode-switch {
            margin-bottom: 20px;
            text-align: center;
        }
        .mode-switch button {
            background-color: #2196F3;
        }
        .mode-switch button:hover {
            background-color: #1976D2;
        }
        .mode-switch button.active {
            background-color: #1565C0;
        }
        .copy-button {
            background-color: #607D8B;
            margin-top: 10px;
        }
        .copy-button:hover {
            background-color: #546E7A;
        }
        .copy-success {
            color: #4CAF50;
            margin-top: 5px;
            font-size: 0.9em;
            display: none;
        }
    </style>
</head>
<body>
    <h1>Vigenère Cipher</h1>
    
    <div class="mode-switch">
        <button type="button" data-mode="encrypt" class="active">Encryption Mode</button>
        <button type="button" data-mode="decrypt">Decryption Mode</button>
    </div>

    <form id="cipherForm">
        <input type="hidden" id="mode" name="mode" value="encrypt">
        
        <div class="form-group">
            <label for="key">Key:</label>
            <input type="text" id="key" name="key" required placeholder="Enter your encryption/decryption key">
        </div>
        
        <div class="form-group">
            <label for="text" id="textLabel">Text to Encrypt:</label>
            <textarea id="text" name="text" required placeholder="Enter the text"></textarea>
        </div>
        
        <button type="submit" id="submitBtn">Encrypt Text</button>
    </form>

    <div id="result" class="result hidden">
        <h3>Result:</h3>
        <p id="message"></p>
        <div id="resultContent" class="hidden">
            <h4 id="resultLabel">Encrypted Text:</h4>
            <p id="resultText"></p>
            <button id="copyButton" class="copy-button" onclick="copyToClipboard()">
                Copy to Clipboard
            </button>
            <p id="copySuccess" class="copy-success">Copied to clipboard!</p>
            <h4>Saved to File:</h4>
            <p id="filename"></p>
        </div>
    </div>

    <script>
        // Mode switching
        const modeSwitchButtons = document.querySelectorAll('.mode-switch button');
        const modeInput = document.getElementById('mode');
        const textLabel = document.getElementById('textLabel');
        const submitBtn = document.getElementById('submitBtn');
        const resultLabel = document.getElementById('resultLabel');

        modeSwitchButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                modeSwitchButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Update mode
                const mode = this.dataset.mode;
                modeInput.value = mode;

                // Update labels
                textLabel.textContent = mode === 'encrypt' ? 'Text to Encrypt:' : 'Text to Decrypt:';
                submitBtn.textContent = mode === 'encrypt' ? 'Encrypt Text' : 'Decrypt Text';
                resultLabel.textContent = mode === 'encrypt' ? 'Encrypted Text:' : 'Decrypted Text:';

                // Clear form and results
                document.getElementById('cipherForm').reset();
                document.getElementById('result').className = 'result hidden';
            });
        });

        // Copy to clipboard function
        function copyToClipboard() {
            const resultText = document.getElementById('resultText').textContent;
            navigator.clipboard.writeText(resultText).then(() => {
                const copySuccess = document.getElementById('copySuccess');
                copySuccess.style.display = 'block';
                setTimeout(() => {
                    copySuccess.style.display = 'none';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        // Form submission
        document.getElementById('cipherForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // Disable submit button while processing
            submitBtn.disabled = true;
            submitBtn.textContent = formData.get('mode') === 'encrypt' ? 'Encrypting...' : 'Decrypting...';
            
            // Clear previous results
            const resultDiv = document.getElementById('result');
            const messageP = document.getElementById('message');
            const resultContent = document.getElementById('resultContent');
            resultDiv.className = 'result hidden';
            messageP.textContent = '';
            resultContent.className = 'hidden';
            
            // Send AJAX request
            fetch('cipher.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = formData.get('mode') === 'encrypt' ? 'Encrypt Text' : 'Decrypt Text';
                
                // Show result
                resultDiv.className = `result ${data.success ? 'success' : 'error'}`;
                resultDiv.classList.remove('hidden');
                messageP.textContent = data.message;
                
                // If successful, show result content
                if (data.success) {
                    resultContent.classList.remove('hidden');
                    document.getElementById('resultText').textContent = data.result_text;
                    document.getElementById('filename').textContent = data.filename;
                }
            })
            .catch(error => {
                // Enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = formData.get('mode') === 'encrypt' ? 'Encrypt Text' : 'Decrypt Text';
                
                // Show error
                resultDiv.className = 'result error';
                resultDiv.classList.remove('hidden');
                messageP.textContent = 'An error occurred while processing your request.';
            });
        });
    </script>
</body>
</html>