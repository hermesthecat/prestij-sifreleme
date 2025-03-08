# Vigenère Cipher Encryption Application

This PHP application implements the Vigenère cipher encryption method and saves encrypted text to files.

## Features

- Vigenère cipher encryption
- Case preservation (maintains uppercase/lowercase)
- Special character preservation
- Automatic file saving with timestamp
- Simple web interface

## Usage

1. Place `index.php` and `encrypt.php` in your web server directory
2. Access `index.php` through a web browser
3. Enter your encryption key (e.g., "LEMON")
4. Enter the text you want to encrypt
5. Click "Encrypt and Save"
6. The encrypted text will be saved to a file named `encrypted_YYYY-MM-DD_HH-mm-ss.txt`

## Requirements

- PHP web server
- Write permissions in the application directory

## Example

Input:
- Key: "LEMON"
- Text: "ATTACK AT DAWN"

Output:
- Encrypted Text: "LXFOPV EF RPWN"
- Saved to: `encrypted_2025-03-08_15-30-58.txt`