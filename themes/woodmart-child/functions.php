<?php
defined('ABSPATH') || exit;

// ── Constants ────────────────────────────────────────────────────────────────
define('SMK_PHONE',      '+7 (3532) 99-88-77');
define('SMK_PHONE_HREF', 'tel:+73532998877');
define('SMK_ADDRESS',    'Оренбург, ул. Ленинская, 1');
define('SMK_HOURS',      'Пн–Сб 10:00–20:00, Вс 11:00–18:00');
define('SMK_EMAIL',      'info@shopsmoking.ru');
define('SMK_VER',        '1.0.' . (defined('WP_DEBUG') && WP_DEBUG ? time() : filemtime(__DIR__ . '/assets/css/main.css')));

// ── Enqueue ──────────────────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'smk-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'smk-main',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['woodmart-style'],
        SMK_VER
    );
    wp_enqueue_script(
        'smk-main-js',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        SMK_VER,
        true
    );
    wp_localize_script('smk-main-js', 'SMK', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('smk_nonce'),
        'phone'   => SMK_PHONE,
    ]);
}, 99);

// ── Image sizes ───────────────────────────────────────────────────────────────
add_action('after_setup_theme', function () {
    add_image_size('smk-hero',     1920, 900,  true);
    add_image_size('smk-category', 480,  720,  true);
    add_image_size('smk-product',  480,  640,  true);
    add_image_size('smk-blog',     720,  480,  true);
});

// ── Body classes ──────────────────────────────────────────────────────────────
add_filter('body_class', function ($cls) {
    $cls[] = 'smk-theme';
    if (is_front_page())   $cls[] = 'smk-homepage';
    if (is_product())      $cls[] = 'smk-product-single';
    if (is_shop())         $cls[] = 'smk-shop';
    return $cls;
});

// ── WooCommerce: 4 columns on shop ───────────────────────────────────────────
add_filter('loop_shop_columns', fn() => 4, 20);
add_filter('loop_shop_per_page', fn() => 16, 20);

// ── Remove WoodMart preloader ─────────────────────────────────────────────────
add_filter('woodmart_preloader_enabled', '__return_false');

// ── Disable breadcrumbs on front page ────────────────────────────────────────
add_action('template_redirect', function () {
    if (is_front_page()) {
        remove_action('woodmart_before_page_header', 'woodmart_breadcrumbs', 20);
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
});

// ── Footer copyright (WoodMart uses several filter names) ────────────────────
$smk_copy = fn() => '&copy; ' . date('Y') . ' Магазин Смокинг, Оренбург. Все права защищены.';
add_filter('woodmart_footer_copyright_text', $smk_copy);
add_filter('woodmart_copyright_text',        $smk_copy);
add_filter('woodmart_get_opt',               function ($val, $name) use ($smk_copy) {
    return $name === 'footer-copyright' ? $smk_copy() : $val;
}, 10, 2);

// ── Add phone to WoodMart header top bar ─────────────────────────────────────
add_action('woodmart_header_before_top_bar_right', function () {
    echo '<span class="smk-header-phone"><a href="' . SMK_PHONE_HREF . '">' . SMK_PHONE . '</a></span>';
});

// ── Override logo: always show text instead of image ─────────────────────────
add_filter('get_custom_logo', function () {
    $name = 'Магазин Смокинг';
    $url  = esc_url(home_url('/'));
    return '<a href="' . $url . '" class="custom-logo-link site-logo-text" rel="home"
              style="font-family:\'Cormorant Garamond\',serif;font-size:19px;letter-spacing:3.5px;text-transform:uppercase;color:#fff;font-weight:400;text-decoration:none;">'
           . esc_html($name) . '</a>';
}, 20);

// ── Inject CSS variable override early (before WoodMart generates its CSS) ───
add_action('wp_head', function () {
    echo '<style>:root{--wd-primary-color:#c9a96e!important;--wd-secondary-color:#c9a96e!important;}</style>';
}, 1);

// ── Helper: render a product card HTML ───────────────────────────────────────
function smk_product_card(WC_Product $product, string $size = 'woocommerce_single'): void {
    $id       = $product->get_id();
    $name     = $product->get_name();
    $url      = $product->get_permalink();
    $price    = $product->get_price_html();
    $on_sale  = $product->is_on_sale();
    $img_id   = $product->get_image_id();
    $img_url  = $img_id
        ? wp_get_attachment_image_url($img_id, $size)
        : wc_placeholder_img_src($size);
    $gallery  = $product->get_gallery_image_ids();
    $img2_url = $gallery ? wp_get_attachment_image_url($gallery[0], $size) : '';
    ?>
    <div class="smk-product-card">
      <a class="smk-product-card__img-wrap" href="<?= esc_url($url) ?>">
        <img src="<?= esc_url($img_url) ?>" alt="<?= esc_attr($name) ?>"
             class="smk-product-card__img smk-product-card__img--primary" loading="lazy">
        <?php if ($img2_url): ?>
        <img src="<?= esc_url($img2_url) ?>" alt="<?= esc_attr($name) ?>"
             class="smk-product-card__img smk-product-card__img--hover" loading="lazy">
        <?php endif; ?>
        <?php if ($on_sale): ?>
          <span class="smk-product-card__badge smk-badge--sale">Скидка</span>
        <?php endif; ?>
        <div class="smk-product-card__hover-actions">
          <a class="smk-product-card__action" href="<?= esc_url($url) ?>" title="Перейти к товару">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/></svg>
          </a>
        </div>
      </a>
      <div class="smk-product-card__info">
        <h3 class="smk-product-card__name">
          <a href="<?= esc_url($url) ?>"><?= esc_html($name) ?></a>
        </h3>
        <div class="smk-product-card__price"><?= $price ?></div>
        <a class="smk-product-card__cta" href="<?= esc_url($url) ?>">Выбрать размер
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="1.5"/></svg>
        </a>
      </div>
    </div>
    <?php
}

// ── Helper: section heading ───────────────────────────────────────────────────
function smk_section_head(string $label, string $title, string $link = '', string $link_text = 'Смотреть всё', bool $flex = false): void {
    $cls = $flex ? 'smk-section-head smk-section-head--flex' : 'smk-section-head';
    ?>
    <div class="<?= $cls ?>">
      <div>
        <span class="smk-section-head__label"><?= esc_html($label) ?></span>
        <h2 class="smk-section-head__title"><?= esc_html($title) ?></h2>
      </div>
      <?php if ($link): ?>
      <a class="smk-link-arrow" href="<?= esc_url($link) ?>"><?= esc_html($link_text) ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="1.5"/></svg>
      </a>
      <?php endif; ?>
    </div>
    <?php
}
