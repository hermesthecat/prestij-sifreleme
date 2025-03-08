<?php
// Ensure proper character encoding
header('Content-Type: text/html; charset=utf-8');

// Function to encrypt text using the Vigenère cipher
function vigenereEncrypt($plaintext, $key) {
    if (empty($key)) {
        return "Error: Key cannot be empty";
    }

    $keyLength = strlen($key);
    $plaintextLength = strlen($plaintext);
    $ciphertext = "";

    // Convert key to uppercase for consistency
    $key = strtoupper($key);

    for ($i = 0; $i < $plaintextLength; $i++) {
        $plainChar = $plaintext[$i];
        $keyChar = $key[$i % $keyLength];
        
        // Only encrypt alphabetic characters
        if (ctype_alpha($plainChar)) {
            // Determine if the character is uppercase or lowercase
            $isUpper = ctype_upper($plainChar);
            
            // Convert to uppercase for calculation
            $plainChar = strtoupper($plainChar);
            
            // Calculate the shift
            $shift = ord($keyChar) - ord('A');
            
            // Apply the Vigenère cipher formula
            $encrypted = chr((ord($plainChar) - ord('A') + $shift) % 26 + ord('A'));
            
            // Preserve original case
            if (!$isUpper) {
                $encrypted = strtolower($encrypted);
            }
            
            $ciphertext .= $encrypted;
        } else {
            // Keep non-alphabetic characters unchanged
            $ciphertext .= $plainChar;
        }
    }

    return $ciphertext;
}

// Function to save text to a file
function saveToFile($text, $filename) {
    try {
        $file = fopen($filename, "w") or die("Unable to open file!");
        fwrite($file, $text);
        fclose($file);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST["key"] ?? '';
    $plaintext = $_POST["plaintext"] ?? '';
    
    // Validate input
    if (empty($key) || empty($plaintext)) {
        echo json_encode(['success' => false, 'message' => 'Both key and text are required']);
        exit;
    }

    // Encrypt the text
    $ciphertext = vigenereEncrypt($plaintext, $key);
    
    // Generate unique filename using timestamp
    $filename = 'encrypted_' . date('Y-m-d_H-i-s') . '.txt';
    
    // Save to file
    if (saveToFile($ciphertext, $filename)) {
        $response = [
            'success' => true,
            'message' => 'Text encrypted and saved successfully!',
            'filename' => $filename,
            'encrypted_text' => $ciphertext
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error saving the encrypted text'
        ];
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If not POST request, redirect to index
    header('Location: index.php');
}
?>