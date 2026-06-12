<?php
/**
 * WoodMart full configuration for shopsmoking.ru
 * Sets colors, header, product cards, homepage, navigation
 * Run via: wp eval-file /tmp/setup_woodmart.php --allow-root
 */

$site_dir = '/var/www/fastuser/data/www/shopsmoking.ru';

// ── 1. WoodMart theme options ────────────────────────────────────────────────
$current_options = get_option('woodmart_options', []);

$woodmart_options = array_merge($current_options, [
    // Colors
    'primary-color'                     => '#c9a96e',
    'secondary-color'                   => '#c9a96e',
    'primary-color-hover'               => '#b8975d',

    // Header
    'header-layout'                     => '1',
    'header-main-bg-color'              => '#1a1a1a',
    'header-main-text-color'            => '#ffffff',
    'header-bottom-bg-color'            => '#1a1a1a',
    'header-bottom-text-color'          => '#ffffff',
    'header-top-bg-color'               => '#111111',
    'header-top-text-color'             => '#c9a96e',
    'header-sticky'                     => '1',
    'header-sticky-bg-color'            => '#1a1a1a',

    // Logo text fallback (shown if no image logo set)
    'logo-color'                        => '#ffffff',

    // Navigation
    'menu-main-color'                   => '#ffffff',
    'menu-main-hover-color'             => '#c9a96e',
    'menu-dropdown-bg-color'            => '#1a1a1a',
    'menu-dropdown-color'               => '#ffffff',
    'menu-dropdown-hover-color'         => '#c9a96e',

    // Buttons
    'buttons-color'                     => '#c9a96e',
    'buttons-hover-color'               => '#b8975d',
    'buttons-text-color'                => '#ffffff',

    // Links
    'link-color'                        => '#c9a96e',
    'link-hover-color'                  => '#b8975d',

    // Body / Page
    'page-bg-color'                     => '#ffffff',
    'body-font-color'                   => '#333333',
    'content-bg-color'                  => '#ffffff',

    // Footer
    'footer-bg-color'                   => '#111111',
    'footer-color'                      => '#999999',
    'footer-link-color'                 => '#c9a96e',
    'footer-link-hover-color'           => '#ffffff',
    'footer-bottom-bg-color'            => '#0a0a0a',
    'footer-bottom-color'               => '#666666',

    // Sidebar
    'sidebar-bg-color'                  => '#f8f7f4',
    'sidebar-width'                     => '280',

    // Shop / Product cards
    'products-per-row'                  => '4',
    'products-per-row-tablet'           => '2',
    'products-per-row-mobile'           => '1',
    'products-per-page'                 => '12',
    'product-hover'                     => 'base',
    'product-image-size'                => 'medium',
    'show-product-categories'           => '1',
    'show-product-short-description'    => '0',
    'show-product-brands'               => '0',
    'show-wishlist-btn'                 => '0',
    'show-compare-btn'                  => '0',
    'product-rating'                    => '1',
    'product-add-to-cart'               => '1',

    // Single product
    'product-images-layout'             => 'column',
    'product-sticky-info'               => '1',
    'related-products-number'           => '4',

    // Typography — main font
    'main-font'                         => [
        'font-family' => 'Montserrat',
        'font-weight' => '400',
    ],
    'heading-font'                      => [
        'font-family' => 'Montserrat',
        'font-weight' => '700',
    ],

    // Breadcrumbs
    'breadcrumbs-bg-color'              => '#f4f3f0',
    'breadcrumbs-color'                 => '#666666',
    'breadcrumbs-active-color'          => '#1a1a1a',

    // Cart & Checkout
    'ajax-add-to-cart'                  => '1',
    'cart-widget-behavior'              => 'widget',

    // Misc
    'preloader'                         => '0',
    'back-to-top'                       => '1',
    'custom-css'                        => '
/* WoodMart custom overrides */
:root {
    --wd-primary-color: #c9a96e;
    --wd-secondary-color: #c9a96e;
}
.wd-header { background-color: #1a1a1a !important; }
.navigation-style-default .menu > li > a { color: #ffffff; }
.navigation-style-default .menu > li > a:hover,
.navigation-style-default .menu > li.current-menu-item > a { color: #c9a96e; }
.btn, .button, .woocommerce-Button, input[type="submit"],
.single_add_to_cart_button { background-color: #c9a96e !important; color: #fff !important; border-color: #c9a96e !important; }
.btn:hover, .button:hover { background-color: #b8975d !important; }
.price, .woocommerce-Price-amount { color: #c9a96e !important; }
ins .woocommerce-Price-amount { color: #c9a96e !important; }
a { color: #c9a96e; }
a:hover { color: #b8975d; }
.wd-footer { background-color: #111111 !important; }
h1, h2, h3, h4, h5, h6 { color: #1a1a1a; font-weight: 700; }
',
]);

update_option('woodmart_options', $woodmart_options);
echo "✓ WoodMart options configured (colors, header, product cards, footer)\n";

// ── 2. Set theme mods (some settings are stored here) ────────────────────────
set_theme_mod('header_design', 'design-1');
echo "✓ Theme mods updated\n";

// ── 3. Navigation menu ───────────────────────────────────────────────────────
$menu_name = 'Главное меню';
$menu_obj  = wp_get_nav_menu_object($menu_name);

if ($menu_obj) {
    // Remove old items
    $items = wp_get_nav_menu_items($menu_obj->term_id);
    if ($items) {
        foreach ($items as $item) {
            wp_delete_post($item->ID, true);
        }
    }
    $menu_id = $menu_obj->term_id;
} else {
    $menu_id = wp_create_nav_menu($menu_name);
}

$menu_links = [
    'Главная'    => home_url('/'),
    'Каталог'    => home_url('/shop/'),
    'Блог'       => home_url('/blog/'),
    'О нас'      => home_url('/o-nas/'),
    'Контакты'   => home_url('/kontakty/'),
];

foreach ($menu_links as $title => $url) {
    wp_update_nav_menu_item($menu_id, 0, [
        'menu-item-title'  => $title,
        'menu-item-url'    => $url,
        'menu-item-status' => 'publish',
        'menu-item-type'   => 'custom',
    ]);
}

// Assign to all known WoodMart menu locations
$locations = get_theme_mod('nav_menu_locations', []);
foreach (['main-menu', 'primary', 'top-menu', 'wd-header-menu'] as $loc) {
    $locations[$loc] = $menu_id;
}
set_theme_mod('nav_menu_locations', $locations);
echo "✓ Navigation menu '{$menu_name}' created and assigned\n";

// ── 4. Create "О нас" and "Контакты" pages if missing ────────────────────────
$static_pages = [
    [
        'title'   => 'О нас',
        'slug'    => 'o-nas',
        'content' => '<!-- wp:html --><div style="max-width:800px;margin:60px auto;padding:0 20px;">
<h1 style="font-size:36px;color:#1a1a1a;margin-bottom:20px;">О магазине «Смокинг»</h1>
<p style="font-size:16px;line-height:1.8;color:#555;">Магазин «Смокинг» в Оренбурге — ваш надёжный партнёр в создании безупречного образа. Мы специализируемся на мужских костюмах, смокингах и фраках для самых важных событий в жизни.</p>
<p style="font-size:16px;line-height:1.8;color:#555;margin-top:16px;">В нашем ассортименте — более 500 моделей от ведущих европейских производителей. Каждый костюм проходит тщательный контроль качества. Мы предлагаем бесплатную подгонку по фигуре при покупке.</p>
<div style="background:#1a1a1a;color:#fff;padding:40px;margin-top:40px;text-align:center;">
<p style="color:#c9a96e;font-size:12px;letter-spacing:4px;text-transform:uppercase;">Запишитесь на примерку</p>
<p style="font-size:28px;font-weight:700;margin:12px 0;">+7 (3532) 00-00-00</p>
<p style="color:#999;">Оренбург, ул. Ленинская, 1</p>
</div>
</div><!-- /wp:html -->',
    ],
    [
        'title'   => 'Контакты',
        'slug'    => 'kontakty',
        'content' => '<!-- wp:html --><div style="max-width:800px;margin:60px auto;padding:0 20px;">
<h1 style="font-size:36px;color:#1a1a1a;margin-bottom:30px;">Контакты</h1>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;">
<div>
<h3 style="color:#c9a96e;font-size:14px;letter-spacing:3px;text-transform:uppercase;margin-bottom:16px;">Адрес</h3>
<p style="font-size:16px;color:#333;line-height:1.6;">Оренбург, ул. Ленинская, 1<br>ТЦ «Центральный», 2 этаж</p>
<h3 style="color:#c9a96e;font-size:14px;letter-spacing:3px;text-transform:uppercase;margin:24px 0 16px;">Телефон</h3>
<p style="font-size:20px;font-weight:700;color:#1a1a1a;">+7 (3532) 00-00-00</p>
<h3 style="color:#c9a96e;font-size:14px;letter-spacing:3px;text-transform:uppercase;margin:24px 0 16px;">Режим работы</h3>
<p style="color:#333;line-height:1.8;">Пн–Сб: 10:00 – 20:00<br>Вс: 11:00 – 18:00</p>
</div>
<div>
<h3 style="color:#c9a96e;font-size:14px;letter-spacing:3px;text-transform:uppercase;margin-bottom:16px;">Email</h3>
<p style="font-size:16px;"><a href="mailto:info@shopsmoking.ru" style="color:#c9a96e;">info@shopsmoking.ru</a></p>
<h3 style="color:#c9a96e;font-size:14px;letter-spacing:3px;text-transform:uppercase;margin:24px 0 16px;">Соцсети</h3>
<p><a href="#" style="color:#c9a96e;font-size:15px;">ВКонтакте</a></p>
<p style="margin-top:8px;"><a href="#" style="color:#c9a96e;font-size:15px;">Telegram</a></p>
</div>
</div>
</div><!-- /wp:html -->',
    ],
];

foreach ($static_pages as $p) {
    $existing = get_page_by_path($p['slug']);
    if (!$existing) {
        $id = wp_insert_post([
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
        echo "✓ Page '{$p['title']}' created (ID: {$id})\n";
    } else {
        wp_update_post([
            'ID'           => $existing->ID,
            'post_content' => $p['content'],
            'post_status'  => 'publish',
        ]);
        echo "✓ Page '{$p['title']}' updated (ID: {$existing->ID})\n";
    }
}

// ── 5. Rebuild homepage ──────────────────────────────────────────────────────
$homepage_id = (int) get_option('page_on_front');
if (!$homepage_id) {
    $homepage_id = 11;
}

// Build category cards HTML
$cats = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'exclude'    => [(int) get_option('default_product_cat')],
    'number'     => 6,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

$cat_cards = '';
foreach ($cats as $cat) {
    $thumb_id  = get_term_meta($cat->term_id, 'thumbnail_id', true);
    $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'medium') : '';
    $bg_style  = $thumb_url
        ? "background:url('{$thumb_url}') center/cover no-repeat;"
        : 'background:#1a1a1a;';
    $count_label = $cat->count > 0 ? $cat->count . '&nbsp;товаров' : 'Смотреть';
    $cat_url   = get_term_link($cat);

    $cat_cards .= <<<HTML
<a href="{$cat_url}" style="display:flex;flex-direction:column;justify-content:flex-end;text-decoration:none;
   min-height:240px;padding:24px;position:relative;overflow:hidden;{$bg_style}">
  <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(26,26,26,.85) 0%,rgba(26,26,26,.1) 100%);"></div>
  <div style="position:relative;z-index:2;">
    <h3 style="color:#fff;font-size:16px;font-weight:700;margin:0 0 4px;">{$cat->name}</h3>
    <span style="color:#c9a96e;font-size:13px;">{$count_label}</span>
  </div>
</a>
HTML;
}

$homepage_content = <<<CONTENT
<!-- wp:html -->
<style>
.smk-hero{background:linear-gradient(135deg,#1a1a1a 0%,#2d1f0a 100%);padding:120px 20px;text-align:center;position:relative;overflow:hidden}
.smk-hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a96e' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;}
.smk-hero-inner{max-width:760px;margin:0 auto;position:relative;z-index:2}
.smk-eyebrow{color:#c9a96e;font-size:12px;letter-spacing:5px;text-transform:uppercase;margin-bottom:20px;display:block}
.smk-h1{color:#fff;font-size:clamp(32px,5vw,54px);font-weight:700;line-height:1.15;margin:0 0 24px}
.smk-h1 span{color:#c9a96e}
.smk-lead{color:#bbb;font-size:17px;line-height:1.75;margin:0 auto 40px;max-width:560px}
.smk-btn{display:inline-block;background:#c9a96e;color:#fff;padding:15px 44px;font-size:13px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:background .25s}
.smk-btn:hover{background:#b8975d;color:#fff}
.smk-btn-outline{display:inline-block;border:2px solid #c9a96e;color:#c9a96e;padding:13px 44px;font-size:13px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;margin-left:12px;transition:all .25s}
.smk-btn-outline:hover{background:#c9a96e;color:#fff}
.smk-cats-section{padding:80px 20px;background:#f8f7f4}
.smk-section-label{color:#c9a96e;font-size:11px;letter-spacing:5px;text-transform:uppercase;display:block;margin-bottom:10px}
.smk-section-title{color:#1a1a1a;font-size:clamp(24px,3vw,36px);font-weight:700;margin:0 0 48px}
.smk-cats-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;max-width:1200px;margin:0 auto}
.smk-products-section{padding:80px 20px;background:#fff}
.smk-usp-section{padding:80px 20px;background:#1a1a1a;text-align:center}
.smk-usp-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:40px;max-width:900px;margin:0 auto;text-align:left}
.smk-usp-icon{color:#c9a96e;font-size:32px;margin-bottom:14px;display:block}
.smk-usp-h{color:#fff;font-size:15px;font-weight:700;margin:0 0 8px}
.smk-usp-p{color:#888;font-size:14px;line-height:1.65;margin:0}
</style>

<div class="smk-hero">
  <div class="smk-hero-inner">
    <span class="smk-eyebrow">Магазин смокингов в Оренбурге</span>
    <h1 class="smk-h1">Мужские костюмы<br>и <span>смокинги</span><br>на любой повод</h1>
    <p class="smk-lead">Идеальная посадка, премиальные ткани из Италии и Великобритании. Более 500 моделей в наличии. Бесплатная подгонка по фигуре.</p>
    <a class="smk-btn" href="/shop/">Смотреть каталог</a>
    <a class="smk-btn-outline" href="/kontakty/">Записаться на примерку</a>
  </div>
</div>
<!-- /wp:html -->

<!-- wp:html -->
<section class="smk-cats-section">
  <div style="max-width:1200px;margin:0 auto;text-align:center">
    <span class="smk-section-label">Наш ассортимент</span>
    <h2 class="smk-section-title">Категории товаров</h2>
  </div>
  <div class="smk-cats-grid">
    {$cat_cards}
  </div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="smk-products-section">
  <div style="max-width:1200px;margin:0 auto">
    <div style="text-align:center;margin-bottom:48px">
      <span class="smk-section-label">Свежие поступления</span>
      <h2 class="smk-section-title">Новинки</h2>
    </div>
<!-- /wp:html -->

[recent_products per_page="8" columns="4" orderby="date" order="DESC"]

<!-- wp:html -->
    <div style="text-align:center;margin-top:40px">
      <a class="smk-btn" href="/shop/">Весь каталог</a>
    </div>
  </div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="smk-usp-section">
  <div style="max-width:1200px;margin:0 auto">
    <div style="text-align:center;margin-bottom:56px">
      <span class="smk-section-label" style="color:#c9a96e">Почему выбирают нас</span>
      <h2 style="color:#fff;font-size:clamp(24px,3vw,36px);font-weight:700;margin:0">Наши преимущества</h2>
    </div>
    <div class="smk-usp-grid">
      <div>
        <span class="smk-usp-icon">✦</span>
        <h3 class="smk-usp-h">Идеальная посадка</h3>
        <p class="smk-usp-p">Бесплатная подгонка по фигуре при покупке любого костюма — наш портной сделает всё идеально</p>
      </div>
      <div>
        <span class="smk-usp-icon">✦</span>
        <h3 class="smk-usp-h">Премиальные ткани</h3>
        <p class="smk-usp-p">Шерсть, лён и смеси от ведущих фабрик Италии и Великобритании — только проверенные материалы</p>
      </div>
      <div>
        <span class="smk-usp-icon">✦</span>
        <h3 class="smk-usp-h">500+ моделей</h3>
        <p class="smk-usp-p">Огромный выбор — классика, свадебные, торжественные, деловые. Любой повод и бюджет</p>
      </div>
      <div>
        <span class="smk-usp-icon">✦</span>
        <h3 class="smk-usp-h">Быстрая доставка</h3>
        <p class="smk-usp-p">Доставим по Оренбургу за 1 день, по России — в течение 3–5 рабочих дней</p>
      </div>
    </div>
  </div>
</section>
<!-- /wp:html -->
CONTENT;

wp_update_post([
    'ID'           => $homepage_id,
    'post_content' => $homepage_content,
    'post_status'  => 'publish',
]);
echo "✓ Homepage rebuilt (ID: {$homepage_id})\n";

// ── 6. Footer widget text ────────────────────────────────────────────────────
$footer_text = '<p style="color:#999;font-size:14px;line-height:1.8;">
  <strong style="color:#fff;">Магазин Смокинг</strong><br>
  Мужские костюмы и смокинги в Оренбурге<br>
  <a href="tel:+73532000000" style="color:#c9a96e;">+7 (3532) 00-00-00</a><br>
  Оренбург, ул. Ленинская, 1
</p>';

update_option('widget_text', [
    2 => ['title' => 'О нас', 'text' => $footer_text, 'filter' => true],
    '_multiwidget' => 1,
]);

// ── 7. Flush rewrite rules ────────────────────────────────────────────────────
flush_rewrite_rules();
echo "✓ Rewrite rules flushed\n";

echo "\n✅ WoodMart fully configured for shopsmoking.ru\n";
echo "   Primary color: #c9a96e (gold)\n";
echo "   Header color:  #1a1a1a (dark)\n";
echo "   Check: https://shopsmoking.ru\n";
