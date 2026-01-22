<?php
// Если переменная пути не задана, считаем, что мы в корне
if (!isset($path)) { $path = ''; }
?>
<header class="header">
    <div class="container">
        <div class="header-main">
            <button class="menu-btn" onclick="toggleMenu()">
                <svg viewBox="0 0 24 24"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
            </button>
            
            <a href="<?php echo $path; ?>index.php" class="logo-text">
                <h1>РАССВЕТ-С</h1>
            </a>

            <nav class="header-nav" id="headerNav">
                <a href="<?php echo $path; ?>index.php" class="nav-link">Главная</a>
                <a href="<?php echo $path; ?>catalog.php" class="nav-link">Каталог Komatsu</a>
                <a href="<?php echo $path; ?>delivery.php" class="nav-link">Оплата и доставка</a>
                <a href="<?php echo $path; ?>contacts.php" class="nav-link">Контакты</a>
            </nav>

            <div class="header-contacts">
                <a href="https://wa.me/79000000000" class="header-icon-btn">
                    <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                </a>
                <div class="header-icon-btn cart-btn">
                    <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    <span class="icon-count">0</span>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    function toggleMenu() {
        document.getElementById('headerNav').classList.toggle('active');
    }
</script>