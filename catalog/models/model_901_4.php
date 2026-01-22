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
        /* Сайдбар */
        .parts-sidebar {
            width: 280px;
            min-width: 280px;
            background: #111;
            border-right: 1px solid #222;
        }
        .sb-menu a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            text-align: right;
            line-height: 1.3;
            font-family: 'Manrope', sans-serif;
            color: #888;
            transition: 0.3s;
        }
        .sb-menu a:hover {
            color: #fff;
        }
        .sb-menu span {
            flex-shrink: 0;
            white-space: nowrap;
            color: var(--brand-green); /* Номера в меню зеленые */
            font-family: monospace;
            font-size: 11px;
            background: rgba(32, 191, 107, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* --- НОВЫЙ СТИЛЬ КАРТОЧЕК (ENGINEERING BADGE) --- */
        .parts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .part-group-card {
            background: #1a1a1a;
            border-radius: 8px;
            overflow: hidden;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            border: 1px solid transparent;
        }
        
        .part-group-card:hover {
            transform: translateY(-5px);
            border-color: var(--brand-green); /* Зеленая обводка при наведении */
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        /* Блок изображения */
        .pg-img {
            height: 170px;
            background: #fff;
            position: relative; /* Для позиционирования бейджа */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .pg-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .part-group-card:hover .pg-img img {
            transform: scale(1.05); /* Легкий зум картинки */
        }

        /* БЕЙДЖ С НОМЕРОМ (Фишка этого дизайна) */
        .pg-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #111;
            color: #fff;
            font-family: monospace;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
            z-index: 2;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* При наведении бейдж становится зеленым */
        .part-group-card:hover .pg-badge {
            background: var(--brand-green);
            color: #000;
            border-color: var(--brand-green);
        }

        /* Нижняя часть с текстом */
        .pg-info {
            padding: 15px 20px;
            background: #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 60px; /* Фиксированная высота подвала */
            border-top: 1px solid #252525;
        }

        .pg-info h3 {
            color: #eee;
            font-family: 'Manrope', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
            text-align: center;
        }

        .pg-placeholder-icon {
            width: 40px; 
            height: 40px; 
            fill: #ddd;
        }

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
                <a href="../../catalog.php?view=komatsu" class="btn-outline" style="padding: 10px 20px; font-size: 12px;">← НАЗАД К МОДЕЛЯМ</a>
            </div>

            <div class="parts-book-layout">
                
                <aside class="parts-sidebar" style="border-radius: 8px; padding: 25px;">
                    <div class="sidebar-header" style="border-bottom: 1px solid #222; padding-bottom: 20px; margin-bottom: 20px;">
                        <div class="sb-label" style="font-size: 10px; color: #555; letter-spacing: 1px;">МОДЕЛЬ</div>
                        <h1 class="sb-model" style="margin: 5px 0; color: #fff;">901.4</h1>
                        <div class="sb-sn" style="color: #666; font-size: 12px; font-family: monospace;">S/N: 9010041151</div>
                    </div>
                    
                    <div class="sb-title" style="color: #fff; font-size: 12px; margin-bottom: 15px;">ГРУППЫ</div>
                    
                    <ul class="sb-menu">
                        <li><a href="#"><span>1000000</span> Двигатель</a></li>
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
                    
                    <div class="parts-grid">
                        
                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">1000000</div>
                                <img src="../img/parts/engine.png" alt="Двигатель" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>ДВИГАТЕЛЬ</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">2000000</div>
                                <img src="../img/parts/chassis.png" alt="Шасси" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>ШАССИ</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">3000000</div>
                                <img src="../img/parts/transmission.png" alt="Коробка передач" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>КОРОБКА ПЕРЕДАЧ</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">4000000</div>
                                <img src="../img/parts/brakes.png" alt="Тормоза" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>ТОРМОЗА</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">5000000</div>
                                <img src="../img/parts/steering.png" alt="Рулевое управление" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>РУЛЕВОЕ УПРАВЛЕНИЕ</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">6000000</div>
                                <img src="../img/parts/cabin.png" alt="Кабина" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>КАБИНА</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">7000000</div>
                                <img src="../img/parts/control.png" alt="Система управления" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>СИСТЕМА УПРАВЛЕНИЯ</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">7500000</div>
                                <img src="../img/parts/hydraulics.png" alt="Гидравлика" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>ГИДРАВЛИКА</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">8000000</div>
                                <img src="../img/parts/crane.png" alt="Подъемный кран" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>ПОДЪЕМНЫЙ КРАН</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">9000000</div>
                                <img src="../img/parts/harvesting.png" alt="ЛЗТ оборудование" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>ЛЗТ ОБОРУДОВАНИЕ</h3>
                            </div>
                        </a>

                        <a href="#" class="part-group-card">
                            <div class="pg-img">
                                <div class="pg-badge">9990000</div>
                                <img src="../img/parts/misc.png" alt="Различное оборудование" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <svg class="pg-placeholder-icon" style="display:none;" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                            <div class="pg-info">
                                <h3>РАЗЛИЧНОЕ ОБОРУДОВАНИЕ</h3>
                            </div>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include '../../footer.php'; ?>
</body>
</html>