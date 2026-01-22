<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог запчастей | РАССВЕТ-С</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="favicon.png" type="image/png">
    <style>
        .model-card-custom {
            display: flex;
            flex-direction: column;
            background: #151515;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            transition: 0.3s ease;
            height: 100%;
            min-height: 240px;
        }
        .model-card-custom:hover {
            transform: translateY(-5px);
            border-color: var(--brand-green);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .model-img-area {
            background: #fff;
            height: 160px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .model-img-area img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: none;
        }
        .model-info-area {
            padding: 12px 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: #151515;
            flex-grow: 1;
        }
        .model-title {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            margin: 0 0 4px 0;
            transition: 0.3s;
            text-transform: uppercase;
        }
        .model-serial {
            font-size: 12px;
            color: #666;
            font-family: monospace;
            letter-spacing: 0.5px;
            transition: 0.3s;
            margin: 0;
        }
        .model-card-custom:hover .model-title,
        .model-card-custom:hover .model-serial {
            color: var(--brand-green);
        }
    </style>
</head>
<body>

    <?php 
    $path = '';
    include 'header.php'; 
    ?>

    <main>
        
        <section class="hero" style="padding: 60px 0 10px;">
            <div class="container">
                <div class="hero-badge">СКЛАД: >5000 ПОЗИЦИЙ</div>
                <h1 class="hero-title-large" id="page-title">КАТАЛОГ ЗАПЧАСТЕЙ</h1>
                <p class="home-subtitle" style="margin-bottom: 10px;">Оригинальные комплектующие и качественные аналоги для лесной техники.</p>
            </div>
        </section>

        <section class="content-padding" style="padding-top: 0;">
            <div class="container">
                
                <div class="catalog-grid" id="main-grid">
                    
                    <div class="catalog-card" onclick="openBrands('Лесозаготовительные машины')">
                        <div class="cat-img-wrap"><img src="catalog/img/Harvesters.png" alt="Лесозаготовительные машины"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3>Лесозаготовительные машины</h3>
                        </div>
                    </div>

                    <div class="catalog-card" onclick="openBrands('Форвардер')">
                        <div class="cat-img-wrap"><img src="catalog/img/Forwarder.png" alt="Форвардер"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3>Форвардер</h3>
                        </div>
                    </div>

                    <div class="catalog-card" onclick="openBrands('Головки')">
                        <div class="cat-img-wrap"><img src="catalog/img/Heads.png" alt="Головки"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3>Головки</h3>
                        </div>
                    </div>

                    <div class="catalog-card" onclick="openBrands('Гусеничный комбайн')">
                        <div class="cat-img-wrap"><img src="catalog/img/Crawler.png" alt="Гусеничный комбайн"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3>Гусеничный комбайн</h3>
                        </div>
                    </div>

                    <div class="catalog-card" onclick="openAccessories()">
                        <div class="cat-img-wrap"><img src="catalog/img/Accessories.png" alt="Аксессуары"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3>Аксессуары</h3>
                        </div>
                    </div>

                    <div class="catalog-card" onclick="openEquipment()">
                        <div class="cat-img-wrap"><img src="catalog/img/Equipment.png" alt="Оборудование"></div>
                        <div class="cat-overlay">
                            <div class="cat-icon-circle">➜</div>
                            <h3>Оборудование</h3>
                        </div>
                    </div>

                </div>

                <div id="brand-grid" style="display: none;">
                    <div style="margin-bottom: 20px;">
                        <button onclick="resetCatalog()" class="btn-outline" style="padding: 10px 20px; font-size: 12px;">← НАЗАД К КАТЕГОРИЯМ</button>
                    </div>
                    <div class="catalog-grid" style="grid-template-columns: repeat(2, 1fr);">
                        <a href="javascript:void(0)" onclick="handleKomatsuClick()" class="catalog-card" style="height: 300px;">
                            <div class="cat-img-wrap" style="background: #111; display: flex; align-items: center; justify-content: center;">
                                <h3 style="font-size: 40px; color: var(--brand-green);">KOMATSU</h3>
                            </div>
                            <div class="cat-overlay">
                                <div class="cat-icon-circle">➜</div>
                                <h3>ПЕРЕЙТИ В КАТАЛОГ</h3>
                            </div>
                        </a>
                        <a href="#" class="catalog-card" style="height: 300px;">
                            <div class="cat-img-wrap" style="background: #111; display: flex; align-items: center; justify-content: center;">
                                <h3 style="font-size: 40px; color: #d60000;">VALMET</h3>
                            </div>
                            <div class="cat-overlay">
                                <div class="cat-icon-circle">➜</div>
                                <h3>ПЕРЕЙТИ В КАТАЛОГ</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="accessories-grid" style="display: none;">
                    <div style="margin-bottom: 20px;">
                        <button onclick="resetCatalog()" class="btn-outline" style="padding: 10px 20px; font-size: 12px;">← НАЗАД К КАТЕГОРИЯМ</button>
                    </div>
                    <div class="catalog-grid">
                        <?php 
                        $accs = [
                            "Сортиментные коробки", "Пила", "Инструмент", "Комплект фильтров", 
                            "Uptime Kits", "Аккумуляторная батарея", "Разжимной палец", "Огнетушитель", 
                            "Рабочие лампы", "Подогреватель двигателя", "Запуск от постороннего источника", 
                            "Смазочные материалы", "Жидкости", "Вертлюг", "Центральная смазка Lincoln parts", 
                            "Подъемный", "Штангенциркуль", "AdBlue®/DEF", "Насос для заполнения Urea", 
                            "Резиновый скребок стеклоочистителя", "Расходные материалы", "Рабочие перчатки", 
                            "Задвижка шланга"
                        ];
                        foreach($accs as $item): ?>
                        <a href="#" class="catalog-card">
                            <div class="cat-img-wrap"><img src="catalog/img/hero-bg.jpg" alt="<?php echo $item; ?>"></div>
                            <div class="cat-overlay">
                                <div class="cat-icon-circle">➜</div>
                                <h3><?php echo $item; ?></h3>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div id="equipment-grid" style="display: none;">
                    <div style="margin-bottom: 20px;">
                        <button onclick="resetCatalog()" class="btn-outline" style="padding: 10px 20px; font-size: 12px;">← НАЗАД К КАТЕГОРИЯМ</button>
                    </div>
                    <div class="catalog-grid">
                        <?php 
                        $equip = [
                            "Подающие ролики", "Захваты", "Передаточные рычаги и демпферы поворота", 
                            "Поворотные устройства", "Olofsfors", "Сиденья", "Мобильный топливный бак", 
                            "Multibox", "MaxiFleet"
                        ];
                        foreach($equip as $item): ?>
                        <a href="#" class="catalog-card">
                            <div class="cat-img-wrap"><img src="catalog/img/hero-bg.jpg" alt="<?php echo $item; ?>"></div>
                            <div class="cat-overlay">
                                <div class="cat-icon-circle">➜</div>
                                <h3><?php echo $item; ?></h3>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div id="komatsu-harvester-grid" style="display: none;">
                    <div style="margin-bottom: 20px;">
                        <button onclick="backToBrands()" class="btn-outline" style="padding: 10px 20px; font-size: 12px;">← НАЗАД К ВЫБОРУ БРЕНДА</button>
                    </div>
                    <div class="catalog-grid">
                        <?php 
                        $komatsu_harvesters = [
                            ["model" => "901.4", "serial" => "9010041151"],
                            ["model" => "901", "serial" => "9010053267"],
                            ["model" => "901", "serial" => "9010064241"],
                            ["model" => "901XC", "serial" => "9013050237"],
                            ["model" => "901XC", "serial" => "9013061241"],
                            ["model" => "901TX", "serial" => "9011000128"],
                            ["model" => "901TX.1", "serial" => "9011011135"],
                            ["model" => "911.4", "serial" => "9110041151"],
                            ["model" => "911.5", "serial" => "9110050001"],
                            ["model" => "911", "serial" => "9110062167"],
                            ["model" => "911", "serial" => "9110073241"],
                            ["model" => "911", "serial" => "9112062167"],
                            ["model" => "911", "serial" => "9112073271"],
                            ["model" => "931", "serial" => "9310000125"],
                            ["model" => "931.1", "serial" => "9310010001"],
                            ["model" => "931", "serial" => "9310021067"],
                            ["model" => "931", "serial" => "9310033241"],
                            ["model" => "931XC", "serial" => "9313021208"],
                            ["model" => "931XC", "serial" => "9313032241"],
                            ["model" => "941.1", "serial" => "9410013175"],
                            ["model" => "951", "serial" => "9510004367"],
                            ["model" => "951", "serial" => "9510015241"],
                            ["model" => "951XC", "serial" => "9513010271"]
                        ];
                        foreach($komatsu_harvesters as $k): 
                            $link = ($k['model'] === '901.4') ? 'catalog/models/model_901_4.php' : '#';
                        ?>
                        
                        <a href="<?php echo $link; ?>" class="model-card-custom">
                            <div class="model-img-area">
                                <img src="catalog/img/Harvesters.png" alt="<?php echo $k['model']; ?>">
                            </div>
                            <div class="model-info-area">
                                <h3 class="model-title"><?php echo $k['model']; ?></h3>
                                <p class="model-serial"><?php echo $k['serial']; ?></p>
                            </div>
                        </a>

                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <script>
        let currentCategory = '';

        document.addEventListener("DOMContentLoaded", () => {
            const urlParams = new URLSearchParams(window.location.search);
            const view = urlParams.get('view');
            const cat = urlParams.get('cat');

            if (view === 'brands' && cat) {
                openBrands(cat, false);
            } else if (view === 'komatsu') {
                currentCategory = 'Лесозаготовительные машины';
                handleKomatsuClick(false);
            } else if (view === 'accessories') {
                openAccessories(false);
            } else if (view === 'equipment') {
                openEquipment(false);
            }
        });

        function updateState(view, cat = null) {
            const url = new URL(window.location);
            url.searchParams.set('view', view);
            if (cat) {
                url.searchParams.set('cat', cat);
            } else {
                url.searchParams.delete('cat');
            }
            window.history.pushState({}, '', url);
        }

        function clearState() {
            const url = new URL(window.location);
            url.searchParams.delete('view');
            url.searchParams.delete('cat');
            window.history.pushState({}, '', url);
        }

        function hideAll() {
            document.getElementById('main-grid').style.display = 'none';
            document.getElementById('brand-grid').style.display = 'none';
            document.getElementById('accessories-grid').style.display = 'none';
            document.getElementById('equipment-grid').style.display = 'none';
            document.getElementById('komatsu-harvester-grid').style.display = 'none';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function openBrands(categoryName, pushHistory = true) {
            hideAll();
            currentCategory = categoryName;
            document.getElementById('brand-grid').style.display = 'block';
            document.getElementById('page-title').innerText = categoryName;
            if (pushHistory) updateState('brands', categoryName);
        }

        function handleKomatsuClick(pushHistory = true) {
            if (currentCategory === 'Лесозаготовительные машины') {
                hideAll();
                document.getElementById('komatsu-harvester-grid').style.display = 'block';
                document.getElementById('page-title').innerText = 'KOMATSU HARVESTERS';
                if (pushHistory) updateState('komatsu');
            } else {
                alert('Каталог для этой категории в разработке');
            }
        }

        function openAccessories(pushHistory = true) {
            hideAll();
            document.getElementById('accessories-grid').style.display = 'block';
            document.getElementById('page-title').innerText = 'АКСЕССУАРЫ';
            if (pushHistory) updateState('accessories');
        }

        function openEquipment(pushHistory = true) {
            hideAll();
            document.getElementById('equipment-grid').style.display = 'block';
            document.getElementById('page-title').innerText = 'ОБОРУДОВАНИЕ';
            if (pushHistory) updateState('equipment');
        }

        function backToBrands() {
            openBrands(currentCategory);
        }

        function resetCatalog() {
            hideAll();
            document.getElementById('main-grid').style.display = 'grid';
            document.getElementById('page-title').innerText = 'КАТАЛОГ ЗАПЧАСТЕЙ';
            currentCategory = '';
            clearState();
        }
    </script>
</body>
</html>