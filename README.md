# Vigenère Cipher Application

A PHP web application that implements the Vigenère cipher for both encryption and decryption of text messages.

## Features

*   Encryption and decryption using Vigenère cipher
*   Case preservation (maintains uppercase/lowercase)
*   Special character preservation
*   Automatic file saving with timestamp
*   AJAX-based form submission
*   Real-time feedback

## Usage

1. Place all files in your web server directory
2. Access `index.php` through a web browser
3. Choose mode (Encryption or Decryption)
4. Enter your key (e.g., "LEMON")
5. Enter the text to process
6. Click "Encrypt Text" or "Decrypt Text"
7. The result will be displayed and saved to a file

## Example

### Encryption
Input:
- Mode: Encryption
- Key: "LEMON"
- Text: "ATTACK AT DAWN"

Output:
- Encrypted Text: "LXFOPV EF RPWN"
- Saved to: `encrypted_2025-03-08_20-25-40.txt`

### Decryption
Input:
- Mode: Decryption
- Key: "LEMON"
- Text: "LXFOPV EF RPWN"

Output:
- Decrypted Text: "ATTACK AT DAWN"
- Saved to: `decrypted_2025-03-08_20-25-40.txt`

## Files

*   `index.php` - User interface
*   `cipher.php` - Encryption/decryption logic
*   `README.md` - This documentation

## Requirements

*   PHP web server
*   Write permissions in the application directory

## Error Handling

The application includes comprehensive error handling:
*   Input validation
*   File operation validation
*   User-friendly error messages
*   Visual feedback for success/error states