<?php
header('Content-Type: application/json');

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
if (strlen($query) < 2) { echo json_encode([]); exit; }

// Подключаем реестр моделей
$models = require __DIR__ . '/../data/models_registry.php';
$results = [];
$limit = 10; // Ограничение подсказок

foreach ($models as $model) {
    if (file_exists($model['data_file'])) {
        $data = require $model['data_file'];
        
        // Проходимся по всем группам запчастей
        if (isset($data['parts'])) {
            foreach ($data['parts'] as $subgroupId => $partsList) {
                foreach ($partsList as $part) {
                    // Ищем совпадение в Артикуле или Названии
                    // stripos - поиск без учета регистра
                    if (stripos($part['number'], $query) !== false || stripos($part['name'], $query) !== false) {
                        
                        // Формируем уникальный ключ, чтобы не дублировать одинаковые запчасти
                        $key = $part['number'];
                        
                        if (!isset($results[$key])) {
                            $results[$key] = [
                                'number' => $part['number'],
                                'name' => $part['name'],
                                'label' => $part['number'] . ' ' . $part['name']
                            ];
                        }
                    }
                    if (count($results) >= $limit) break 3; // Прерываем поиск если нашли достаточно
                }
            }
        }
    }
}

echo json_encode(array_values($results));