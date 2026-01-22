<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея работ | РАССВЕТ-С</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="gallery-page">
        
        <section class="hero gallery-hero">
            <div class="container">
                <div class="hero-badge">PROJECT_ARCHIVE_V.04</div>
                <h1 class="hero-title-large">НАШИ РАБОТЫ</h1>
                <p class="home-subtitle">Полный отчет о восстановлении тяжелой техники. Доказательства качества в каждом пикселе.</p>
            </div>
        </section>

        <section class="video-section">
            <div class="container">
                <div class="video-wrapper-hud">
                    <div class="hud-corner top-left"></div>
                    <div class="hud-corner top-right"></div>
                    <div class="hud-corner bottom-left"></div>
                    <div class="hud-corner bottom-right"></div>
                    <div class="hud-label">REC_MODE: ON [1080p]</div>
                    <div class="hud-center-cross">+</div>
                    
                    <video class="main-video" poster="img/hero-bg.jpg" controls>
                        <source src="video/repair-process.mp4" type="video/mp4">
                        Ваш браузер не поддерживает видео.
                    </video>
                </div>
            </div>
        </section>

        <section class="gallery-content content-padding">
            <div class="container">
                
                <div class="gallery-filters">
                    <button class="filter-btn active" data-filter="all">ВСЕ СИСТЕМЫ</button>
                    <button class="filter-btn" data-filter="engine">ДВИГАТЕЛИ</button>
                    <button class="filter-btn" data-filter="hydraulics">ГИДРАВЛИКА</button>
                    <button class="filter-btn" data-filter="transmission">ТРАНСМИССИЯ</button>
                </div>

                <div class="gallery-grid">
                    
                    <div class="gallery-item size-large" data-cat="engine">
                        <img src="img/hero-bg.jpg" alt="Ремонт CAT">
                        <div class="gallery-overlay">
                            <div class="g-tag">ENGINE_OVERHAUL</div>
                            <h3>CATERPILLAR C15</h3>
                            <div class="g-specs">
                                <span>ID: 4821</span>
                                <span>TIME: 48H</span>
                                <span>RES: 100%</span>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-cat="hydraulics">
                        <img src="img/hero-bg.jpg" alt="Гидроцилиндр">
                        <div class="gallery-overlay">
                            <div class="g-tag">HYDRAULICS</div>
                            <h3>KOMATSU PC400</h3>
                            <div class="g-specs"><span>ID: 992</span><span>STATUS: OK</span></div>
                        </div>
                    </div>

                    <div class="gallery-item" data-cat="transmission">
                        <img src="img/hero-bg.jpg" alt="КПП">
                        <div class="gallery-overlay">
                            <div class="g-tag">GEARBOX</div>
                            <h3>ZF 4WG-200</h3>
                            <div class="g-specs"><span>ID: 110</span><span>WARRANTY: 1Y</span></div>
                        </div>
                    </div>

                    <div class="gallery-item size-wide" data-cat="engine">
                        <img src="img/hero-bg.jpg" alt="Двигатель в сборе">
                        <div class="gallery-overlay">
                            <div class="g-tag">ASSEMBLY</div>
                            <h3>CUMMINS ISX15</h3>
                            <div class="g-specs">
                                <span>POWER: 600HP</span>
                                <span>TEST: PASSED</span>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-cat="hydraulics">
                        <img src="img/hero-bg.jpg" alt="Насос">
                        <div class="gallery-overlay">
                            <div class="g-tag">PUMP_UNIT</div>
                            <h3>BOSCH REXROTH</h3>
                            <div class="g-specs"><span>PRESS: 350BAR</span></div>
                        </div>
                    </div>

                </div>
                
                <div style="text-align: center; margin-top: 60px;">
                    <a href="service.php" class="btn-primary">ХОЧУ ТАК ЖЕ</a>
                </div>

            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>
</body>
</html>