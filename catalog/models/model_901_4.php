<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>901.4 | Запчасти Komatsu</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../favicon.png" type="image/png">

    <style>
        /* --- ПЕРЕОПРЕДЕЛЕНИЕ КОНТЕЙНЕРА --- */
        .container {
            max-width: 100% !important;
            width: 100% !important;
            padding-left: 60px !important;
            padding-right: 60px !important;
            box-sizing: border-box;
        }

        /* --- БАЗОВЫЕ СТИЛИ --- */
        .parts-sidebar { 
            width: 280px; 
            min-width: 280px; 
            background: #111; 
            border-right: 1px solid #222; 
            transition: all 0.3s ease;
        }
        .sb-menu a { display: flex; justify-content: space-between; align-items: center; gap: 15px; text-align: right; line-height: 1.3; font-family: 'Manrope', sans-serif; color: #888; transition: 0.3s; cursor: pointer; }
        .sb-menu a:hover { color: #fff; }
        .sb-menu span { flex-shrink: 0; white-space: nowrap; color: var(--brand-green); font-family: monospace; font-size: 11px; background: rgba(32, 191, 107, 0.1); padding: 2px 6px; border-radius: 4px; }

        /* АККОРДЕОН */
        .sb-submenu { list-style: none; padding: 5px 0 5px 15px; margin: 5px 0 10px 10px; border-left: 1px solid #333; display: none; }
        .sb-submenu.open { display: block; animation: fadeIn 0.3s ease; }
        .sb-submenu li { margin-bottom: 2px; }
        .sb-submenu a { font-size: 12px; color: #666; padding: 4px 0; border-bottom: none !important; justify-content: flex-end; }
        .sb-submenu a:hover { color: var(--brand-green); transform: translateX(-3px); padding-left: 0; }
        .sb-submenu span { color: #444; background: transparent; padding: 0; font-size: 10px; }
        .sb-menu li.active > a { color: #fff; font-weight: 700; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

        /* СЕТКА */
        .parts-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; align-items: stretch; animation: fadeIn 0.4s ease; }

        /* КАРТОЧКА */
        .part-group-card { background: #1a1a1a; border-radius: 8px; overflow: hidden; text-decoration: none; transition: all 0.3s ease; position: relative; display: flex; flex-direction: column; height: 100%; border: 1px solid transparent; cursor: pointer; }
        .part-group-card:hover { transform: translateY(-5px); border-color: var(--brand-green); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .pg-img { min-height: 170px; flex-grow: 1; background: #fff; position: relative; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .pg-img img { max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.3s ease; }
        .part-group-card:hover .pg-img img { transform: scale(1.05); }
        .pg-badge { position: absolute; top: 10px; left: 10px; background: #111; color: #fff; font-family: monospace; font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 4px; z-index: 2; transition: 0.3s; border: 1px solid rgba(255,255,255,0.1); }
        .part-group-card:hover .pg-badge { background: var(--brand-green); color: #000; border-color: var(--brand-green); }
        .pg-info { padding: 12px 10px; background: #1a1a1a; border-top: 1px solid #252525; flex-grow: 0; display: flex; align-items: center; justify-content: center; }
        .pg-info h3 { color: #eee; font-family: 'Manrope', sans-serif; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0; text-align: center; line-height: 1.35; word-break: break-word; }
        .pg-placeholder-icon { width: 40px; height: 40px; fill: #ddd; }

        /* ЗАГОЛОВОК */
        .content-header h1 { font-family: 'Manrope', sans-serif; font-size: 24px; font-weight: 800; color: #fff; margin: 0 0 20px 0; text-transform: uppercase; letter-spacing: 1px; }

        /* --- СТРАНИЦА ЗАПЧАСТЕЙ --- */
        .parts-view-container { display: none; display: flex; flex-wrap: nowrap; gap: 30px; animation: fadeIn 0.4s ease; align-items: flex-start; width: 100%; }

        /* Схема (слева) - УВЕЛИЧИЛИ ДО 45% */
        .pv-scheme {
            flex: 0 0 45%; /* Занимает 45% ширины */
            max-width: 45%;
            background: #fff; border-radius: 8px; padding: 20px;
            display: flex; align-items: flex-start; justify-content: center;
            min-height: 400px; border: 1px solid #333; position: sticky; top: 20px;
        }
        .pv-scheme img { max-width: 100%; height: auto; object-fit: contain; }

        /* Таблица (справа) - ЗАНИМАЕТ ОСТАЛЬНОЕ (~55%) */
        .pv-table-container { flex-grow: 1; background: #1a1a1a; border-radius: 8px; border: 1px solid #333; overflow: hidden; min-width: 0; }

        .parts-table { width: 100%; border-collapse: collapse; font-family: 'Manrope', sans-serif; font-size: 13px; }
        .parts-table th { background: #222; color: #888; font-weight: 700; text-transform: uppercase; padding: 14px 15px; text-align: left; border-bottom: 1px solid #333; font-size: 11px; letter-spacing: 0.5px; }
        .parts-table td { padding: 12px 15px; border-bottom: 1px solid #252525; color: #ccc; vertical-align: middle; }
        .parts-table tr:hover { background: #252525; }

        /* Колонки */
        .parts-table .pt-id { color: var(--brand-green); font-weight: 700; width: 30px; text-align: center; } 
        .parts-table .pt-number { font-family: monospace; color: #fff; font-weight: 600; font-size: 13px; white-space: nowrap; width: 120px; } 
        .parts-table .pt-qty { text-align: center; color: #666; width: 50px; } 
        .parts-table .pt-name { color: #ddd; font-weight: 500; } 
        .parts-table .pt-spec { font-size: 11px; color: #555; width: 150px; } 

        /* АКТИВНЫЙ ПУНКТ ПОДМЕНЮ */
        .sb-submenu a.active { color: #fff !important; font-weight: 700; background: rgba(255, 255, 255, 0.05); border-right: 3px solid var(--brand-green); padding-right: 10px; }
        .sb-submenu a.active span { color: #fff; }

        /* Мобильное меню */
        .sidebar-toggle-btn { display: none; width: 100%; padding: 15px 20px; background: #111; border: 1px solid #333; border-radius: 8px; color: #fff; font-family: 'Manrope', sans-serif; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; cursor: pointer; justify-content: space-between; align-items: center; margin-bottom: 20px; transition: 0.3s; }
        .sidebar-toggle-btn svg { width: 20px; height: 20px; stroke: #fff; transition: 0.3s; }
        .sidebar-toggle-btn.active svg { transform: rotate(180deg); stroke: var(--brand-green); }
        .sidebar-toggle-btn.active { border-color: var(--brand-green); color: var(--brand-green); }

        /* --- АДАПТИВ --- */
        @media (max-width: 1100px) {
            .parts-view-container { flex-direction: column; }
            .pv-scheme { flex: auto; max-width: 100%; width: 100%; position: static; }
        }
        @media (max-width: 900px) {
            .container { padding-left: 20px !important; padding-right: 20px !important; }
            .parts-book-layout { flex-direction: column; align-items: center; }
            .sidebar-toggle-btn { display: flex; }
            .parts-sidebar { display: none; width: 100%; margin-bottom: 20px; }
            .parts-sidebar.active { display: block; animation: slideDown 0.3s ease; }
            .parts-grid { width: 100%; grid-template-columns: repeat(2, 1fr); gap: 15px; justify-content: center; }
            .pg-img { min-height: 100px; height: 120px; padding: 10px; }
            .pg-badge { font-size: 9px; padding: 2px 5px; top: 5px; left: 5px; }
            .pg-info h3 { font-size: 10px; line-height: 1.2; }
            .pg-info { padding: 8px 5px; min-height: 50px; }
            .content-header h1 { font-size: 18px; margin-bottom: 15px; text-align: center; }
        }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <?php 
    $path = '../../'; 
    include '../../header.php'; 
    ?>

    <main style="padding-bottom: 60px;">
        <div class="container">
            
            <div style="margin-bottom: 20px; margin-top: 20px;">
                <a href="../../catalog.php?view=komatsu" id="top-back-btn" class="btn-outline" onclick="handleTopBack(event)" style="padding: 10px 20px; font-size: 12px;">← НАЗАД К МОДЕЛЯМ</a>
            </div>

            <div class="parts-book-layout">
                
                <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                    <span>Меню модели 901.4</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>

                <aside class="parts-sidebar" id="partsSidebar" style="border-radius: 8px; padding: 25px;">
                    <div class="sidebar-header" style="border-bottom: 1px solid #222; padding-bottom: 20px; margin-bottom: 20px;">
                        <div class="sb-label" style="font-size: 10px; color: #555; letter-spacing: 1px;">МОДЕЛЬ</div>
                        <h1 class="sb-model" style="margin: 5px 0; color: #fff;">901.4</h1>
                        <div class="sb-sn" style="color: #666; font-size: 12px; font-family: monospace;">S/N: 9010041151</div>
                    </div>
                    
                    <div class="sb-title" style="color: #fff; font-size: 12px; margin-bottom: 15px;">ГРУППЫ</div>
                    
                    <ul class="sb-menu">
                        <li id="li-engine">
                            <a onclick="showEngineView(event)"><span>1000000</span> Двигатель</a>
                            <ul class="sb-submenu" id="sub-engine">
                                <li><a id="lnk-1009100" onclick="showPartsView(event, 'Комплект прокладок', '1009100')">Комплект прокладок <span>1009100</span></a></li>
                                <li><a href="#">Впуск - выпуск <span>1010000</span></a></li>
                                <li><a href="#">Блок двигателя <span>1020000</span></a></li>
                                <li><a href="#">Топливная система <span>1030000</span></a></li>
                                <li><a href="#">Система охлаждения <span>1040000</span></a></li>
                                <li><a href="#">Система смазки <span>1050000</span></a></li>
                                <li><a href="#">Электродвигатель стартера <span>1070000</span></a></li>
                                <li><a href="#">Генератор переменного тока <span>1080000</span></a></li>
                                <li><a href="#">Электрический <span>1090000</span></a></li>
                                <li><a href="#">Подогреватель <span>1110000</span></a></li>
                                <li><a href="#">Установка двигателя <span>1120000</span></a></li>
                                <li><a href="#">Кондиционер воздуха <span>1130000</span></a></li>
                            </ul>
                        </li>

                        <li><a href="#"><span>2000000</span> Шасси</a></li>
                        <li><a href="#"><span>3000000</span> Коробка передач</a></li>
                        <li><a href="#"><span>4000000</span> Тормоза</a></li>
                        <li><a href="#"><span>5000000</span> Рулевое управление</a></li>
                        <li><a href="#"><span>6000000</span> Кабина</a></li>
                        <li><a href="#"><span>7000000</span> Система управления</a></li>
                        <li><a href="#"><span>7500000</span> Гидравлика</a></li>
                        <li><a href="#"><span>8000000</span> Подъемный кран</a></li>
                        <li><a href="#"><span>9000000</span> ЛЗТ оборудование</a></li>
                        <li><a href="#"><span>9990000</span> Различное оборудование</a></li>
                    </ul>
                </aside>

                <div class="parts-content">
                    
                    <div class="content-header">
                        <h1 id="page-title">МОДЕЛЬ 901.4</h1>
                    </div>

                    <div id="grid-main" class="parts-grid">
                        <a href="#" class="part-group-card" onclick="showEngineView(event)"><div class="pg-img"><div class="pg-badge">1000000</div><img src="../img/parts/engine.png" alt="Двигатель"></div><div class="pg-info"><h3>ДВИГАТЕЛЬ</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">2000000</div><img src="../img/parts/chassis.png"></div><div class="pg-info"><h3>ШАССИ</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">3000000</div><img src="../img/parts/transmission.png"></div><div class="pg-info"><h3>КОРОБКА ПЕРЕДАЧ</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">4000000</div><img src="../img/parts/brakes.png"></div><div class="pg-info"><h3>ТОРМОЗА</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">5000000</div><img src="../img/parts/steering.png"></div><div class="pg-info"><h3>РУЛЕВОЕ УПРАВЛЕНИЕ</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">6000000</div><img src="../img/parts/cabin.png"></div><div class="pg-info"><h3>КАБИНА</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">7000000</div><img src="../img/parts/control.png"></div><div class="pg-info"><h3>СИСТЕМА УПРАВЛЕНИЯ</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">7500000</div><img src="../img/parts/hydraulics.png"></div><div class="pg-info"><h3>ГИДРАВЛИКА</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">8000000</div><img src="../img/parts/crane.png"></div><div class="pg-info"><h3>ПОДЪЕМНЫЙ КРАН</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">9000000</div><img src="../img/parts/harvesting.png"></div><div class="pg-info"><h3>ЛЗТ ОБОРУДОВАНИЕ</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">9990000</div><img src="../img/parts/misc.png"></div><div class="pg-info"><h3>РАЗЛИЧНОЕ ОБОРУДОВАНИЕ</h3></div></a>
                    </div>

                    <div id="grid-engine" class="parts-grid" style="display: none;">
                        <a href="#" class="part-group-card" onclick="showPartsView(event, 'Комплект прокладок', '1009100')"><div class="pg-img"><div class="pg-badge">1009100</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg></div><div class="pg-info"><h3>Комплект прокладок</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1010000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 4V2.5C12 2.22 11.78 2 11.5 2h-1c-.28 0-.5.22-.5.5V4H8v16h8V4h-2V2.5c0-.28-.22-.5-.5-.5h-1c-.28 0-.5.22-.5.5V4h-2z"/></svg></div><div class="pg-info"><h3>Впуск - выпуск</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1020000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm12 12h2v-2h-2v2zm6-8h-2V7h2v2zm-6 4h-2v-2h2v2zm-6 0h2v-2H9v2zm0 4h2v-2H9v2zm6-12h-2V3h-2v2h-2V3H7v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2z"/></svg></div><div class="pg-info"><h3>Блок двигателя</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1030000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M19 14h-4v-2h2V4H7v8h2v2H5c-1.1 0-2 .9-2 2v6h18v-6c0-1.1-.9-2-2-2zm-6 0h-2v-2h2v2z"/></svg></div><div class="pg-info"><h3>Топливная система</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1040000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg></div><div class="pg-info"><h3>Система охлаждения</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1050000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg></div><div class="pg-info"><h3>Система смазки</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1070000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M7 17v-5h10v5h2V7H5v10h2zm2-8h6v2H9V9z"/></svg></div><div class="pg-info"><h3>Электродвигатель стартера</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1080000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm1 15h-2v-6h2v6zm-1-8l2.5 5h-5L12 9z"/></svg></div><div class="pg-info"><h3>Генератор</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1090000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-19C8.14 2 5 5.14 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.86-3.14-7-7-7zm2.85 11.1l-.85.6V16h-4v-2.3l-.85-.6A4.997 4.997 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.8 3.16-2.15 4.1z"/></svg></div><div class="pg-info"><h3>Электрический</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1110000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 3.5L18.5 19H5.5L12 5.5z"/></svg></div><div class="pg-info"><h3>Подогреватель</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1120000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8 14H7v-4h4v4zm0-6H7V7h4v4zm6 6h-4v-4h4v4zm0-6h-4V7h4v4z"/></svg></div><div class="pg-info"><h3>Установка двигателя</h3></div></a>
                        <a href="#" class="part-group-card"><div class="pg-img"><div class="pg-badge">1130000</div><svg class="pg-placeholder-icon" style="display:block; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg></div><div class="pg-info"><h3>Кондиционер</h3></div></a>
                    </div>

                    <div id="view-parts" class="parts-view-container" style="display: none;">
                        
                        <div class="pv-scheme">
                            <img src="../img/scheme_c93_placeholder.jpg" alt="Схема" onerror="this.src='https://via.placeholder.com/600x400/fff/ddd?text=СХЕМА'">
                        </div>

                        <div class="pv-table-container">
                            <table class="parts-table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Id</th>
                                        <th>Number</th>
                                        <th style="text-align:center;">Quantity</th>
                                        <th>Name</th>
                                        <th>Specifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pt-id">1</td>
                                        <td class="pt-number">837062614</td>
                                        <td class="pt-qty">1</td>
                                        <td class="pt-name">Ремкомплект</td>
                                        <td class="pt-spec">Complete repair kit incl. pos 3</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-id">2</td>
                                        <td class="pt-number">837062606</td>
                                        <td class="pt-qty">1</td>
                                        <td class="pt-name">Комплект прокладок</td>
                                        <td class="pt-spec">(S1)</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-id">3</td>
                                        <td class="pt-number">837062607</td>
                                        <td class="pt-qty">1</td>
                                        <td class="pt-name">Комплект прокладок</td>
                                        <td class="pt-spec">(S1 + S2)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </main>

    <?php include '../../footer.php'; ?>

    <script>
        const VIEW_MAIN = 'main';
        const VIEW_ENGINE = 'engine';
        const VIEW_PARTS = 'parts';
        let currentView = VIEW_MAIN;

        window.addEventListener('load', () => {
            if (window.location.hash === '#parts') {
                renderPartsView('Комплект прокладок', '1009100'); 
            }
            else if (window.location.hash === '#engine') {
                renderEngineView();
            }
        });

        window.addEventListener('popstate', (event) => {
            if (event.state) {
                if (event.state.view === VIEW_PARTS) renderPartsView(event.state.title, event.state.code);
                else if (event.state.view === VIEW_ENGINE) renderEngineView();
                else renderMainView();
            } else {
                renderMainView();
            }
        });

        function toggleSidebar() {
            document.querySelector('.sidebar-toggle-btn').classList.toggle('active'); 
            document.querySelector('.parts-sidebar').classList.toggle('active');
        }

        function handleTopBack(event) {
            event.preventDefault();
            if (currentView === VIEW_PARTS) history.back();
            else if (currentView === VIEW_ENGINE) history.back();
            else window.location.href = "../../catalog.php?view=komatsu";
        }

        function showEngineView(event) {
            if(event) event.preventDefault();
            history.pushState({view: VIEW_ENGINE}, '', '#engine');
            renderEngineView();
        }

        function renderEngineView() {
            currentView = VIEW_ENGINE;
            updateHeader('901.4 / ДВИГАТЕЛЬ', '← НАЗАД К ГРУППАМ');
            activateMenu('li-engine', 'sub-engine');
            hideAllViews();
            
            document.querySelectorAll('.sb-submenu a').forEach(a => a.classList.remove('active'));
            
            document.getElementById('grid-engine').style.display = 'grid';
            scrollToTopMobile();
        }

        function showPartsView(event, title, code) {
            if(event) event.preventDefault();
            history.pushState({view: VIEW_PARTS, title: title, code: code}, '', '#parts');
            renderPartsView(title, code);
        }

        function renderPartsView(title, code) {
            currentView = VIEW_PARTS;
            const displayTitle = title ? title.toUpperCase() : 'ЗАПЧАСТИ';
            // ДИНАМИЧЕСКИЙ ЗАГОЛОВОК
            updateHeader('901.4 / ДВИГАТЕЛЬ / ' + displayTitle, '← НАЗАД К КАТЕГОРИЯМ');
            
            activateMenu('li-engine', 'sub-engine');
            
            document.querySelectorAll('.sb-submenu a').forEach(a => a.classList.remove('active'));
            if(code) {
                const activeLink = document.getElementById('lnk-' + code);
                if(activeLink) activeLink.classList.add('active');
            }

            hideAllViews();
            document.getElementById('view-parts').style.display = 'flex';
            scrollToTopMobile();
        }

        function renderMainView() {
            currentView = VIEW_MAIN;
            updateHeader('МОДЕЛЬ 901.4', '← НАЗАД К МОДЕЛЯМ');
            const li = document.getElementById('li-engine');
            const sub = document.getElementById('sub-engine');
            if (li && sub) { li.classList.remove('active'); sub.classList.remove('open'); }
            
            document.querySelectorAll('.sb-submenu a').forEach(a => a.classList.remove('active'));
            
            hideAllViews();
            document.getElementById('grid-main').style.display = 'grid';
        }

        function hideAllViews() {
            document.getElementById('grid-main').style.display = 'none';
            document.getElementById('grid-engine').style.display = 'none';
            document.getElementById('view-parts').style.display = 'none';
        }

        function updateHeader(titleText, btnText) {
            document.getElementById('page-title').innerText = titleText;
            const backBtn = document.getElementById('top-back-btn');
            if(backBtn) backBtn.innerText = btnText;
        }

        function activateMenu(liId, subId) {
            const li = document.getElementById(liId);
            const sub = document.getElementById(subId);
            if (li && sub) { li.classList.add('active'); sub.classList.add('open'); }
        }

        function scrollToTopMobile() {
            if (window.innerWidth <= 900) { window.scrollTo({ top: 100, behavior: 'smooth' }); }
        }
    </script>
</body>
</html>