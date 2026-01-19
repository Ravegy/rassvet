<?php
// Отключаем вывод ошибок в браузер, чтобы не ломать JSON
ini_set('display_errors', 0);
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Forbidden']);
    exit;
}

$config = require 'config.php';

// Получаем данные
$name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

// Валидация
if (empty($name) || strlen($name) < 2) {
    echo json_encode(['status' => 'error', 'message' => 'Введите корректное имя']);
    exit;
}

// Очистка телефона для проверки
$phoneDigits = preg_replace('/\D/', '', $phone);
if (empty($phone) || strlen($phoneDigits) < 10) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный телефон']);
    exit;
}

// Формируем текст (или подпись к файлу)
$txt = "<b>🔔 НОВАЯ ЗАЯВКА</b>\n";
$txt .= "👤 <b>Имя:</b> " . $name . "\n";
$txt .= "📱 <b>Телефон:</b> " . $phone . "\n";
if (!empty($email)) $txt .= "📧 <b>Email:</b> " . $email . "\n";
if (!empty($message)) $txt .= "💬 <b>Сообщение:</b> " . $message . "\n";
$txt .= "\n🚀 <i>" . date('d.m.Y H:i') . "</i>";

$token = $config['tg_token'];
$chat_id = $config['tg_chat_id'];

// --- ЛОГИКА ОТПРАВКИ ФАЙЛА ---
$file_attached = false;
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    
    // Telegram API URL для документов
    $url = "https://api.telegram.org/bot" . $token . "/sendDocument";
    
    // Используем CURLFile для отправки файла
    $post_fields = [
        'chat_id' => $chat_id,
        'caption' => $txt,
        'parse_mode' => 'HTML',
        'document' => new CURLFile($file_tmp, $_FILES['file']['type'], $file_name)
    ];
    
    $file_attached = true;
} else {
    // Если файла нет, отправляем просто текст
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
    $post_fields = [
        'chat_id' => $chat_id,
        'text' => $txt,
        'parse_mode' => 'HTML'
    ];
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
    echo json_encode(['status' => 'success', 'message' => 'Заявка успешно отправлена!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка отправки в Telegram']);
}
?>