<?php
// Получаем артикул
$searchNumber = isset($_GET['number']) ? trim($_GET['number']) : '';
if (!$searchNumber) { header('Location: catalog.php'); exit; }

// Подключаем реестр
$models = require __DIR__ . '/data/models_registry.php';

$foundPartInfo = null; // Здесь сохраним описание
$usedIn = []; // Список вхождений: [Model, Path, Link]

// --- ЛОГИКА ПОИСКА ---
foreach ($models as $model) {
    if (!file_exists($model['data_file'])) continue;
    
    $data = require $model['data_file'];
    $modelName = $data['info']['model'];
    
    if (isset($data['parts'])) {
        foreach ($data['parts'] as $subgroupId => $partsList) {
            foreach ($partsList as $part) {
                if ($part['number'] === $searchNumber) {
                    if (!$foundPartInfo) {
                        $foundPartInfo = $part;
                    }

                    // Попытка найти имя подгруппы
                    $subgroupName = "Неизвестный узел";
                    foreach ($data as $key => $value) {
                        if (is_array($value) && $key !== 'parts' && $key !== 'groups' && $key !== 'info') {
                            foreach ($value as $item) {
                                if ($item['id'] == $subgroupId) {
                                    $subgroupName = $item['name'];
                                }
                            }
                        }
                    }

                    // Формируем ссылку
                    $link = $model['url'] . "?id=" . $subgroupId;

                    $usedIn[] = [
                        'model' => $modelName,
                        'article' => $part['number'],
                        'path' => $subgroupName,
                        'link' => $link
                    ];
                }
            }
        }
    }
}

// Если ничего не нашли
if (!$foundPartInfo && empty($usedIn)) {
    die("Запчасть с артикулом $searchNumber не найдена.");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $foundPartInfo['name'] ?> (<?= $searchNumber ?>) | Поиск запчастей</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css?v=<?= file_exists(__DIR__ . '/css/style.css') ? filemtime(__DIR__ . '/css/style.css') : time(); ?>">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="content-padding">
        <div class="container">
            <div style="margin-bottom: 20px;">
                <button onclick="history.back()" class="tech-back-btn">
                    <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>Назад</span>
                </button>
            </div>

            <div class="section-header" style="margin-bottom: 40px;">
                Информация о запчасти
            </div>

            <div class="part-details-grid">
                
                <div class="pd-info-card">
                    <div class="pd-header">
                        <div class="pd-number"><?= $foundPartInfo['number'] ?></div>
                        <h1 class="pd-name"><?= $foundPartInfo['name'] ?></h1>
                    </div>
                    <div class="pd-body">
                        <div class="pd-row">
                            <span class="pd-label">Артикул:</span>
                            <span class="pd-value brand-green"><?= $foundPartInfo['number'] ?></span>
                        </div>
                        <div class="pd-row">
                            <span class="pd-label">Наименование:</span>
                            <span class="pd-value"><?= $foundPartInfo['name'] ?></span>
                        </div>
                        <div class="pd-row">
                            <span class="pd-label">Спецификация:</span>
                            <span class="pd-value"><?= $foundPartInfo['spec'] ?? '-' ?></span>
                        </div>
                        <div class="pd-row">
                            <span class="pd-label">Кол-во на узле:</span>
                            <span class="pd-value"><?= $foundPartInfo['qty'] ?? '1' ?></span>
                        </div>
                    </div>
                    <div class="pd-actions">
                        <button class="btn-primary" style="width: 100%;">Запросить цену</button>
                    </div>
                </div>

                <div class="pd-usage-card">
                    <h3 class="pd-usage-title">Использовалось в:</h3>
                    
                    <div class="usage-table-wrapper">
                        <table class="usage-table">
                            <thead>
                                <tr>
                                    <th>Модель</th>
                                    <th>Артикул</th>
                                    <th>Узел</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($usedIn as $row): ?>
                                <tr onclick="window.location.href='<?= $row['link'] ?>'">
                                    <td class="ut-model"><?= $row['model'] ?></td>
                                    <td class="ut-art"><?= $row['article'] ?></td>
                                    <td class="ut-path">
                                        <?= $row['path'] ?> 
                                        <svg class="ut-arrow" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>