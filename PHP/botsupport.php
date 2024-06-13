<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];
$userName = $data['userName'];

$url = 'http://localhost:81/send-message';

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode(['message' => $message, 'userName' => $_SESSION['login']]),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
?>