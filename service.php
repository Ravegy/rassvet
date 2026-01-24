<?php
$data = require __DIR__ . '/data/services_data.php';
$css_ver = file_exists(__DIR__ . '/css/style.css') ? filemtime(__DIR__ . '/css/style.css') : time();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сервис и Ремонт Komatsu | РАССВЕТ-С</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?= $css_ver ?>">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>

    <?php include 'header.php'; ?>
    <div id="toast-container"></div>

    <main>
        <section class="home-hero">
            <div class="container hero-content">
                <div class="hero-badge"><?= $data['hero']['badge'] ?></div>
                <h1 class="home-title"><?= $data['hero']['title'] ?></h1>
                <p class="home-subtitle"><?= $data['hero']['subtitle'] ?></p>
                <div class="hero-buttons">
                    <a href="#order-form" class="btn-primary">ОСТАВИТЬ ЗАЯВКУ</a>
                </div>
            </div>
        </section>

        <section class="content-padding" style="padding-top: 40px;">
            <div class="container">

                <div class="section-header-wrap">
                    <h2 class="section-header">Глубокая экспертиза</h2>
                    <p class="text-block">Сервисный центр оснащен современным диагностическим оборудованием. Мы не просто устраняем поломку, но и находим её первопричину.</p>
                </div>
                
                <div class="service-grid-cards">
                    <?php foreach($data['main_services'] as $srv): ?>
                    <div class="srv-card">
                        <div class="srv-icon"><?= $srv['icon'] ?></div>
                        <h3><?= $srv['title'] ?></h3>
                        <p><?= $srv['text'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 100px;">
                    <h2 class="section-header">Мобильный сервис</h2>
                    <p class="text-block">Мастерская на колесах для работы вдали от цивилизации. Экономим ваше время простоя.</p>
                    
                    <div class="features-grid">
                        <?php foreach($data['mobile_features'] as $feat): ?>
                        <div class="feature-item">
                            <div class="about-icon"><?= $feat['icon'] ?></div>
                            <div class="feature-title"><?= $feat['title'] ?></div>
                            <p style="font-size: 13px; color: #999; margin-top: 5px;"><?= $feat['text'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="price-section" style="margin-top: 140px;">
                    <h2 class="section-header" style="border: none; padding: 0;">Прайс-лист</h2>
                    <div class="price-table-wrapper">
                        <table class="price-table">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Наименование</th>
                                    <th style="width: 20%;">Ед. изм.</th>
                                    <th style="width: 30%;">Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['prices'] as $row): ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['unit'] ?></td>
                                    <td class="price-val"><?= $row['price'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="steps-grid" style="margin-top: 80px;">
                    <?php foreach($data['steps'] as $step): ?>
                    <div class="step-card">
                        <div class="step-num"><?= $step['num'] ?></div>
                        <div class="step-content">
                            <h3><?= $step['title'] ?></h3>
                            <p><?= $step['text'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="contacts-wrapper" style="margin-top: 120px;" id="order-form">
                    <div class="contact-card">
                        <h2 class="section-header">Заявка на сервис</h2>
                        <p style="color: #ccc; margin-bottom: 20px;">Опишите проблему, модель техники и наработку.</p>
                        
                        <form class="order-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-input" placeholder="Ваше Имя" required>
                                <div class="error-message">Введите имя</div>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" class="form-input" placeholder="Телефон" required>
                                <div class="error-message">Введите номер</div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="message" class="form-input" placeholder="Модель, описание поломки...">
                            </div>
                            <button type="submit" class="btn-cart-order">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class="map-visual-side" style="background: url('img/hero-bg.jpg') center/cover; border-radius: 30px; min-height: 400px; display: flex; align-items: center; justify-content: center;">
                        <div style="background: rgba(0,0,0,0.7); padding: 40px; border-radius: 20px; text-align: center;">
                            <h3 style="color: #fff; margin-bottom: 15px;">Срочный выезд?</h3>
                            <a href="tel:+79818881337" class="footer-phone-big">+7 (981) 888-13-37</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

<?php include 'footer.php'; ?>
    
    <script src="https://unpkg.com/imask"></script>
    
    </body>
</html>