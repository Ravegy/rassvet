<?php
// db.php — Файл подключения к базе данных InfinityFree

// Данные с твоего скриншота
$host = 'sql101.infinityfree.com';
$db   = 'if0_40935940_rassvet';
$user = 'if0_40935940'; // Обычно логин совпадает с началом имени базы
$pass = 'I1Wqh6oS6W'; // Вставь сюда пароль от панели хостинга (не от входа в личный кабинет, а именно от FTP/MySQL)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Вывод ошибки для отладки. На рабочем сайте лучше убрать echo.
    die("Ошибка подключения к БД: " . $e->getMessage());
}
?>