<?php
// send.php
ini_set('display_errors', 0);
error_reporting(0);
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Forbidden']);
    exit;
}

$config = require 'config.php';

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

// 1. Валидация Имени
if (empty($name) || mb_strlen($name) < 2 || !preg_match('/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u', $name)) {
    echo json_encode(['status' => 'error', 'message' => 'Введите корректное имя']);
    exit;
}

// 2. Валидация Телефона (только длина цифр)
$phoneDigits = preg_replace('/\D/', '', $phone);
if (strlen($phoneDigits) !== 11) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный номер телефона']);
    exit;
}

// 3. Валидация Email (если есть)
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный Email']);
    exit;
}

// Формируем сообщение
$txt = "<b>🔔 НОВАЯ ЗАЯВКА (Сайт)</b>\n";
$txt .= "👤 <b>Имя:</b> " . htmlspecialchars($name) . "\n";
$txt .= "📱 <b>Телефон:</b> " . htmlspecialchars($phone) . "\n";
if (!empty($email)) $txt .= "📧 <b>Email:</b> " . htmlspecialchars($email) . "\n";
if (!empty($message)) $txt .= "💬 <b>Сообщение:</b> " . htmlspecialchars($message) . "\n";
$txt .= "\n🚀 <i>" . date('d.m.Y H:i') . "</i>";

$token = $config['tg_token'];
$chat_id = $config['tg_chat_id'];

// Отправка
$post_fields = [
    'chat_id' => $chat_id,
    'parse_mode' => 'HTML'
];

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $url = "https://api.telegram.org/bot" . $token . "/sendDocument";
    $post_fields['caption'] = $txt;
    $post_fields['document'] = new CURLFile($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
} else {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
    $post_fields['text'] = $txt;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);

if ($json && $json['ok']) {
    echo json_encode(['status' => 'success', 'message' => 'Заявка отправлена!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка Telegram API']);
}
?>