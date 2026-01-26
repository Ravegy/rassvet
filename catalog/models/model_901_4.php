<?php
$config = [
    'data_file' => __DIR__ . '/../../data/model_901_4_data.php', 
];
$data = require $config['data_file'];
// ВРЕМЕННО: force refresh
$css_ver = time();

$folder_config = [
    '1000000' => 'engine_subgroups',
    '1010000' => 'intake_exhaust_subgroups',
];

$allItems = []; $parentMap = [];
foreach ($data['groups'] as $g) { $allItems[$g['id']] = $g['name']; $parentMap[$g['id']] = 'root'; }
foreach ($folder_config as $parentId => $dataKey) {
    if (isset($data[$dataKey])) {
        foreach ($data[$dataKey] as $child) { $allItems[$child['id']] = $child['name']; $parentMap[$child['id']] = $parentId; }
    }
}
$FOLDER_IDS = array_map('strval', array_keys($folder_config));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['info']['model'] ?> | Запчасти</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css?v=<?= $css_ver ?>">
    <link rel="icon" href="../../favicon.png" type="image/png">
    <style>
        .sb-submenu .sb-submenu { margin-left: 2px; border-left: 1px solid #444; margin-top: 5px; margin-bottom: 5px; }
        .sb-submenu .sb-submenu a { font-size: 11px; color: #777; padding-left: 15px!important; }
        .sb-submenu .sb-submenu a::before { width: 10px; } 
        .sb-submenu .sb-submenu a:hover, .sb-submenu .sb-submenu a.active { color: #fff; }
    </style>
</head>
<body>

    <?php 
    $path = '../../'; 
    include '../../header.php'; 
    ?>

    <main style="padding-bottom: 60px; padding-top: 40px;">
        <div class="container">
            <div id="breadcrumbs" class="breadcrumbs"></div>

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
                        <?php foreach($data['groups'] as $group): 
                            $gid = $group['id']; $gname = $group['name']; $isFolder = array_key_exists($gid, $folder_config);
                        ?>
                            <li id="li-<?= $gid ?>">
                                <a onclick="navigateTo('<?= $gid ?>')"><span><?= $gid ?></span> <?= $gname ?></a>
                                <?php if($isFolder): $l2_key = $folder_config[$gid]; $l2_items = $data[$l2_key] ?? []; ?>
                                    <ul class="sb-submenu tree-view-list" id="sub-<?= $gid ?>">
                                        <?php foreach($l2_items as $item2): 
                                            $id2 = $item2['id']; $name2 = $item2['name']; $isFolder2 = array_key_exists($id2, $folder_config);
                                        ?>
                                        <li id="li-<?= $id2 ?>">
                                            <a id="lnk-<?= $id2 ?>" onclick="navigateTo('<?= $id2 ?>')">
                                               <?= $name2 ?> <span class="tree-id-badge"><?= $id2 ?></span>
                                            </a>
                                            <?php if($isFolder2): $l3_key = $folder_config[$id2]; $l3_items = $data[$l3_key] ?? []; ?>
                                                <ul class="sb-submenu tree-view-list" id="sub-<?= $id2 ?>" style="display:none;">
                                                    <?php foreach($l3_items as $item3): ?>
                                                    <li>
                                                        <a id="lnk-<?= $item3['id'] ?>" onclick="navigateTo('<?= $item3['id'] ?>')">
                                                            <?= $item3['name'] ?> <span class="tree-id-badge"><?= $item3['id'] ?></span>
                                                        </a>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>

                <div class="parts-content">
                    <div class="content-header"><h1 id="page-title">МОДЕЛЬ <?= $data['info']['model'] ?></h1></div>

                    <div id="grid-root" class="parts-grid">
                        <?php foreach($data['groups'] as $group): ?>
                        <a onclick="navigateTo('<?= $group['id'] ?>')" class="part-group-card">
                            <div class="pg-img"><div class="pg-badge"><?= $group['id'] ?></div><img src="../img/parts/<?= $group['icon'] ?>" alt="<?= $group['name'] ?>"></div>
                            <div class="pg-info"><h3><?= $group['name'] ?></h3></div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach($folder_config as $folderId => $dataKey): $items = $data[$dataKey] ?? []; ?>
                        <div id="grid-<?= $folderId ?>" class="parts-grid" style="display: none;">
                            <?php foreach($items as $item): ?>
                            <a onclick="navigateTo('<?= $item['id'] ?>')" class="part-group-card">
                                <div class="pg-img"><div class="pg-badge"><?= $item['id'] ?></div><svg style="width:40px; height:40px; fill:#ccc;" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/><path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3z"/></svg></div>
                                <div class="pg-info"><h3><?= $item['name'] ?></h3></div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                    <?php 
                    $allViewIds = [];
                    foreach($folder_config as $fid => $dkey) {
                        if(isset($data[$dkey])) { foreach($data[$dkey] as $it) { if(!array_key_exists($it['id'], $folder_config)) { $allViewIds[] = $it; } } }
                    }
                    foreach($allViewIds as $sub): $id = $sub['id']; $parts = $data['parts'][$id] ?? []; $scheme = isset($sub['scheme']) && $sub['scheme'] ? $sub['scheme'] : 'scheme_c93_placeholder.jpg';
                    ?>
                    <div id="view-<?= $id ?>" class="parts-view-container" style="display: none;">
                        <div class="pv-scheme" style="padding: 0; border: none; background: transparent;">
                            <div class="pv-scheme-wrapper">
                                <div class="scheme-toolbar">
                                    <button class="st-btn" onclick="toggleWideMode(this)" title="Развернуть"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/></svg></button>
                                    <div class="st-zoom-group">
                                        <button class="st-btn" onclick="zoomImage('img-<?= $id ?>', -0.3)"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button>
                                        <button class="st-btn" onclick="zoomImage('img-<?= $id ?>', 0.3)"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button>
                                    </div>
                                </div>
                                <div class="pv-scheme-viewport" id="viewport-<?= $id ?>"
                                     onmousedown="startDrag(event, 'img-<?= $id ?>')" onmousemove="drag(event, 'img-<?= $id ?>')" onmouseup="endDrag('img-<?= $id ?>')" onmouseleave="endDrag('img-<?= $id ?>')"
                                     ontouchstart="startDrag(event, 'img-<?= $id ?>')" ontouchmove="drag(event, 'img-<?= $id ?>')" ontouchend="endDrag('img-<?= $id ?>')">
                                    <img id="img-<?= $id ?>" class="pan-image" src="../img/schemes/<?= $scheme ?>" alt="Схема" onerror="this.src='../img/scheme_c93_placeholder.jpg'">
                                </div>
                            </div>
                        </div>
                        <div class="pv-table-container">
                            <?php if (!empty($parts)): ?>
                            <table class="parts-table">
                                <thead><tr><th style="width:40px;">#</th><th>Артикул</th><th style="text-align:center;">Кол-во</th><th>Наименование</th><th>Описание</th></tr></thead>
                                <tbody>
                                    <?php foreach($parts as $part): 
                                        $rowId = 'row-' . $id . '-' . $part['id'];
                                        $actionId = 'action-' . $id . '-' . $part['id'];
                                    ?>
                                    <tr id="<?= $rowId ?>" class="part-row" onclick="toggleRow('<?= $actionId ?>', '<?= $rowId ?>')">
                                        <td class="pt-id"><?= $part['id'] ?></td>
                                        <td class="pt-number"><?= $part['number'] ?></td>
                                        <td style="text-align:center; color:#666;"><?= $part['qty'] ?></td>
                                        <td style="color:#fff; font-weight:600;"><?= $part['name'] ?></td>
                                        <td style="color:#888; font-size:11px;"><?= $part['spec'] ?></td>
                                    </tr>
                                    <tr id="<?= $actionId ?>" class="part-actions-row">
                                        <td colspan="5" style="padding:0; border:none;">
                                            <div class="pa-content">
                                                <button class="btn-action btn-add-fav" data-id="<?= $part['number'] ?>" onclick="event.stopPropagation(); toggleFav(this, '<?= $part['number'] ?>', '<?= $part['number'] ?>', '<?= $part['name'] ?>')">
                                                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                    Избранное
                                                </button>
                                                <button class="btn-action btn-add-cart" data-id="<?= $part['number'] ?>" onclick="event.stopPropagation(); addToCart('<?= $part['number'] ?>', '<?= $part['number'] ?>', '<?= $part['name'] ?>')">
                                                    <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                    В корзину
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?><div style="padding:40px;text-align:center;color:#666;font-size:14px;">Нет запчастей для этого узла.</div><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
    <?php include '../../footer.php'; ?>

    <script>
        const MODEL_NAME = '<?= $data['info']['model'] ?>';
        const ITEM_NAMES = <?= json_encode($allItems) ?>;
        const PARENT_MAP = <?= json_encode($parentMap) ?>;
        const FOLDER_IDS = <?= json_encode($FOLDER_IDS) ?>;
        const imageStates = {};

        function toggleRow(actionId, rowId) {
            document.getElementById(actionId).classList.toggle('open');
            document.getElementById(rowId).classList.toggle('active');
        }

        window.addEventListener('load', handleRoute);
        window.addEventListener('popstate', handleRoute);

        function handleRoute() {
            const params = new URLSearchParams(window.location.search);
            const id = params.get('id');
            if (id) navigateTo(id, false); else showRoot();
        }

        function navigateTo(id, pushState = true) {
            if (event) event.preventDefault();
            const isFolder = FOLDER_IDS.includes(String(id));
            const type = isFolder ? 'grid' : 'view';

            document.querySelectorAll('.parts-grid, .parts-view-container').forEach(el => el.style.display = 'none');
            const target = document.getElementById(type + '-' + id);
            
            if(target) {
                target.style.display = (type === 'grid') ? 'grid' : 'flex';
                if(type === 'view') {
                    const imgId = 'img-' + id;
                    if(imageStates[imgId]) { imageStates[imgId] = { scale: 1, panning: false, startX: 0, startY: 0, posX: 0, posY: 0 }; updateImageTransform(imgId); }
                    // ПРОВЕРЯЕМ КНОПКИ ПРИ ОТКРЫТИИ СХЕМЫ
                    if(typeof checkButtonStates === 'function') checkButtonStates();
                }
            }

            if (pushState) {
                const url = new URL(window.location);
                url.searchParams.set('id', id); url.searchParams.delete('group'); url.searchParams.delete('sub');
                window.history.pushState({}, '', url);
            }
            buildBreadcrumbs(id); updateSidebar(id); scrollToTopMobile();
        }

        function showRoot() {
            document.querySelectorAll('.parts-grid, .parts-view-container').forEach(el => el.style.display = 'none');
            document.getElementById('grid-root').style.display = 'grid';
            const bc = document.getElementById('breadcrumbs');
            bc.innerHTML = `<a href="../../catalog.php?view=komatsu" class="bc-link">КАТАЛОГ</a><span class="bc-sep">/</span><span class="bc-current">МОДЕЛЬ ${MODEL_NAME}</span>`;
            document.getElementById('page-title').innerText = `МОДЕЛЬ ${MODEL_NAME}`;
            document.querySelectorAll('.sb-submenu').forEach(ul => { ul.classList.remove('open'); ul.style.display = 'none'; });
            document.querySelectorAll('.sb-menu li, .sb-menu a').forEach(el => el.classList.remove('active'));
            const url = new URL(window.location); url.searchParams.delete('id'); window.history.replaceState({}, '', url);
        }

        function buildBreadcrumbs(currentId) {
            const bc = document.getElementById('breadcrumbs');
            let html = `<a href="../../catalog.php?view=komatsu" class="bc-link">КАТАЛОГ</a><span class="bc-sep">/</span><a onclick="showRoot()" class="bc-link">МОДЕЛЬ ${MODEL_NAME}</a>`;
            let path = []; let curr = currentId;
            while(curr && curr !== 'root') { path.unshift(curr); curr = PARENT_MAP[curr]; }
            path.forEach((pid, index) => {
                const name = ITEM_NAMES[pid] || pid;
                html += `<span class="bc-sep">/</span>`;
                if (index === path.length - 1) {
                    html += `<span class="bc-current">${name} <span style="color:var(--brand-green); font-size:0.8em;">${pid}</span></span>`;
                    document.getElementById('page-title').innerHTML = `${name} <span style="color:var(--brand-green); font-family:monospace; margin-left:15px; background:rgba(37,211,102,0.1); padding:4px 8px; border-radius:6px; font-size: 0.6em; vertical-align: middle;">${pid}</span>`;
                } else { html += `<a onclick="navigateTo('${pid}')" class="bc-link">${name}</a>`; }
            });
            bc.innerHTML = html;
        }

        function updateSidebar(activeId) {
            document.querySelectorAll('.sb-submenu a').forEach(a => a.classList.remove('active'));
            document.querySelectorAll('.sb-menu li').forEach(li => li.classList.remove('active'));
            document.querySelectorAll('.sb-submenu').forEach(ul => { ul.style.display = 'none'; ul.classList.remove('open'); });
            let curr = activeId;
            const activeLink = document.getElementById('lnk-' + curr);
            if(activeLink) activeLink.classList.add('active');
            while(curr && curr !== 'root') {
                const parentId = PARENT_MAP[curr];
                const parentLi = document.getElementById('li-' + curr);
                if(parentLi) parentLi.classList.add('active');
                if(parentId && parentId !== 'root') { const parentSub = document.getElementById('sub-' + parentId); if(parentSub) { parentSub.style.display = 'flex'; parentSub.classList.add('open'); } }
                const mySub = document.getElementById('sub-' + curr); if(mySub) { mySub.style.display = 'flex'; mySub.classList.add('open'); }
                curr = parentId;
            }
        }
        function scrollToTopMobile() { if (window.innerWidth <= 900) window.scrollTo({ top: 100, behavior: 'smooth' }); }
        function toggleWideMode(btn) { document.getElementById('mainBookLayout').classList.toggle('is-expanded'); btn.classList.toggle('active'); }
        function toggleSidebar() { document.querySelector('.sidebar-toggle-btn').classList.toggle('active'); document.querySelector('.parts-sidebar').classList.toggle('active'); }
        function initImageState(imgId) { if (!imageStates[imgId]) imageStates[imgId] = { scale: 1, panning: false, startX: 0, startY: 0, posX: 0, posY: 0 }; }
        function updateImageTransform(imgId) { const state = imageStates[imgId]; const img = document.getElementById(imgId); if (img) img.style.transform = `translate(calc(-50% + ${state.posX}px), calc(-50% + ${state.posY}px)) scale(${state.scale})`; }
        function zoomImage(imgId, step) { initImageState(imgId); const state = imageStates[imgId]; let newScale = state.scale + step; if (newScale < 0.5) newScale = 0.5; if (newScale > 5) newScale = 5; state.scale = newScale; updateImageTransform(imgId); }
        function startDrag(e, imgId) { e.preventDefault(); initImageState(imgId); const state = imageStates[imgId]; state.panning = true; state.startX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX; state.startY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY; document.getElementById('viewport-' + imgId.replace('img-', '')).style.cursor = 'grabbing'; }
        function drag(e, imgId) { const state = imageStates[imgId]; if (!state || !state.panning) return; e.preventDefault(); const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX; const clientY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY; state.posX += (clientX - state.startX); state.posY += (clientY - state.startY); state.startX = clientX; state.startY = clientY; updateImageTransform(imgId); }
        function endDrag(imgId) { const state = imageStates[imgId]; if (state && state.panning) { state.panning = false; document.getElementById('viewport-' + imgId.replace('img-', '')).style.cursor = 'grab'; } }
    </script>
</body>
</html>