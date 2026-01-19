<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог Komatsu Forest | РАССВЕТ-С</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'header.php'; ?>
    <div id="toast-container"></div>

    <section class="hero" style="padding: 80px 0 30px;">
        <div class="container">
            <h1 class="hero-title-large">КАТАЛОГ KOMATSU FOREST</h1>
            <p style="color: #ccc; margin-top: 15px; max-width: 700px; font-size: 16px; margin-left: auto; margin-right: auto; text-align: center;">
                Выберите категорию техники для поиска запчастей.
            </p>
        </div>
    </section>

    <div class="container" style="padding-bottom: 100px;">
        
        <div class="cats-grid">
            <a href="#" class="cat-card">
                <div class="cat-bg" style="background-image: url('img/cats/harvester.jpg');"></div>
                <div class="cat-overlay">
                    <h3 class="cat-title">Лесозаготовительные машины</h3>
                    <span class="cat-arrow">Перейти</span>
                </div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-bg" style="background-image: url('img/cats/forwarder.jpg');"></div>
                <div class="cat-overlay">
                    <h3 class="cat-title">Форвардеры</h3>
                    <span class="cat-arrow">Перейти</span>
                </div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-bg" style="background-image: url('img/cats/head.jpg');"></div>
                <div class="cat-overlay">
                    <h3 class="cat-title">Головки лесозаготовительные</h3>
                    <span class="cat-arrow">Перейти</span>
                </div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-bg" style="background-image: url('img/cats/tracked.jpg');"></div>
                <div class="cat-overlay">
                    <h3 class="cat-title">Гусеничные комбайны</h3>
                    <span class="cat-arrow">Перейти</span>
                </div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-bg" style="background-image: url('img/cats/accessories.jpg');"></div>
                <div class="cat-overlay">
                    <h3 class="cat-title">Аксессуары</h3>
                    <span class="cat-arrow">Перейти</span>
                </div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-bg" style="background-image: url('img/cats/equipment.jpg');"></div>
                <div class="cat-overlay">
                    <h3 class="cat-title">Оборудование</h3>
                    <span class="cat-arrow">Перейти</span>
                </div>
            </a>
        </div>

    </div>

    <?php include 'footer.php'; ?>
    <script src="js/app.js"></script>
</body>
</html>