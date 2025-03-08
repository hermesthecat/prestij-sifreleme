# Project: Vigenère Cipher Application

## Description

This project involves creating a PHP web application that uses the Vigenère cipher to encrypt and decrypt text. The application will:

1.  Ask the user for a keyword.
2.  Encrypt or decrypt the text using the Vigenère cipher with the provided keyword.
3.  Save the result to a `.txt` file.

## Plan

1.  **Implement the Vigenère Cipher:** Create functions for both encryption and decryption.
2.  **Create the User Interface:** Design a user-friendly web interface with separate modes for encryption and decryption.
3.  **Implement AJAX Submission:** Use AJAX to submit the form and display the results without a page reload.
4.  **Implement File Saving:** Save the encrypted or decrypted text to a file with a unique name.
5.  **Update Memory Bank:** Keep track of design decisions, system patterns, and progress in the memory bank.

## PHP Application Structure

```php
<?php

// Function to encrypt text using the Vigenère cipher
function vigenereEncrypt($plaintext, $key) {
    // ... encryption logic ...
}

// Function to decrypt text using the Vigenère cipher
function vigenereDecrypt($ciphertext, $key) {
    // ... decryption logic ...
}

// Function to save text to a file
function saveToFile($text, $filename) {
    // ... file saving logic ...
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... form processing logic ...
}

?>
```

## Key Improvements

*   Added decryption functionality.
*   Implemented AJAX form submission for a better user experience.
*   Created a mode switch for encryption and decryption.
*   Updated the memory bank to track design decisions and progress.