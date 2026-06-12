<?php
/**
 * Setup script for shopsmoking.ru - Russian content
 * Run via: wp eval-file /tmp/setup_shopsmoking.php --allow-root
 */

// Fix category names to proper Russian
$cats = [
    'kostyumy'      => 'Костюмы',
    'smoking-fraki' => 'Смокинги и фраки',
    'pidzhaki'      => 'Пиджаки',
    'sorochki'      => 'Сорочки',
    'accessories'   => 'Аксессуары',
];
foreach ($cats as $slug => $name) {
    $term = get_term_by('slug', $slug, 'product_cat');
    if ($term) {
        wp_update_term($term->term_id, 'product_cat', ['name' => $name]);
        echo "Обновлена категория: $name\n";
    } else {
        $r = wp_insert_term($name, 'product_cat', ['slug' => $slug]);
        echo "Создана категория: $name\n";
    }
}

// Get already-imported image URLs (IDs set from first run)
$hero_id = 17;
$cat1_id = 18;
$cat2_id = 19;
$cat3_id = 20;

$hero_url = wp_get_attachment_image_url($hero_id, 'full') ?: 'https://shopsmoking.ru/wp-content/uploads/2026/02/dsc00027-2-1366x2048.jpg';
$cat1_url = wp_get_attachment_image_url($cat1_id, 'full') ?: 'https://shopsmoking.ru/wp-content/uploads/2026/03/kingsence-category-1.jpg';
$cat2_url = wp_get_attachment_image_url($cat2_id, 'full') ?: 'https://shopsmoking.ru/wp-content/uploads/2026/03/kingsence-category-2.jpg';
$cat3_url = wp_get_attachment_image_url($cat3_id, 'full') ?: 'https://shopsmoking.ru/wp-content/uploads/2026/03/kingsence-category-3.jpg';

echo "Hero URL: $hero_url\n";

