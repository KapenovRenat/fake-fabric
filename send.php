<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$to = 'damirsekrenov@gmail.com';
$name    = htmlspecialchars(trim($_POST['name']    ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone']   ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

if (empty($name) || empty($phone)) {
    header('Location: index.html?status=error');
    exit;
}

$subject = "Новая заявка с сайта — $name";
$body    = "Имя: $name\nТелефон: $phone\nСообщение:\n$message";
$headers = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n" .
           "Reply-To: $phone\r\n" .
           "Content-Type: text/plain; charset=UTF-8";

if (mail($to, $subject, $body, $headers)) {
    header('Location: index.html?status=success');
} else {
    header('Location: index.html?status=error');
}
exit;
