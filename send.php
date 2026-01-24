<?php
// send.php - Secure & Strict
header('Content-Type: application/json');

// Конфигурация
$MAX_FILE_SIZE = 10 * 1024 * 1024; // 10 MB
$ALLOWED_TYPES = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
    exit;
}

try {
    $config = require 'config.php';
    if (!isset($config['tg_token']) || !isset($config['tg_chat_id'])) {
        throw new Exception('Config Error');
    }

    // Валидация данных
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? preg_replace('/\D/', '', $_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

    if (mb_strlen($name) < 2) throw new Exception('Введите корректное имя');
    if (strlen($phone) !== 11) throw new Exception('Некорректный номер телефона');
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception('Некорректный Email');

    // Формирование сообщения
    $txt = "<b>🔔 НОВАЯ ЗАЯВКА</b>\n";
    $txt .= "👤 <b>Имя:</b> " . htmlspecialchars($name) . "\n";
    $txt .= "📱 <b>Тел:</b> +" . htmlspecialchars($phone) . "\n";
    if ($email) $txt .= "📧 <b>Email:</b> " . htmlspecialchars($email) . "\n";
    if ($message) $txt .= "💬 <b>Сообщение:</b>\n" . htmlspecialchars($message) . "\n";
    $txt .= "\n🚀 <i>" . date('d.m.Y H:i') . "</i>";

    // Подготовка отправки
    $post_fields = [
        'chat_id' => $config['tg_chat_id'],
        'parse_mode' => 'HTML'
    ];

    $endpoint = 'sendMessage';
    
    // Обработка файла
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        
        if ($file['size'] > $MAX_FILE_SIZE) throw new Exception('Файл слишком большой (макс 10Мб)');
        if (!in_array($file['type'], $ALLOWED_TYPES)) throw new Exception('Недопустимый формат файла');
        
        $endpoint = 'sendDocument';
        $post_fields['caption'] = $txt;
        $post_fields['document'] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
    } else {
        $post_fields['text'] = $txt;
    }

    // cURL запрос
    $ch = curl_init("https://api.telegram.org/bot{$config['tg_token']}/{$endpoint}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Включаем проверку SSL!
    
    $result = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) throw new Exception("Ошибка соединения: $error");
    
    $json = json_decode($result, true);
    if (!$json || !$json['ok']) throw new Exception("Telegram API Error");

    echo json_encode(['status' => 'success', 'message' => 'Заявка отправлена!']);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>