<?php
$base = isset($path) ? $path : '';
?>
<header class="header">
    <div class="container">
        <div class="header-main">
            <a href="<?= $base ?>index.php" class="logo-text"><h1>РАССВЕТ-С</h1></a>

            <nav class="header-nav">
                <a href="<?= $base ?>index.php" class="nav-link">Главная</a>
                <a href="<?= $base ?>catalog.php" class="nav-link">Каталог Komatsu</a>
                <a href="<?= $base ?>about.php" class="nav-link">О компании</a>
                <a href="<?= $base ?>delivery.php" class="nav-link">Доставка и оплата</a>
                <a href="<?= $base ?>contacts.php" class="nav-link">Контакты</a>
            </nav>

            <div class="header-right-group">
                <div class="search-wrapper">
                    <button class="header-icon-btn search-toggle" onclick="toggleSearch()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </button>
                    <div class="search-dropdown-container" id="searchContainer">
                        <input type="text" id="globalSearchInput" class="search-input" placeholder="Введите артикул..." autocomplete="off">
                        <div id="searchSuggestions" class="search-suggestions"></div>
                    </div>
                </div>

                <div class="header-contacts">
                    <button class="header-icon-btn" onclick="openModal('fav')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span class="icon-count" id="fav-count">0</span>
                    </button>

                    <button class="header-icon-btn" onclick="openModal('cart')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span class="icon-count" id="cart-count">0</span>
                    </button>
                </div>

                <button class="menu-btn" onclick="document.querySelector('.header-nav').classList.toggle('active')">
                    <svg viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
            </div>
        </div>
    </div>
</header>

<div id="toast-container"></div>

<div class="modal-overlay" id="fav-modal" onclick="if(event.target === this) closeModal('fav')">
    <div class="modal-window">
        <div class="modal-header">
            <h3 class="modal-title">Избранное</h3>
            <button class="modal-close" onclick="closeModal('fav')"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body" id="fav-list">
            </div>
        </div>
</div>

<div class="modal-overlay" id="cart-modal" onclick="if(event.target === this) closeModal('cart')">
    <div class="modal-window">
        <div class="modal-header">
            <h3 class="modal-title">Корзина</h3>
            <button class="modal-close" onclick="closeModal('cart')"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body" id="cart-list">
            </div>
        <div class="modal-footer">
            <a href="<?= $base ?>checkout.php" class="btn-primary" style="width: 100%; text-align: center;">Запросить цену</a>
        </div>
    </div>
</div>

<script>
const SITE_BASE_PATH = '<?= $base ?>';

// --- TOASTS ---
function showToast(msg, type='success') {
    const c = document.getElementById('toast-container');
    const t = document.createElement('div'); t.className = `toast ${type}`;
    t.innerHTML = (type==='success'?'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>':'') + `<span>${msg}</span>`;
    c.appendChild(t); requestAnimationFrame(()=>t.classList.add('show'));
    setTimeout(()=>{t.classList.remove('show');setTimeout(()=>t.remove(),400)},3000);
}

// --- SEARCH ---
function toggleSearch() {
    const c = document.getElementById('searchContainer'); c.classList.toggle('active');
    if(c.classList.contains('active')) document.getElementById('globalSearchInput').focus();
}
const sInp = document.getElementById('globalSearchInput');
const sBox = document.getElementById('searchSuggestions');
sInp.addEventListener('input', function() {
    const q = this.value.trim();
    if(q.length<2){sBox.style.display='none';return;}
    fetch(SITE_BASE_PATH + 'api/search_parts.php?q='+encodeURIComponent(q))
        .then(r=>r.json()).then(d=>{
            sBox.innerHTML='';
            if(d.length>0){sBox.style.display='block';d.forEach(i=>{
                const el=document.createElement('div'); el.className='suggestion-item';
                el.innerHTML=`<span class="s-art">${i.number}</span> <span class="s-name">${i.name}</span>`;
                el.onclick=()=>window.location.href=SITE_BASE_PATH+'part_details.php?number='+encodeURIComponent(i.number);
                sBox.appendChild(el);
            });}else{sBox.style.display='none';}
        });
});
document.addEventListener('click',e=>{if(!document.querySelector('.search-wrapper').contains(e.target))document.getElementById('searchContainer').classList.remove('active')});

// --- DATA LOGIC ---
function updateCounters() {
    const cart = JSON.parse(localStorage.getItem('cart'))||[];
    const fav = JSON.parse(localStorage.getItem('fav'))||[];
    let cnt=0; cart.forEach(i=>cnt+=(i.qty||1));
    document.getElementById('cart-count').innerText = cnt;
    document.getElementById('fav-count').innerText = fav.length;
    if(typeof checkButtonStates === 'function') checkButtonStates();
}

