<?php
// send.php - Универсальный обработчик (Контакты + Корзина)
header('Content-Type: application/json');

// Конфигурация для файлов
$MAX_FILE_SIZE = 10 * 1024 * 1024; // 10 MB
$ALLOWED_TYPES = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
    exit;
}

try {
    // Подключаем твой конфиг с токенами
    $config = require 'config.php';
    if (!isset($config['tg_token']) || !isset($config['tg_chat_id'])) {
        throw new Exception('Config Error');
    }

    // Проверяем, пришел ли JSON (Заказ из корзины)
    $inputJSON = file_get_contents('php://input');
    $jsonData = json_decode($inputJSON, true);

    $endpoint = 'sendMessage';
    $post_fields = [
        'chat_id' => $config['tg_chat_id'],
        'parse_mode' => 'HTML'
    ];

    if ($jsonData) {
        // === ЛОГИКА ОФОРМЛЕНИЯ ЗАКАЗА (JSON) ===
        
        $type = $jsonData['type'] ?? 'individual';
        $phone = isset($jsonData['phone']) ? preg_replace('/\D/', '', $jsonData['phone']) : '';
        $email = isset($jsonData['email']) ? trim($jsonData['email']) : '';
        $comment = isset($jsonData['comment']) ? trim($jsonData['comment']) : '';

        if (strlen($phone) < 10) throw new Exception('Некорректный номер телефона');

        $typeLabel = ($type === 'legal') ? '🏢 Юр. лицо' : '👤 Физ. лицо';
        $txt = "<b>🛒 НОВЫЙ ЗАКАЗ</b>\n";
        $txt .= "--------------------------------\n";
        $txt .= "<b>Тип:</b> $typeLabel\n";

        if ($type === 'individual') {
            $name = trim($jsonData['name'] ?? '');
            if (mb_strlen($name) < 2) throw new Exception('Введите имя');
            $txt .= "👤 <b>Имя:</b> " . htmlspecialchars($name) . "\n";
        } else {
            $company = trim($jsonData['company_name'] ?? '');
            $inn = trim($jsonData['inn'] ?? '');
            if (mb_strlen($company) < 1) throw new Exception('Введите название компании');
            if (mb_strlen($inn) < 10) throw new Exception('Введите ИНН');
            
            $txt .= "🏢 <b>Компания:</b> " . htmlspecialchars($company) . "\n";
            $txt .= "🆔 <b>ИНН:</b> " . htmlspecialchars($inn) . "\n";
            if (!empty($jsonData['kpp'])) $txt .= "📑 <b>КПП:</b> " . htmlspecialchars($jsonData['kpp']) . "\n";
            if (!empty($jsonData['contact_person'])) $txt .= "👤 <b>Контакт:</b> " . htmlspecialchars($jsonData['contact_person']) . "\n";
        }

        $txt .= "📞 <b>Тел:</b> +" . htmlspecialchars($phone) . "\n";
        if ($email) $txt .= "✉️ <b>Email:</b> " . htmlspecialchars($email) . "\n";
        if ($comment) $txt .= "💬 <b>Комментарий:</b> " . htmlspecialchars($comment) . "\n";

        // Товары
        if (!empty($jsonData['cart']) && is_array($jsonData['cart'])) {
            $txt .= "\n<b>📦 СОСТАВ ЗАКАЗА:</b>\n";
            $i = 1;
            foreach ($jsonData['cart'] as $item) {
                $qty = $item['qty'] ?? 1;
                $art = htmlspecialchars($item['number']);
                $name = htmlspecialchars($item['name']);
                $txt .= "$i. <b>$art</b> — $name (x$qty)\n";
                $i++;
            }
        }
        
        $post_fields['text'] = $txt;

    } else {
        // === ЛОГИКА ОБЫЧНОЙ ФОРМЫ (как было раньше) ===
        
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $phone = isset($_POST['phone']) ? preg_replace('/\D/', '', $_POST['phone']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

        if (mb_strlen($name) < 2) throw new Exception('Введите корректное имя');
        if (strlen($phone) < 10) throw new Exception('Некорректный номер телефона');
        // if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception('Error Email'); // Можно раскомментировать при желании

        $txt = "<b>🔔 СООБЩЕНИЕ С САЙТА</b>\n";
        $txt .= "👤 <b>Имя:</b> " . htmlspecialchars($name) . "\n";
        $txt .= "📱 <b>Тел:</b> +" . htmlspecialchars($phone) . "\n";
        if ($email) $txt .= "📧 <b>Email:</b> " . htmlspecialchars($email) . "\n";
        if ($message) $txt .= "💬 <b>Сообщение:</b>\n" . htmlspecialchars($message) . "\n";
        $txt .= "\n🚀 <i>" . date('d.m.Y H:i') . "</i>";

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
    }

    // Отправка в Telegram (cURL)
    $ch = curl_init("https://api.telegram.org/bot{$config['tg_token']}/{$endpoint}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    
    $result = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) throw new Exception("Ошибка соединения: $error");
    
    $json = json_decode($result, true);
    if (!$json || !$json['ok']) throw new Exception("Telegram API Error");

    echo json_encode(['status' => 'success', 'message' => 'Отправлено успешно!']);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>