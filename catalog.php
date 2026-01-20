<?php
$current_cat = isset($_GET['cat']) ? $_GET['cat'] : null;
$current_brand = isset($_GET['brand']) ? $_GET['brand'] : null;

$cat_names = [
    'harvesters' => 'Лесозаготовительные машины',
    'forwarders' => 'Форвардеры',
    'heads'      => 'Головки лесозаготовительные',
    'tracked'    => 'Гусеничные комбайны',
    'accessories'=> 'Аксессуары',
    'equipment'  => 'Оборудование'
];

$cats_with_brands = ['harvesters', 'forwarders', 'heads', 'tracked'];

$page_title = 'КАТАЛОГ KOMATSU FOREST';
if ($current_cat && isset($cat_names[$current_cat])) {
    $page_title = $cat_names[$current_cat];
    if ($current_brand) {
        $page_title = strtoupper($current_brand) . ' - ' . $page_title;
    }
}

// Данные моделей (пример для Харвестеров Komatsu)
$komatsu_harvesters = [
    ['model' => '901.4', 'serial' => '9010041151'],
    ['model' => '901',   'serial' => '9010053267'],
    ['model' => '901',   'serial' => '9010064241'],
    ['model' => '901XC', 'serial' => '9013050237'],
    ['model' => '901XC', 'serial' => '9013061241'],
    ['model' => '901TX', 'serial' => '9011000128'],
    ['model' => '901TX.1', 'serial' => '9011011135'],
    ['model' => '911.4', 'serial' => '9110041151'],
    ['model' => '911.5', 'serial' => '9110050001'],
    ['model' => '911',   'serial' => '9110062167'],
    ['model' => '911',   'serial' => '9110073241'],
    ['model' => '911',   'serial' => '9112062167'],
    ['model' => '911',   'serial' => '9112073271'],
    ['model' => '931',   'serial' => '9310000125'],
    ['model' => '931.1', 'serial' => '9310010001'],
    ['model' => '931',   'serial' => '9310021067'],
    ['model' => '931',   'serial' => '9310033241'],
    ['model' => '931XC', 'serial' => '9313021208'],
    ['model' => '931XC', 'serial' => '9313032241'],
    ['model' => '941.1', 'serial' => '9410013175'],
    ['model' => '951',   'serial' => '9510004367'],
    ['model' => '951',   'serial' => '9510015241'],
    ['model' => '951XC', 'serial' => '9513010271']
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo strip_tags($page_title); ?> | РАССВЕТ-С</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="toast-container"></div>
    
    <section class="hero" style="padding: 80px 0 30px;">
        <div class="container">
            <?php if ($current_brand): ?>
                <div style="margin-bottom: 20px; text-align: center;">
                    <a href="catalog.php?cat=<?php echo $current_cat; ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #888; text-decoration: none; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Назад к брендам
                    </a>
                </div>
            <?php elseif ($current_cat): ?>
                <div style="margin-bottom: 20px; text-align: center;">
                    <a href="catalog.php" style="display: inline-flex; align-items: center; gap: 8px; color: #888; text-decoration: none; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Назад к категориям
                    </a>
                </div>
            <?php endif; ?>
            
            <h1 class="hero-title-large"><?php echo $page_title; ?></h1>
            
            <?php if (!$current_cat): ?>
                <p style="color: #ccc; margin-top: 15px; max-width: 700px; font-size: 16px; margin-left: auto; margin-right: auto; text-align: center;">
                    Выберите категорию техники для поиска запчастей.
                </p>
            <?php elseif (in_array($current_cat, $cats_with_brands) && !$current_brand): ?>
                <p style="color: var(--brand-green); margin-top: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; text-align: center;">
                    Выберите бренд
                </p>
            <?php elseif ($current_brand): ?>
                <p style="color: #888; margin-top: 10px; font-size: 14px; text-align: center;">
                    Выберите модель техники
                </p>
            <?php endif; ?>
        </div>
    </section>
    
    <div class="container" style="padding-bottom: 100px;">
        
        <?php if (!$current_cat): ?>
            <div class="cats-grid">
                <a href="?cat=harvesters" class="cat-card">
                    <div class="cat-bg" style="background-image: url('img/cats/harvester.jpg');"></div>
                    <div class="cat-overlay"><h3 class="cat-title">Лесозаготовительные машины</h3><span class="cat-arrow">Перейти</span></div>
                </a>
                <a href="?cat=forwarders" class="cat-card">
                    <div class="cat-bg" style="background-image: url('img/cats/forwarder.jpg');"></div>
                    <div class="cat-overlay"><h3 class="cat-title">Форвардеры</h3><span class="cat-arrow">Перейти</span></div>
                </a>
                <a href="?cat=heads" class="cat-card">
                    <div class="cat-bg" style="background-image: url('img/cats/head.jpg');"></div>
                    <div class="cat-overlay"><h3 class="cat-title">Головки лесозаготовительные</h3><span class="cat-arrow">Перейти</span></div>
                </a>
                <a href="?cat=tracked" class="cat-card">
                    <div class="cat-bg" style="background-image: url('img/cats/tracked.jpg');"></div>
                    <div class="cat-overlay"><h3 class="cat-title">Гусеничные комбайны</h3><span class="cat-arrow">Перейти</span></div>
                </a>
                <a href="?cat=accessories" class="cat-card">
                    <div class="cat-bg" style="background-image: url('img/cats/accessories.jpg');"></div>
                    <div class="cat-overlay"><h3 class="cat-title">Аксессуары</h3><span class="cat-arrow">Перейти</span></div>
                </a>
                <a href="?cat=equipment" class="cat-card">
                    <div class="cat-bg" style="background-image: url('img/cats/equipment.jpg');"></div>
                    <div class="cat-overlay"><h3 class="cat-title">Оборудование</h3><span class="cat-arrow">Перейти</span></div>
                </a>
            </div>

        <?php elseif (in_array($current_cat, $cats_with_brands) && !$current_brand): ?>
            <div class="cats-grid" style="grid-template-columns: repeat(2, 1fr); max-width: 600px; margin: 0 auto; gap: 15px;">
                <a href="?cat=<?php echo $current_cat; ?>&brand=komatsu" class="cat-card" style="height: 220px; padding-top: 50px;">
                    <div class="cat-bg" style="background-image: url('img/komatsu_logo.png'); filter: none; opacity: 1; mix-blend-mode: normal; background-size: contain; height: 80px; margin-bottom: 20px;"></div>
                    <div class="cat-overlay"><h3 class="cat-title">KOMATSU</h3><span class="cat-arrow" style="margin-top: 5px;">Каталог техники</span></div>
                </a>
                <a href="?cat=<?php echo $current_cat; ?>&brand=valmet" class="cat-card" style="height: 220px; padding-top: 50px;">
                    <div class="cat-bg" style="background-image: url('img/valmet_logo.png'); filter: none; opacity: 1; mix-blend-mode: normal; background-size: contain; height: 80px; margin-bottom: 20px;"></div>
                    <div class="cat-overlay"><h3 class="cat-title">VALMET</h3><span class="cat-arrow" style="margin-top: 5px;">Каталог техники</span></div>
                </a>
            </div>

        <?php elseif ($current_cat == 'harvesters' && $current_brand == 'komatsu'): ?>
            <div class="model-grid">
                <?php foreach ($komatsu_harvesters as $item): ?>
                    <a href="#" class="model-card">
                        <div class="model-name"><?php echo $item['model']; ?></div>
                        <div class="model-serial"><?php echo $item['serial']; ?></div>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 60px 0;">
                <h3 style="color: #666; margin-bottom: 20px;">Раздел наполняется</h3>
                <p style="color: #444;">Список товаров для категории «<?php echo $page_title; ?>» скоро появится.</p>
                <a href="catalog.php" class="btn-primary" style="margin-top: 20px;">Вернуться в каталог</a>
            </div>
        <?php endif; ?>

    </div>
    <?php include 'footer.php'; ?>
    <script src="js/app.js"></script>
</body>
</html>