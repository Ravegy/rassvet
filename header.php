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
            <div class="header-icon-btn" id="favBtn">
                <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                <span class="icon-count" id="favCount">0</span>
            </div>
            <div class="header-icon-btn" id="cartBtn">
                <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <span class="icon-count" id="cartCount">0</span>
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