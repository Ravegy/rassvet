<?php
$data = require __DIR__ . '/data/delivery_data.php';
$css_ver = file_exists(__DIR__ . '/css/style.css') ? filemtime(__DIR__ . '/css/style.css') : time();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доставка и Оплата | РАССВЕТ-С</title>
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
                
                <div class="contacts-wrapper delivery-grid" style="margin-bottom: 60px;">
                    <div class="contact-card text-block content-padding">
                        <h2 class="section-header"><?= $data['finance']['title'] ?></h2>
                        <?php foreach($data['finance']['text'] as $p): ?>
                            <p><?= $p ?></p>
                        <?php endforeach; ?>
                        
                        <div style="margin-top: 30px;">
                            <h3 style="color: #fff; font-size: 16px; margin-bottom: 15px; text-transform: uppercase; font-weight: 800;"><?= $data['finance']['list_title'] ?></h3>
                            <ul class="legal-list">
                                <?php foreach($data['finance']['list'] as $li): ?>
                                    <li><?= $li ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="contact-card card-padding">
                        <h3 style="color: #fff; font-size: 18px; font-weight: 800; margin-top: 0; margin-bottom: 20px; text-transform: uppercase; text-align: center;"><?= $data['requisites']['title'] ?></h3>
                        <div class="requisites-wrapper">
                            <table class="req-table">
                                <?php foreach($data['requisites']['rows'] as $row): ?>
                                <tr>
                                    <td class="req-label"><?= $row['label'] ?></td>
                                    <td class="req-value"><?= $row['value'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="#" class="btn-download">Скачать реквизиты (PDF)</a>
                        </div>
                    </div>
                </div>

                <div class="contact-card text-block content-padding">
                    <h2 class="section-header"><?= $data['logistics']['title'] ?></h2>
                    <div>
                        <?php foreach($data['logistics']['text'] as $p): ?>
                            <p><?= $p ?></p>
                        <?php endforeach; ?>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 30px;">
                        <?php foreach($data['logistics']['badges'] as $badge): ?>
                        <div class="info-badge">
                            <?= $badge['icon'] ?>
                            <div>
                                <strong style="color: #fff; font-size: 15px;"><?= $badge['title'] ?></strong>
                                <div style="font-size: 13px; color: #aaa; margin-top: 4px;"><?= $badge['desc'] ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <h3 style="color: #666; font-size: 18px; margin-top: 50px; text-align: center; text-transform: uppercase; font-weight: 800;"><?= $data['logistics']['partners_title'] ?></h3>
                    <div class="tk-grid">
                        <?php foreach($data['logistics']['partners'] as $p): ?>
                        <div class="tk-card"><img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>" loading="lazy"></div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </section>
    </main>
    
    <?php include 'footer.php'; ?>
    </body>
</html>