<?php
$data = require __DIR__ . '/data/about_data.php';
$css_ver = file_exists(__DIR__ . '/css/style.css') ? filemtime(__DIR__ . '/css/style.css') : time();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О компании | РАССВЕТ-С</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?= $css_ver ?>">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="home-hero">
            <div class="container hero-content">
                <h1 class="home-title"><?= $data['hero_title'] ?></h1>
            </div>
        </section>

        <section class="content-padding" style="padding-top: 40px;">
            <div class="container">
                
                <div class="contact-card about-text content-padding" style="margin-bottom: 60px;">
                    <h2 class="section-header"><?= $data['intro']['title'] ?></h2>
                    <?php foreach($data['intro']['text'] as $p): ?>
                        <p><?= $p ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="contacts-wrapper" style="grid-template-columns: 1fr; margin-bottom: 60px;">
                    <div class="contact-card about-text content-padding">
                        <h2 class="section-header"><?= $data['supply']['title'] ?></h2>
                        <div class="about-grid-2">
                            <div>
                                <?php foreach($data['supply']['text'] as $p): ?>
                                    <p><?= $p ?></p>
                                <?php endforeach; ?>
                            </div>
                            <div>
                                <p><strong><?= $data['supply']['list_title'] ?></strong></p>
                                <ul class="service-list" style="margin-top: 20px;">
                                    <?php foreach($data['supply']['list'] as $li): ?>
                                        <li><?= $li ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contacts-wrapper" style="margin-bottom: 60px; align-items: start;">
                    <div class="contact-card about-text content-padding">
                        <div style="margin-bottom: 30px;">
                            <h2 class="section-header" style="margin-bottom: 10px;"><?= $data['service']['title'] ?></h2>
                            <p style="margin-bottom: 0; color: #888;"><?= $data['service']['subtitle'] ?></p>
                        </div>
                        
                        <p style="font-size: 15px; margin-bottom: 20px;"><?= $data['service']['text'] ?></p>

                        <div class="features-grid" style="gap: 15px; margin-top: 10px; grid-template-columns: 1fr !important;">
                            <?php foreach($data['service']['features'] as $feat): ?>
                            <div class="feature-item">
                                <div class="feature-title">
                                    <?= $feat['icon'] ?>
                                    <?= $feat['title'] ?>
                                </div>
                                <p style="font-size: 13px; margin: 5px 0 0 0; color: #999;"><?= $feat['desc'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div style="margin-top: 30px; text-align: center;">
                            <a href="service.php" class="btn-primary">Подробнее</a>
                        </div>
                    </div>

                    <div class="contact-card content-padding">
                        <h2 style="font-size: 28px; font-weight: 800; text-transform: uppercase; color: #fff; margin-bottom: 40px; border-left: 4px solid var(--brand-green); padding-left: 20px;"><?= $data['principles']['title'] ?></h2>
                        
                        <div class="principles-grid" style="grid-template-columns: 1fr; gap: 30px;">
                            <?php foreach($data['principles']['items'] as $item): ?>
                            <div class="principle-item">
                                <div class="about-icon"><?= $item['icon'] ?></div>
                                <div>
                                    <h3 style="color: #fff; font-size: 16px; font-weight: 800; margin: 0 0 5px;"><?= $item['title'] ?></h3>
                                    <p style="color: #ccc; font-size: 13px; line-height: 1.5; margin: 0;"><?= $item['desc'] ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div style="margin-top: 40px; text-align: center;">
                            <a href="contacts.php" class="btn-primary">Связаться с нами</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>