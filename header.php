<?php
$cur = basename($_SERVER['PHP_SELF'], ".php"); 
$active = function($p) use ($cur) {
    if ($p === '/' && ($cur === 'index' || $cur === '')) return 'active';
    return ($cur === $p) ? 'active' : '';
};
?>

<header class="header">
    <div class="container header-main">
        <button class="menu-btn" id="menuBtn">
            <svg viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
        
        <a href="/" class="logo-text"><h1>РАССВЕТ-С</h1></a>
        
        <nav class="header-nav" id="headerNav">
            <a href="/" class="nav-link <?php echo $active('/'); ?>">Главная</a>
            <a href="catalog.php" class="nav-link <?php echo $active('catalog'); ?>">Каталог Komatsu</a>
            <a href="about.php" class="nav-link <?php echo $active('about'); ?>">О компании</a>
            <a href="delivery.php" class="nav-link <?php echo $active('delivery'); ?>">Доставка и оплата</a>
            <a href="contacts.php" class="nav-link <?php echo $active('contacts'); ?>">Контакты</a>
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
</header>