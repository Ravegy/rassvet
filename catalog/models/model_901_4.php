<?php
$data = require __DIR__ . '/../../data/model_901_4_data.php';
$css_ver = file_exists(__DIR__ . '/../../css/style.css') ? filemtime(__DIR__ . '/../../css/style.css') : time();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['info']['model'] ?> | Запчасти Komatsu</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css?v=<?= $css_ver ?>">
    <link rel="icon" href="../../favicon.png" type="image/png">
</head>
<body>

    <?php 
    $path = '../../'; 
    include '../../header.php'; 
    ?>

    <main style="padding-bottom: 60px; padding-top: 40px;">
        <div class="container">
            
            <div id="breadcrumbs" class="breadcrumbs">
                </div>

            <div class="parts-book-layout" id="mainBookLayout">
                
                <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                    <span>Меню <?= $data['info']['model'] ?></span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>

                <aside class="parts-sidebar" id="partsSidebar">
                    <div class="sidebar-header">
                        <div class="sb-label">МОДЕЛЬ</div>
                        <h1 class="sb-model"><?= $data['info']['model'] ?></h1>
                        <div class="sb-sn">S/N: <?= $data['info']['sn'] ?></div>
                    </div>
                    <div class="sb-title">ГРУППЫ</div>
                    <ul class="sb-menu">
                        <li id="li-1000000">
                            <a onclick="navigateToGroup('1000000', 'Двигатель')"><span>1000000</span> Двигатель</a>
                            <ul class="sb-submenu" id="sub-1000000">
                                <?php foreach($data['engine_subgroups'] as $sub): ?>
                                <li>
                                    <a id="lnk-<?= $sub['id'] ?>" href="#" onclick="navigateToSub(event, '1000000', '<?= $sub['id'] ?>', '<?= $sub['name'] ?>')">
                                       <?= $sub['name'] ?> <span><?= $sub['id'] ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        
                        <?php foreach($data['groups'] as $group): ?>
                            <?php if($group['id'] !== '1000000'): ?>
                            <li id="li-<?= $group['id'] ?>">
                                <a href="#"><span><?= $group['id'] ?></span> <?= $group['name'] ?></a>
                            </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </aside>

                <div class="parts-content">
                    <div class="content-header"><h1 id="page-title">МОДЕЛЬ <?= $data['info']['model'] ?></h1></div>

                    <div id="grid-main" class="parts-grid">
                        <?php foreach($data['groups'] as $group): ?>
                        <a href="#" class="part-group-card" <?php if($group['id'] === '1000000') echo "onclick=\"navigateToGroup('1000000', 'Двигатель')\""; ?>>
                            <div class="pg-img"><div class="pg-badge"><?= $group['id'] ?></div><img src="../img/parts/<?= $group['icon'] ?>" alt="<?= $group['name'] ?>"></div>
                            <div class="pg-info"><h3><?= $group['name'] ?></h3></div>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <div id="grid-1000000" class="parts-grid" style="display: none;">
                        <?php foreach($data['engine_subgroups'] as $sub): ?>
                        <a href="#" class="part-group-card" onclick="navigateToSub(event, '1000000', '<?= $sub['id'] ?>', '<?= $sub['name'] ?>')">
                            <div class="pg-img"><div class="pg-badge"><?= $sub['id'] ?></div><svg style="width:40px; height:40px; fill:#ccc;" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg></div>
                            <div class="pg-info"><h3><?= $sub['name'] ?></h3></div>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <?php foreach($data['engine_subgroups'] as $sub): 
                        $id = $sub['id'];
                        $parts = $data['parts'][$id] ?? [];
                        $scheme = isset($sub['scheme']) && $sub['scheme'] ? $sub['scheme'] : 'scheme_c93_placeholder.jpg';
                    ?>
                    <div id="view-<?= $id ?>" class="parts-view-container" style="display: none;">
                        <div class="pv-scheme" style="padding: 0; border: none; background: transparent;">
                            <div class="pv-scheme-wrapper">
                                <div class="scheme-toolbar">
                                    <button class="st-btn" onclick="toggleWideMode(this)" title="Развернуть/Свернуть">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/></svg>
                                    </button>
                                    <div class="st-zoom-group">
                                        <button class="st-btn" onclick="zoomImage('img-<?= $id ?>', -0.3)" title="Уменьшить"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button>
                                        <button class="st-btn" onclick="zoomImage('img-<?= $id ?>', 0.3)" title="Увеличить"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button>
                                    </div>
                                </div>
                                <div class="pv-scheme-viewport" 
                                     id="viewport-<?= $id ?>"
                                     onmousedown="startDrag(event, 'img-<?= $id ?>')"
                                     onmousemove="drag(event, 'img-<?= $id ?>')"
                                     onmouseup="endDrag('img-<?= $id ?>')"
                                     onmouseleave="endDrag('img-<?= $id ?>')"
                                     ontouchstart="startDrag(event, 'img-<?= $id ?>')"
                                     ontouchmove="drag(event, 'img-<?= $id ?>')"
                                     ontouchend="endDrag('img-<?= $id ?>')">
                                    <img id="img-<?= $id ?>" class="pan-image" src="../img/schemes/<?= $scheme ?>" alt="Схема" onerror="this.src='../img/scheme_c93_placeholder.jpg'">
                                </div>
                            </div>
                        </div>

                        <div class="pv-table-container">
                            <?php if (!empty($parts)): ?>
                            <table class="parts-table">
                                <thead><tr><th style="width:40px;">#</th><th>Артикул</th><th style="text-align:center;">Кол-во</th><th>Наименование</th><th>Описание</th></tr></thead>
                                <tbody>
                                    <?php foreach($parts as $part): ?>
                                    <tr>
                                        <td class="pt-id"><?= $part['id'] ?></td>
                                        <td class="pt-number"><?= $part['number'] ?></td>
                                        <td style="text-align:center; color:#666;"><?= $part['qty'] ?></td>
                                        <td style="color:#fff; font-weight:600;"><?= $part['name'] ?></td>
                                        <td style="color:#888; font-size:11px;"><?= $part['spec'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <div style="padding: 40px; text-align: center; color: #666; font-size: 14px;">Нет запчастей для этого узла.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </main>

    <?php include '../../footer.php'; ?>

    <script>
        const VIEW_MAIN = 'main';
        const MODEL_NAME = '<?= $data['info']['model'] ?>';
        let currentView = VIEW_MAIN;
        const imageStates = {};

        // --- 1. ИНИЦИАЛИЗАЦИЯ --- //
        window.addEventListener('load', () => {
            const params = new URLSearchParams(window.location.search);
            const groupId = params.get('group');
            const subId = params.get('sub');

            if (subId && groupId) renderSubView(groupId, subId);
            else if (groupId) renderGroupView(groupId);
            else renderMainView();
        });

        window.addEventListener('popstate', (event) => {
            const params = new URLSearchParams(window.location.search);
            const groupId = params.get('group');
            const subId = params.get('sub');

            if (subId && groupId) renderSubView(groupId, subId);
            else if (groupId) renderGroupView(groupId);
            else renderMainView();
        });


        // --- 2. НАВИГАЦИЯ --- //
        function navigateToGroup(groupId, title) {
            if (event) event.preventDefault();
            const url = new URL(window.location);
            url.searchParams.set('group', groupId);
            url.searchParams.delete('sub');
            window.history.pushState({}, '', url);
            renderGroupView(groupId, title);
        }

        function navigateToSub(event, groupId, subId, title) {
            if (event) event.preventDefault();
            const url = new URL(window.location);
            url.searchParams.set('group', groupId);
            url.searchParams.set('sub', subId);
            window.history.pushState({}, '', url);
            renderSubView(groupId, subId, title);
        }

        // --- 3. ГЕНЕРАЦИЯ ХЛЕБНЫХ КРОШЕК --- //
        function updateBreadcrumbs(level, groupTitle = '', subTitle = '') {
            const bc = document.getElementById('breadcrumbs');
            const mainLink = `<a href="../../catalog.php?view=komatsu" class="bc-link">КАТАЛОГ</a>`;
            const modelLink = `<a onclick="renderMainView(); window.history.pushState({}, '', window.location.pathname);" class="bc-link">МОДЕЛЬ ${MODEL_NAME}</a>`;
            const sep = `<span class="bc-sep">/</span>`;
            
            let html = mainLink + sep;

            if (level === 'main') {
                html += `<span class="bc-current">МОДЕЛЬ ${MODEL_NAME}</span>`;
                document.getElementById('page-title').innerText = `МОДЕЛЬ ${MODEL_NAME}`;
            } 
            else if (level === 'group') {
                html += modelLink + sep + `<span class="bc-current">${groupTitle}</span>`;
                document.getElementById('page-title').innerText = `${MODEL_NAME} / ${groupTitle}`;
            } 
            else if (level === 'sub') {
                // Ссылка на группу должна вести назад
                const groupLink = `<a onclick="navigateToGroup('1000000', '${groupTitle}')" class="bc-link">${groupTitle}</a>`;
                
                html += modelLink + sep + groupLink + sep + `<span class="bc-current">${subTitle}</span>`;
                document.getElementById('page-title').innerText = subTitle;
            }

            bc.innerHTML = html;
        }


        // --- 4. РЕНДЕРИНГ --- //
        function renderMainView() {
            currentView = VIEW_MAIN;
            
            // Чистим URL если вернулись на главную
            const url = new URL(window.location);
            url.searchParams.delete('group');
            url.searchParams.delete('sub');
            window.history.replaceState({}, '', url);

            updateBreadcrumbs('main');
            
            document.querySelectorAll('.sb-submenu').forEach(ul => ul.classList.remove('open'));
            document.querySelectorAll('.sb-menu > li').forEach(li => li.classList.remove('active'));
            hideAllViews();
            document.getElementById('grid-main').style.display = 'grid';
        }

        function renderGroupView(groupId, title) {
            currentView = 'group-' + groupId;
            
            if (!title) {
                if (groupId === '1000000') title = 'Двигатель';
                else title = 'ГРУППА ' + groupId;
            }

            updateBreadcrumbs('group', title);
            activateMenu('li-' + groupId, 'sub-' + groupId);
            
            hideAllViews();
            const grid = document.getElementById('grid-' + groupId);
            if(grid) grid.style.display = 'grid';
            
            document.querySelectorAll('.sb-submenu a').forEach(a => a.classList.remove('active'));
            scrollToTopMobile();
        }

        function renderSubView(groupId, subId, title) {
            currentView = 'view-' + subId;
            const groupTitle = 'Двигатель'; // Пока хардкод для примера, можно брать из DOM
            
            if (!title) {
                const link = document.getElementById('lnk-' + subId);
                title = link ? link.childNodes[0].nodeValue.trim() : 'ПОДГРУППА';
            }

            updateBreadcrumbs('sub', groupTitle, title);
            activateMenu('li-' + groupId, 'sub-' + groupId);
            
            document.querySelectorAll('.sb-submenu a').forEach(a => a.classList.remove('active'));
            const activeLink = document.getElementById('lnk-' + subId);
            if(activeLink) activeLink.classList.add('active');

            hideAllViews();
            const target = document.getElementById('view-' + subId);
            if(target) target.style.display = 'flex';
            
            // Сброс зума
            const imgId = 'img-' + subId;
            if (imageStates[imgId]) {
                imageStates[imgId] = { scale: 1, panning: false, startX: 0, startY: 0, posX: 0, posY: 0 };
                updateImageTransform(imgId);
            }
            scrollToTopMobile();
        }


        // --- UTILS --- //
        function hideAllViews() {
            document.querySelectorAll('.parts-grid, .parts-view-container').forEach(el => el.style.display = 'none');
        }
        function activateMenu(liId, subId) {
            const li = document.getElementById(liId);
            const sub = document.getElementById(subId);
            if (li) li.classList.add('active');
            if (sub) sub.classList.add('open');
        }
        function scrollToTopMobile() {
            if (window.innerWidth <= 900) window.scrollTo({ top: 100, behavior: 'smooth' });
        }
        function toggleWideMode(btn) {
            document.getElementById('mainBookLayout').classList.toggle('is-expanded');
            btn.classList.toggle('active');
        }
        function toggleSidebar() {
            document.querySelector('.sidebar-toggle-btn').classList.toggle('active'); 
            document.querySelector('.parts-sidebar').classList.toggle('active');
        }

        // --- ZOOM & PAN --- //
        function initImageState(imgId) {
            if (!imageStates[imgId]) imageStates[imgId] = { scale: 1, panning: false, startX: 0, startY: 0, posX: 0, posY: 0 };
        }
        function updateImageTransform(imgId) {
            const state = imageStates[imgId];
            const img = document.getElementById(imgId);
            if (img) img.style.transform = `translate(calc(-50% + ${state.posX}px), calc(-50% + ${state.posY}px)) scale(${state.scale})`;
        }
        function zoomImage(imgId, step) {
            initImageState(imgId);
            const state = imageStates[imgId];
            let newScale = state.scale + step;
            if (newScale < 0.5) newScale = 0.5;
            if (newScale > 5) newScale = 5; 
            state.scale = newScale;
            updateImageTransform(imgId);
        }
        function startDrag(e, imgId) {
            e.preventDefault();
            initImageState(imgId);
            const state = imageStates[imgId];
            state.panning = true;
            state.startX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            state.startY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;
            document.getElementById('viewport-' + imgId.replace('img-', '')).style.cursor = 'grabbing';
        }
        function drag(e, imgId) {
            const state = imageStates[imgId];
            if (!state || !state.panning) return;
            e.preventDefault();
            const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            const clientY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;
            state.posX += (clientX - state.startX);
            state.posY += (clientY - state.startY);
            state.startX = clientX;
            state.startY = clientY;
            updateImageTransform(imgId);
        }
        function endDrag(imgId) {
            const state = imageStates[imgId];
            if (state && state.panning) {
                state.panning = false;
                document.getElementById('viewport-' + imgId.replace('img-', '')).style.cursor = 'grab';
            }
        }
    </script>
</body>
</html>