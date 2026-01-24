<?php 
// Логика остается наверху
$partners = include 'data/partners_data.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запчасти Komatsu Forest | РАССВЕТ-С</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css?v=<?= file_exists(__DIR__ . '/css/style.css') ? filemtime(__DIR__ . '/css/style.css') : time(); ?>">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="home-hero">
            <div class="container hero-content">
                <div class="hero-text-block">
                    <div class="hero-badge">Работаем с 2013 года</div>
                    <h1 class="home-title">ЗАПЧАСТИ ДЛЯ <br><span style="color: var(--brand-green);">KOMATSU FOREST</span></h1>
                    <p class="home-subtitle">Федеральный дистрибьютор запчастей. Собственный сервисный центр. Отгрузка день в день.</p>
                    <div class="hero-buttons">
                        <a href="catalog.php" class="btn-outline">КАТАЛОГ ЗАПЧАСТЕЙ</a>
                        <a href="service.php" class="btn-outline">ЗАПИСАТЬСЯ НА СЕРВИС</a>
                        <a href="gallery.php" class="btn-outline">НАШИ РАБОТЫ</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="container" style="padding-bottom: 80px; position: relative; z-index: 2;">
            
            <div class="features-home">
                <div class="feat-card reveal-block">
                    <div class="feat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                    <div><h3>Склад в СПб</h3><p>90% позиций в наличии. Быстрая логистика.</p></div>
                </div>
                <div class="feat-card reveal-block" style="transition-delay: 0.2s;">
                    <div class="feat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                    <div><h3>Отгрузка 24/7</h3><p>Отправляем груз в день обращения.</p></div>
                </div>
                <div class="feat-card reveal-block" style="transition-delay: 0.4s;">
                    <div class="feat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                    <div><h3>Гарантия</h3><p>Оригиналы и проверенный OEM.</p></div>
                </div>
            </div>

            <div class="contact-card map-block-wrapper reveal-block" style="margin-top: 40px;">
                <div class="map-text-side">
                    <h2 class="section-header" style="justify-content:center; margin-bottom: 20px;">География поставок</h2>
                    <p style="color: #ccc; margin-bottom: 40px;">Центральный склад в Санкт-Петербурге — это наш логистический хаб. Мы отладили маршруты доставки от Карелии до Дальнего Востока.</p>
                    <div class="map-stats-row">
                        <div class="stat-item"><div class="stat-num">85</div><div class="stat-label">Регионов</div></div>
                        <div class="stat-item"><div class="stat-num">1-3</div><div class="stat-label">Дня доставка</div></div>
                        <div class="stat-item"><div class="stat-num">100%</div><div class="stat-label">Страховка</div></div>
                    </div>
                </div>
                
                <div class="map-visual-side">
                    <div class="map-container-relative">
                        <img src="img/map_full.png" class="map-bg-image" alt="Карта РФ" loading="lazy">
                        <svg class="map-overlay-svg" viewBox="0 0 1000 535" preserveAspectRatio="xMidYMid meet">
                            <g class="map-lines">
                                <?php 
                                $lines = [
                                    [220,150], [180,200], [280,190], [160,250], [200,255], [240,265], 
                                    [210,290], [80,330], [310,240], [340,270], [380,275], [420,225], 
                                    [480,320], [540,310], [610,340], [750,220], [850,360], [840,400]
                                ];
                                foreach($lines as $i => $xy): 
                                    $delay = 0.1 * (($i % 5) + 1);
                                ?>
                                <line x1="135" y1="210" x2="<?= $xy[0] ?>" y2="<?= $xy[1] ?>" class="map-line" style="animation-delay: <?= $delay ?>s" />
                                <?php endforeach; ?>
                            </g>
                            
                            <circle cx="135" cy="210" r="5" fill="#fff" />
                            <circle cx="135" cy="210" r="25" fill="var(--brand-green)" opacity="0.3">
                                <animate attributeName="r" from="5" to="35" dur="2s" repeatCount="indefinite" />
                                <animate attributeName="opacity" from="0.5" to="0" dur="2s" repeatCount="indefinite" />
                            </circle>
                            <text x="135" y="190" class="map-label main-label" text-anchor="middle">Санкт-Петербург</text>

                            <?php
                            $cities = [
                                ['x'=>220, 'y'=>150, 'n'=>'Архангельск'],
                                ['x'=>180, 'y'=>200, 'n'=>'Вологда', 's'=>10],
                                ['x'=>280, 'y'=>190, 'n'=>'Сыктывкар'],
                                ['x'=>160, 'y'=>250, 'n'=>'Москва', 'a'=>'end', 'dy'=>15],
                                ['x'=>200, 'y'=>255, 'n'=>'Н.Новгород', 'a'=>'middle', 's'=>10, 'dy'=>-15],
                                ['x'=>240, 'y'=>265, 'n'=>'Казань', 's'=>10],
                                ['x'=>210, 'y'=>290, 'n'=>'Самара', 's'=>10, 'dy'=>10],
                                ['x'=>80,  'y'=>330, 'n'=>'Краснодар'],
                                ['x'=>310, 'y'=>240, 'n'=>'Пермь', 'dy'=>-5],
                                ['x'=>340, 'y'=>270, 'n'=>'Екатеринбург', 'a'=>'middle', 'dy'=>20],
                                ['x'=>380, 'y'=>275, 'n'=>'Тюмень', 's'=>10],
                                ['x'=>420, 'y'=>225, 'n'=>'Сургут'],
                                ['x'=>480, 'y'=>320, 'n'=>'Новосибирск', 'a'=>'middle', 'dy'=>20],
                                ['x'=>540, 'y'=>310, 'n'=>'Красноярск', 'a'=>'middle', 'dy'=>20],
                                ['x'=>610, 'y'=>340, 'n'=>'Иркутск', 'dy'=>5],
                                ['x'=>750, 'y'=>220, 'n'=>'Якутск'],
                                ['x'=>850, 'y'=>360, 'n'=>'Хабаровск'],
                                ['x'=>840, 'y'=>400, 'n'=>'Владивосток', 'a'=>'end', 'dy'=>15]
                            ];
                            foreach($cities as $c): 
                                $anchor = $c['a'] ?? 'start';
                                $size = $c['s'] ?? 11;
                                $dy = $c['dy'] ?? 0;
                                $y_text = ($dy != 0) ? $c['y'] + $dy : $c['y'];
                                if ($dy == 0) $y_text = $c['y'] + ($anchor === 'middle' ? 20 : 0);
                                if ($dy == 0 && $anchor !== 'middle') $y_text = $c['y'];
                                $text_x = $c['x'] + ($anchor === 'start' ? 10 : ($anchor === 'end' ? -10 : 0));
                                $text_y = $c['y'] + ($anchor === 'middle' ? 20 : 5);
                                if(isset($c['dy'])) $text_y = $c['y'] + $c['dy'];
                            ?>
                            <circle cx="<?= $c['x'] ?>" cy="<?= $c['y'] ?>" r="<?= ($anchor === 'middle' || isset($c['dy'])) ? 4 : 3 ?>" class="dest-dot" />
                            <text x="<?= $text_x ?>" y="<?= $text_y ?>" class="map-label" text-anchor="<?= $anchor ?>" style="font-size: <?= $size ?>px;"><?= $c['n'] ?></text>
                            <?php endforeach; ?>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="contact-card content-padding reveal-block" style="margin-top: 60px;">
                <h2 class="section-header" style="justify-content: center; margin-bottom: 40px;">Наши партнеры</h2>
                <div class="partners-wrap">
                    <button class="p-btn p-prev" aria-label="Previous"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg></button>
                    <div class="partners-track" id="partnersTrack">
                        <?php foreach($partners as $p): ?>
                        <div class="partner-item">
                            <span style="font-weight: 900; font-size: 40px; color: <?= $p['color'] ?>; text-transform: uppercase;" class="partner-logo"><?= $p['name'] ?></span>
                            <div class="partner-float-name"><?= $p['name'] ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="p-btn p-next" aria-label="Next"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg></button>
                </div>
            </div>

        </div>
    </main>

    <div id="toast-container"></div>
    <?php include 'footer.php'; ?>
    <script src="https://unpkg.com/imask"></script>
    <script src="js/app.js"></script>
</body>
</html>