// Build homepage content with Russian text
$content = '<!-- wp:cover {"url":"' . $hero_url . '","id":' . $hero_id . ',"dimRatio":45,"minHeight":700,"align":"full"} -->' . "\n" .
'<div class="wp-block-cover alignfull" style="min-height:700px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim has-background-dim-45"></span><img class="wp-block-cover__image-background" alt="Магазин Смокинг" src="' . $hero_url . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2rem,5vw,4rem)","fontWeight":"700","letterSpacing":"0.12em"},"color":{"text":"#ffffff"}}} -->' . "\n" .
'<h1 class="has-text-align-center has-text-color" style="color:#ffffff;font-size:clamp(2rem,5vw,4rem);font-weight:700;letter-spacing:0.12em">МАГАЗИН СМОКИНГ</h1>' . "\n" .
'<!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#e0d5c5"},"typography":{"fontSize":"1.1rem","letterSpacing":"0.08em"}}} -->' . "\n" .
'<p class="has-text-align-center has-text-color" style="color:#e0d5c5;font-size:1.1rem;letter-spacing:0.08em">Мужские костюмы и смокинги с правильной посадкой — Оренбург</p>' . "\n" .
'<!-- /wp:paragraph -->' . "\n" .
'<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->' . "\n" .
'<div class="wp-block-buttons" style="margin-top:2rem"><!-- wp:button {"style":{"color":{"background":"#c9a96e","text":"#1a1a1a"},"border":{"radius":"0"},"typography":{"fontSize":"0.85rem","letterSpacing":"0.2em","fontWeight":"600"}}} -->' . "\n" .
'<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background" style="border-radius:0;background-color:#c9a96e;color:#1a1a1a;font-size:0.85rem;font-weight:600;letter-spacing:0.2em" href="/shop/">ПЕРЕЙТИ В КАТАЛОГ</a></div>' . "\n" .
'<!-- /wp:button --></div>' . "\n" .
'<!-- /wp:buttons -->' . "\n" .
'</div></div>' . "\n" .
'<!-- /wp:cover -->' . "\n" .
'<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}}} -->' . "\n" .
'<div class="wp-block-group" style="padding-top:4rem;padding-bottom:4rem">' . "\n" .
'<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"0.7rem","letterSpacing":"0.4em"},"color":{"text":"#c9a96e"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->' . "\n" .
'<h2 class="has-text-align-center has-text-color" style="color:#c9a96e;font-size:0.7rem;letter-spacing:0.4em;margin-bottom:0.5rem">АССОРТИМЕНТ</h2>' . "\n" .
'<!-- /wp:heading -->' . "\n" .
'<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.2rem","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"3rem"}}}} -->' . "\n" .
'<h2 class="has-text-align-center" style="font-size:2.2rem;letter-spacing:0.1em;margin-bottom:3rem">Наши коллекции</h2>' . "\n" .
'<!-- /wp:heading -->' . "\n" .
'<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"1.5rem"}}}} -->' . "\n" .
'<div class="wp-block-columns alignwide">' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:cover {"url":"' . $cat1_url . '","id":' . $cat1_id . ',"dimRatio":25,"minHeight":520} -->' . "\n" .
'<div class="wp-block-cover" style="min-height:520px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim has-background-dim-25"></span><img class="wp-block-cover__image-background" alt="Костюмы" src="' . $cat1_url . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"1.3rem","letterSpacing":"0.15em","fontWeight":"600"}}} -->' . "\n" .
'<h3 class="has-text-align-center has-text-color" style="color:#ffffff;font-size:1.3rem;letter-spacing:0.15em;font-weight:600">КОСТЮМЫ</h3>' . "\n" .
'<!-- /wp:heading -->' . "\n" .
'<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons">' . "\n" .
'<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff","background":"transparent"},"border":{"radius":"0"},"typography":{"fontSize":"0.75rem","letterSpacing":"0.15em"}}} -->' . "\n" .
'<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/product-category/kostyumy/" style="color:#ffffff;font-size:0.75rem;letter-spacing:0.15em">Смотреть</a></div>' . "\n" .
'<!-- /wp:button --></div><!-- /wp:buttons -->' . "\n" .
'</div></div><!-- /wp:cover --></div><!-- /wp:column -->' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:cover {"url":"' . $cat2_url . '","id":' . $cat2_id . ',"dimRatio":25,"minHeight":520} -->' . "\n" .
'<div class="wp-block-cover" style="min-height:520px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim has-background-dim-25"></span><img class="wp-block-cover__image-background" alt="Смокинги" src="' . $cat2_url . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"1.3rem","letterSpacing":"0.15em","fontWeight":"600"}}} -->' . "\n" .
'<h3 class="has-text-align-center has-text-color" style="color:#ffffff;font-size:1.3rem;letter-spacing:0.15em;font-weight:600">СМОКИНГИ</h3>' . "\n" .
'<!-- /wp:heading -->' . "\n" .
'<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons">' . "\n" .
'<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff","background":"transparent"},"border":{"radius":"0"},"typography":{"fontSize":"0.75rem","letterSpacing":"0.15em"}}} -->' . "\n" .
'<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/product-category/smoking-fraki/" style="color:#ffffff;font-size:0.75rem;letter-spacing:0.15em">Смотреть</a></div>' . "\n" .
'<!-- /wp:button --></div><!-- /wp:buttons -->' . "\n" .
'</div></div><!-- /wp:cover --></div><!-- /wp:column -->' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:cover {"url":"' . $cat3_url . '","id":' . $cat3_id . ',"dimRatio":25,"minHeight":520} -->' . "\n" .
'<div class="wp-block-cover" style="min-height:520px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim has-background-dim-25"></span><img class="wp-block-cover__image-background" alt="Пиджаки" src="' . $cat3_url . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"1.3rem","letterSpacing":"0.15em","fontWeight":"600"}}} -->' . "\n" .
'<h3 class="has-text-align-center has-text-color" style="color:#ffffff;font-size:1.3rem;letter-spacing:0.15em;font-weight:600">ПИДЖАКИ</h3>' . "\n" .
'<!-- /wp:heading -->' . "\n" .
'<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons">' . "\n" .
'<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff","background":"transparent"},"border":{"radius":"0"},"typography":{"fontSize":"0.75rem","letterSpacing":"0.15em"}}} -->' . "\n" .
'<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/product-category/pidzhaki/" style="color:#ffffff;font-size:0.75rem;letter-spacing:0.15em">Смотреть</a></div>' . "\n" .
'<!-- /wp:button --></div><!-- /wp:buttons -->' . "\n" .
'</div></div><!-- /wp:cover --></div><!-- /wp:column -->' . "\n" .
'</div><!-- /wp:columns -->' . "\n" .
'</div><!-- /wp:group -->' . "\n" .
'<!-- wp:group {"align":"full","style":{"color":{"background":"#111111"},"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}}} -->' . "\n" .
'<div class="wp-block-group alignfull has-background" style="background-color:#111111;padding-top:4rem;padding-bottom:4rem">' . "\n" .
'<!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#c9a96e"},"typography":{"fontSize":"0.7rem","letterSpacing":"0.4em"}}} --><h2 class="has-text-align-center has-text-color" style="color:#c9a96e;font-size:0.7rem;letter-spacing:0.4em">НАШИ ПРЕИМУЩЕСТВА</h2><!-- /wp:heading -->' . "\n" .
'<!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"2rem"}}}} --><div class="wp-block-columns alignwide" style="padding-top:2rem">' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#c9a96e"},"typography":{"fontSize":"2rem"}}} --><h3 class="has-text-align-center has-text-color" style="color:#c9a96e;font-size:2rem">✦</h3><!-- /wp:heading -->' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":4,"style":{"color":{"text":"#ffffff"},"typography":{"letterSpacing":"0.12em","fontSize":"0.85rem"}}} --><h4 class="has-text-align-center has-text-color" style="color:#ffffff;letter-spacing:0.12em;font-size:0.85rem">КАЧЕСТВО ТКАНИ</h4><!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#888888"},"typography":{"fontSize":"0.9rem"}}} --><p class="has-text-align-center has-text-color" style="color:#888888;font-size:0.9rem">Только лучшие ткани от проверенных производителей</p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:column -->' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#c9a96e"},"typography":{"fontSize":"2rem"}}} --><h3 class="has-text-align-center has-text-color" style="color:#c9a96e;font-size:2rem">✦</h3><!-- /wp:heading -->' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":4,"style":{"color":{"text":"#ffffff"},"typography":{"letterSpacing":"0.12em","fontSize":"0.85rem"}}} --><h4 class="has-text-align-center has-text-color" style="color:#ffffff;letter-spacing:0.12em;font-size:0.85rem">ПРАВИЛЬНАЯ ПОСАДКА</h4><!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#888888"},"typography":{"fontSize":"0.9rem"}}} --><p class="has-text-align-center has-text-color" style="color:#888888;font-size:0.9rem">Костюмы, которые сидят безупречно</p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:column -->' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#c9a96e"},"typography":{"fontSize":"2rem"}}} --><h3 class="has-text-align-center has-text-color" style="color:#c9a96e;font-size:2rem">✦</h3><!-- /wp:heading -->' . "\n" .
'<!-- wp:heading {"textAlign":"center","level":4,"style":{"color":{"text":"#ffffff"},"typography":{"letterSpacing":"0.12em","fontSize":"0.85rem"}}} --><h4 class="has-text-align-center has-text-color" style="color:#ffffff;letter-spacing:0.12em;font-size:0.85rem">ИНДИВИДУАЛЬНЫЙ ПОДХОД</h4><!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#888888"},"typography":{"fontSize":"0.9rem"}}} --><p class="has-text-align-center has-text-color" style="color:#888888;font-size:0.9rem">Помогаем выбрать идеальный образ</p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:column -->' . "\n" .
'</div><!-- /wp:columns -->' . "\n" .
'</div><!-- /wp:group -->' . "\n" .
'<!-- wp:group {"align":"full","style":{"color":{"background":"#0d0d0d"},"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}}} -->' . "\n" .
'<div class="wp-block-group alignfull has-background" style="background-color:#0d0d0d;padding-top:3rem;padding-bottom:3rem">' . "\n" .
'<!-- wp:columns {"align":"wide"} --><div class="wp-block-columns alignwide">' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:heading {"level":4,"style":{"color":{"text":"#c9a96e"},"typography":{"letterSpacing":"0.2em","fontSize":"0.8rem"}}} --><h4 class="has-text-color" style="color:#c9a96e;letter-spacing:0.2em;font-size:0.8rem">МАГАЗИН СМОКИНГ</h4><!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"style":{"color":{"text":"#666666"},"typography":{"fontSize":"0.85rem"}}} --><p class="has-text-color" style="color:#666666;font-size:0.85rem">Мужские костюмы и смокинги с правильной посадкой в Оренбурге.</p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:column -->' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:heading {"level":4,"style":{"color":{"text":"#c9a96e"},"typography":{"letterSpacing":"0.2em","fontSize":"0.8rem"}}} --><h4 class="has-text-color" style="color:#c9a96e;letter-spacing:0.2em;font-size:0.8rem">КАТАЛОГ</h4><!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"style":{"color":{"text":"#666666"},"typography":{"fontSize":"0.85rem"}}} --><p class="has-text-color" style="color:#666666;font-size:0.85rem"><a href="/product-category/kostyumy/" style="color:#888888">Костюмы</a> — <a href="/product-category/smoking-fraki/" style="color:#888888">Смокинги</a> — <a href="/product-category/pidzhaki/" style="color:#888888">Пиджаки</a></p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:column -->' . "\n" .
'<!-- wp:column --><div class="wp-block-column">' . "\n" .
'<!-- wp:heading {"level":4,"style":{"color":{"text":"#c9a96e"},"typography":{"letterSpacing":"0.2em","fontSize":"0.8rem"}}} --><h4 class="has-text-color" style="color:#c9a96e;letter-spacing:0.2em;font-size:0.8rem">КОНТАКТЫ</h4><!-- /wp:heading -->' . "\n" .
'<!-- wp:paragraph {"style":{"color":{"text":"#666666"},"typography":{"fontSize":"0.85rem"}}} --><p class="has-text-color" style="color:#666666;font-size:0.85rem">г. Оренбург<br/>Тел: +7 (XXX) XXX-XX-XX<br/>Пн–Вс: 10:00–19:00</p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:column -->' . "\n" .
'</div><!-- /wp:columns -->' . "\n" .
'<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#444444"},"typography":{"fontSize":"0.75rem"}}} --><p class="has-text-align-center has-text-color" style="color:#444444;font-size:0.75rem">© 2026 Магазин Смокинг. Все права защищены.</p><!-- /wp:paragraph -->' . "\n" .
'</div><!-- /wp:group -->';

