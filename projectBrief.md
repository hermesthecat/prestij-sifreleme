# Project: Vigenère Cipher PHP Application

## Description

This project involves creating a PHP application that uses the Vigenère cipher to encrypt text. The application will:

1.  Ask the user for a keyword.
2.  Encrypt the text using the Vigenère cipher with the provided keyword.
3.  Save the encrypted text to a `.txt` file.

## Plan

1.  **Outline the PHP Application Structure:** Define the basic structure of the PHP application, including the necessary functions and variables.
2.  **Create the Encryption Function:** Implement the Vigenère encryption function in PHP.
3.  **Create the File Saving Function:** Implement the function to save the encrypted text to a `.txt` file.
4.  **Create the User Interface:** Create a simple user interface to get the keyword and the text to encrypt.
5.  **Integrate the Functions:** Integrate the encryption and file saving functions into the user interface.

## PHP Application Structure

```php
<?php

// Function to encrypt text using the Vigenère cipher
function vigenereEncrypt($plaintext, $key) {
  $keyLength = strlen($key);
  $plaintextLength = strlen($plaintext);
  $ciphertext = "";

  for ($i = 0; $i < $plaintextLength; $i++) {
    $keyChar = $key[$i % $keyLength];
    $keyShift = ord(strtoupper($keyChar)) - ord('A'); // Get shift value from key

    $plainChar = $plaintext[$i];
    if (ctype_alpha($plainChar)) { // Only encrypt alphabetic characters
      $start = ctype_upper($plainChar) ? ord('A') : ord('a');
      $shiftedChar = chr((ord($plainChar) - $start + $keyShift) % 26 + $start);
    } else {
      $shiftedChar = $plainChar; // Keep non-alphabetic characters as is
    }
    $ciphertext .= $shiftedChar;
  }

  return $ciphertext;
}

// Function to save text to a file
function saveToFile($text, $filename) {
  $file = fopen($filename, "w") or die("Unable to open file!");
  fwrite($file, $text);
  fclose($file);
}

// Get keyword from user (e.g., via HTML form)
$key = $_POST["key"];

// Get plaintext from user (e.g., via HTML form)
$plaintext = $_POST["plaintext"];

// Encrypt the plaintext
$ciphertext = vigenereEncrypt($plaintext, $key);

// Save the ciphertext to a file
$filename = "encrypted.txt";
saveToFile($ciphertext, $filename);

echo "Encrypted text saved to " . $filename;

?>