<?php
$data = require __DIR__ . '/data/catalog_store.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог запчастей | РАССВЕТ-С</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css?v=<?= file_exists(__DIR__ . '/css/style.css') ? filemtime(__DIR__ . '/css/style.css') : time(); ?>">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="catalog-page">
        <section class="hero compact-hero">
            <div class="container">
                <div class="hero-badge">СКЛАД: >5000 ПОЗИЦИЙ</div>
                <h1 class="hero-title-large" id="pageTitle">КАТАЛОГ ЗАПЧАСТЕЙ</h1>
                <p class="home-subtitle">Оригинальные комплектующие и качественные аналоги для лесной техники.</p>
            </div>
        </section>

        <section class="content-padding">
            <div class="container">
                
                <div class="catalog-grid active-view" id="view-main">
                    <?php foreach ($data['categories'] as $key => $cat): ?>
                    <button class="catalog-card js-nav-btn" data-target="<?= $key ?>">
                        <div class="cat-img-wrap"><img src="<?= $cat['img'] ?>" alt="<?= $cat['title'] ?>" loading="lazy"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3><?= $cat['title'] ?></h3>
                        </div>
                    </button>
                    <?php endforeach; ?>
                </div>

                <div class="hidden-view" id="view-harvesters">
                    <div class="nav-controls">
                        <button class="btn-outline back-btn" data-back="main">← НАЗАД К КАТЕГОРИЯМ</button>
                    </div>
                    <div class="catalog-grid two-col-grid">
                        <button class="catalog-card brand-card js-nav-btn" data-target="komatsu-models">
                            <div class="cat-img-wrap dark-bg"><h3 class="brand-title brand-green">KOMATSU</h3></div>
                            <div class="cat-overlay"><div class="cat-icon-circle">➜</div><h3>ПЕРЕЙТИ В КАТАЛОГ</h3></div>
                        </button>
                        <button class="catalog-card brand-card">
                            <div class="cat-img-wrap dark-bg"><h3 class="brand-title brand-red">VALMET</h3></div>
                            <div class="cat-overlay"><div class="cat-icon-circle">➜</div><h3>КАТАЛОГ В РАЗРАБОТКЕ</h3></div>
                        </button>
                    </div>
                </div>

                <div class="hidden-view" id="view-accessories">
                    <div class="nav-controls"><button class="btn-outline back-btn" data-back="main">← НАЗАД К КАТЕГОРИЯМ</button></div>
                    <div class="catalog-grid">
                        <?php foreach($data['accessories'] as $item): ?>
                        <div class="catalog-card static-card">
                            <div class="cat-img-wrap"><img src="catalog/img/hero-bg.jpg" alt="<?= $item ?>" loading="lazy"></div>
                            <div class="cat-overlay"><div class="cat-icon-circle">➜</div><h3><?= $item ?></h3></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="hidden-view" id="view-equipment">
                    <div class="nav-controls"><button class="btn-outline back-btn" data-back="main">← НАЗАД К КАТЕГОРИЯМ</button></div>
                    <div class="catalog-grid">
                        <?php foreach($data['equipment'] as $item): ?>
                        <div class="catalog-card static-card">
                            <div class="cat-img-wrap"><img src="catalog/img/hero-bg.jpg" alt="<?= $item ?>" loading="lazy"></div>
                            <div class="cat-overlay"><div class="cat-icon-circle">➜</div><h3><?= $item ?></h3></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="hidden-view" id="view-komatsu-models">
                    <div class="nav-controls"><button class="btn-outline back-btn" data-back="harvesters">← НАЗАД К ВЫБОРУ БРЕНДА</button></div>
                    <div class="catalog-grid">
                        <?php foreach($data['komatsu_harvesters'] as $model): ?>
                        <a href="<?= $model['link'] ?>" class="model-card-custom">
                            <div class="model-img-area"><img src="catalog/img/Harvesters.png" alt="<?= $model['model'] ?>" loading="lazy"></div>
                            <div class="model-info-area">
                                <h3 class="model-title"><?= $model['model'] ?></h3>
                                <p class="model-serial"><?= $model['serial'] ?></p>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="js/app.js"></script>
</body>
</html>