function checkButtonStates() {
    const cart = JSON.parse(localStorage.getItem('cart'))||[];
    const fav = JSON.parse(localStorage.getItem('fav'))||[];
    document.querySelectorAll('.btn-add-cart').forEach(btn => {
        if(cart.find(i=>i.id === btn.getAttribute('data-id'))) {
            btn.classList.add('active'); btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg> В корзине';
        } else {
            btn.classList.remove('active'); btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> В корзину';
        }
    });
    document.querySelectorAll('.btn-add-fav').forEach(btn => {
        if(fav.find(i=>i.id === btn.getAttribute('data-id'))) btn.classList.add('active');
        else btn.classList.remove('active');
    });
}

// SAVE WITH LINK!
function addToCart(partId, number, name) {
    let cart = JSON.parse(localStorage.getItem('cart'))||[];
    let ex = cart.find(i=>i.id === partId);
    if(ex) { ex.qty++; showToast(`Кол-во ${number} обновлено`, 'info'); }
    else { 
        // Сохраняем текущую ссылку, чтобы потом вернуться
        cart.push({id:partId, number:number, name:name, qty:1, link: window.location.href}); 
        showToast(`Товар ${number} в корзине`); 
    }
    localStorage.setItem('cart', JSON.stringify(cart)); updateCounters();
}

function toggleFav(btn, partId, number, name) {
    let fav = JSON.parse(localStorage.getItem('fav'))||[];
    let idx = fav.findIndex(i=>i.id === partId);
    if(idx > -1) { fav.splice(idx, 1); showToast(`${number} удален из избранного`, 'info'); }
    else { 
        // Сохраняем ссылку
        fav.push({id:partId, number:number, name:name, link: window.location.href}); 
        showToast(`${number} в избранном`); 
    }
    localStorage.setItem('fav', JSON.stringify(fav)); updateCounters();
}

// --- MODAL LOGIC ---
function openModal(type) {
    document.getElementById(type+'-modal').classList.add('active');
    if(type === 'fav') renderFav();
    if(type === 'cart') renderCart();
}
function closeModal(type) {
    document.getElementById(type+'-modal').classList.remove('active');
}

function renderFav() {
    const list = document.getElementById('fav-list');
    const items = JSON.parse(localStorage.getItem('fav')) || [];
    list.innerHTML = '';
    if(items.length === 0) { list.innerHTML = '<div class="empty-msg">Список избранного пуст</div>'; return; }
    
    items.forEach(item => {
        // Если ссылка есть, используем её, иначе просто заглушку
        const link = item.link ? item.link : '#';
        list.innerHTML += `
            <div class="modal-item">
                <div class="mi-info">
                    <span class="mi-name">${item.name}</span>
                    <span class="mi-art">${item.number}</span>
                </div>
                <div class="mi-actions">
                    <a href="${link}" class="btn-goto">Перейти</a>
                    <button class="btn-remove" onclick="removeFavItem('${item.id}')">✕</button>
                </div>
            </div>`;
    });
}

function removeFavItem(id) {
    let fav = JSON.parse(localStorage.getItem('fav'))||[];
    fav = fav.filter(i => i.id !== id);
    localStorage.setItem('fav', JSON.stringify(fav));
    renderFav(); updateCounters();
}

function renderCart() {
    const list = document.getElementById('cart-list');
    const items = JSON.parse(localStorage.getItem('cart')) || [];
    list.innerHTML = '';
    if(items.length === 0) { list.innerHTML = '<div class="empty-msg">Корзина пуста</div>'; return; }

    items.forEach(item => {
        list.innerHTML += `
            <div class="modal-item">
                <div class="mi-info">
                    <span class="mi-name">${item.name}</span>
                    <span class="mi-art">${item.number}</span>
                </div>
                <div class="mi-actions">
                    <div class="qty-selector">
                        <button class="qty-btn" onclick="changeQty('${item.id}', -1)">-</button>
                        <span class="qty-val">${item.qty}</span>
                        <button class="qty-btn" onclick="changeQty('${item.id}', 1)">+</button>
                    </div>
                    <button class="btn-remove" onclick="removeCartItem('${item.id}')">✕</button>
                </div>
            </div>`;
    });
}

function changeQty(id, delta) {
    let cart = JSON.parse(localStorage.getItem('cart'))||[];
    let item = cart.find(i=>i.id === id);
    if(item) {
        item.qty += delta;
        if(item.qty < 1) item.qty = 1;
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart(); updateCounters();
    }
}

function removeCartItem(id) {
    let cart = JSON.parse(localStorage.getItem('cart'))||[];
    cart = cart.filter(i => i.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart(); updateCounters();
}

document.addEventListener('DOMContentLoaded', updateCounters);
</script>