$updated = wp_update_post([
    'ID'           => 11,
    'post_content' => $content,
    'post_status'  => 'publish',
]);
echo $updated ? "Главная страница обновлена (ID: $updated)\n" : "ОШИБКА: не удалось обновить главную\n";

update_post_meta(11, 'site-sidebar-layout', 'no-sidebar');
update_post_meta(11, 'site-content-layout', 'full-width');

$astra_settings = get_option('astra-settings', []);
$astra_settings['primary-color']   = '#c9a96e';
$astra_settings['link-color']      = '#c9a96e';
$astra_settings['btn-bg-color']    = '#c9a96e';
$astra_settings['btn-color']       = '#1a1a1a';
$astra_settings['header-bg-color'] = '#1a1a1a';
update_option('astra-settings', $astra_settings);
echo "Настройки Astra обновлены\n";

$css = '
.home .entry-header { display: none !important; }
.home .entry-content { margin-top: 0 !important; padding-top: 0 !important; }
.home.page .site-content { padding-top: 0 !important; }
#masthead, .site-header, .main-header-bar { background-color: #1a1a1a !important; }
.ast-site-identity .site-title a, .site-title a { color: #c9a96e !important; letter-spacing: 0.15em; text-transform: uppercase; }
.main-header-menu .menu-item a { color: #cccccc !important; letter-spacing: 0.08em; font-size: 0.85rem; text-transform: uppercase; transition: color 0.3s; }
.main-header-menu .menu-item a:hover { color: #c9a96e !important; }
.wp-block-cover { overflow: hidden; }
.wp-block-cover__image-background { transition: transform 0.6s ease; }
.wp-block-cover:hover .wp-block-cover__image-background { transform: scale(1.04); }
.woocommerce ul.products li.product { transition: transform 0.3s; }
.woocommerce ul.products li.product:hover { transform: translateY(-5px); box-shadow: 0 8px 30px rgba(0,0,0,0.12); }
.woocommerce ul.products li.product .price { color: #c9a96e !important; font-weight: 600; }
.woocommerce a.button, .woocommerce button.button { background-color: #1a1a1a !important; color: #fff !important; letter-spacing: 0.1em; border-radius: 0 !important; }
.woocommerce a.button:hover, .woocommerce button.button:hover { background-color: #c9a96e !important; color: #1a1a1a !important; }
.site-footer { display: none; }
body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
';
wp_update_custom_css_post($css);
echo "CSS сохранён\n";

echo "\n=== ГОТОВО ===\nСайт: https://shopsmoking.ru\n";
