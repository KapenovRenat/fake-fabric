<?php
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false]);
    exit;
}

$to = 'damirsekrenov@gmail.com';
$name    = htmlspecialchars(trim($_POST['name']    ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone']   ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

if (empty($name) || empty($phone)) {
    echo json_encode(['ok' => false]);
    exit;
}

$subject = "Новая заявка с сайта — Fenix Mebel";
$body    = "Имя: $name\nТелефон: $phone\nСообщение:\n$message";
$headers = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n" .
           "Content-Type: text/plain; charset=UTF-8";

echo json_encode(['ok' => mail($to, $subject, $body, $headers)]);
