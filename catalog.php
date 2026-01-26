<?php
// Подключаем данные каталога
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
                    <button type="button" class="catalog-card js-nav-btn" data-target="<?= $key ?>">
                        <div class="card-bg-image"><img src="<?= $cat['img'] ?>" alt="<?= $cat['title'] ?>" loading="lazy"></div>
                        <div class="card-content">
                            <div class="card-arrow">
                                <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                            <h3><?= $cat['title'] ?></h3>
                        </div>
                        <div class="card-border-glow"></div>
                    </button>
                    <?php endforeach; ?>
                </div>

                <div class="hidden-view" id="view-harvesters">
                    <div class="nav-controls">
                        <button type="button" class="tech-back-btn back-btn" data-back="main">
                            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            <span>Назад к категориям</span>
                        </button>
                    </div>
                    <div class="catalog-grid two-col-grid">
                        <button type="button" class="catalog-card brand-card js-nav-btn" data-target="komatsu-models">
                            <div class="card-bg-image dark-overlay"></div>
                            <div class="card-content centered">
                                <h3 class="brand-title-text brand-green">KOMATSU</h3>
                                <span class="card-subtitle">Перейти в каталог</span>
                            </div>
                            <div class="card-border-glow"></div>
                        </button>
                        <button type="button" class="catalog-card brand-card disabled" disabled>
                            <div class="card-bg-image dark-overlay"></div>
                            <div class="card-content centered">
                                <h3 class="brand-title-text brand-red">VALMET</h3>
                                <span class="card-subtitle">В разработке</span>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="hidden-view" id="view-accessories">
                    <div class="nav-controls">
                        <button type="button" class="tech-back-btn back-btn" data-back="main">
                            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            <span>Назад к категориям</span>
                        </button>
                    </div>
                    <div class="catalog-grid">
                        <?php foreach($data['accessories'] as $item): ?>
                        <div class="catalog-card static-card">
                            <div class="card-bg-image"><img src="catalog/img/hero-bg.jpg" alt="<?= $item ?>" loading="lazy"></div>
                            <div class="card-content">
                                <h3><?= $item ?></h3>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="hidden-view" id="view-equipment">
                    <div class="nav-controls">
                        <button type="button" class="tech-back-btn back-btn" data-back="main">
                            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            <span>Назад к категориям</span>
                        </button>
                    </div>
                    <div class="catalog-grid">
                        <?php foreach($data['equipment'] as $item): ?>
                        <div class="catalog-card static-card">
                            <div class="card-bg-image"><img src="catalog/img/hero-bg.jpg" alt="<?= $item ?>" loading="lazy"></div>
                            <div class="card-content">
                                <h3><?= $item ?></h3>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="hidden-view" id="view-komatsu-models">
                    <div class="nav-controls">
                        <button type="button" class="tech-back-btn back-btn" data-back="harvesters">
                            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            <span>Назад к выбору бренда</span>
                        </button>
                    </div>
                    <div class="catalog-grid">
                        <?php foreach($data['komatsu_harvesters'] as $model): ?>
                        <a href="<?= $model['link'] ?>" class="catalog-card model-link-card">
                            <div class="card-bg-image white-bg">
                                <img src="catalog/img/Harvesters.png" alt="<?= $model['model'] ?>" style="object-fit: contain; padding: 20px;">
                            </div>
                            <div class="card-content">
                                <div class="card-arrow">
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                                <h3><?= $model['model'] ?></h3>
                                <p class="card-serial"><?= $model['serial'] ?></p>
                            </div>
                            <div class="card-border-glow"></div>
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