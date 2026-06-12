<?php
/**
 * Fix WoodMart options, create sample product, check blog
 */

// ── 1. WoodMart options ───────────────────────────────────────────────────────
$opts = get_option('woodmart_options', []);

// Remove demo logo images
unset($opts['logo'], $opts['logo_2x'], $opts['logo_mobile'], $opts['logo_mobile_2x'],
      $opts['logo_retina'], $opts['logo_mobile_retina']);

// Colors: gold everywhere
$opts['primary-color']        = '#c9a96e';
$opts['secondary-color']      = '#c9a96e';
$opts['primary-color-hover']  = '#b8975d';

// Header
$opts['header-main-bg-color']    = '#0e0e0e';
$opts['header-main-text-color']  = '#ffffff';
$opts['header-bottom-bg-color']  = '#0e0e0e';

// Disable top bar with social icons
$opts['top-bar']              = '0';
$opts['header-social-links']  = '0';
$opts['top-bar-social']       = '0';

// Footer copyright
$opts['footer-copyright'] = '&copy; ' . date('Y') . ' Магазин Смокинг, Оренбург. Все права защищены.';

update_option('woodmart_options', $opts);
echo "✓ WoodMart options updated (logo removed, green→gold, top bar disabled)\n";

// ── 2. Remove WP custom logo ──────────────────────────────────────────────────
remove_theme_mod('custom_logo');
// Also clear from woodmart-child theme mods
$child_mods = get_option('theme_mods_woodmart-child', []);
unset($child_mods['custom_logo']);
update_option('theme_mods_woodmart-child', $child_mods);
echo "✓ Custom logo removed\n";

// ── 3. Site title ─────────────────────────────────────────────────────────────
update_option('blogname', 'Магазин Смокинг');
update_option('blogdescription', 'Мужские костюмы и смокинги в Оренбурге — идеальная посадка, премиальные ткани');
echo "✓ Site title set: Магазин Смокинг\n";

// ── 4. Clear WoodMart CSS cache ───────────────────────────────────────────────
global $wpdb;
$deleted = $wpdb->query(
    "DELETE FROM {$wpdb->options}
     WHERE option_name LIKE '%woodmart_custom_css%'
        OR option_name LIKE '%_transient_woodmart%'
        OR option_name LIKE '%woodmart_css%'"
);
wp_cache_flush();
echo "✓ WoodMart CSS cache cleared ($deleted rows)\n";

// ── 5. Create sample product ──────────────────────────────────────────────────
// Check if product already exists
$existing = get_page_by_path('klassicheskij-muzhskoj-kostyum-dvojka-monako', OBJECT, 'product');
if (!$existing) {
    $product_id = wp_insert_post([
        'post_title'   => 'Классический мужской костюм-двойка «Монако»',
        'post_name'    => 'klassicheskij-muzhskoj-kostyum-dvojka-monako',
        'post_content' => '<p>Элегантный костюм из итальянской шерсти с идеальной посадкой. Пиджак приталенного кроя, брюки со стрелками. Доступен в тёмно-синем, чёрном и антрацитовом цвете.</p>
<p><strong>Состав:</strong> 95% шерсть, 5% эластан<br>
<strong>Производство:</strong> Италия<br>
<strong>Подгонка по фигуре:</strong> бесплатно при покупке</p>',
        'post_excerpt' => 'Итальянская шерсть, приталенный крой, идеальная посадка. Тёмно-синий, чёрный, антрацит.',
        'post_status'  => 'publish',
        'post_type'    => 'product',
    ]);

    if ($product_id && !is_wp_error($product_id)) {
        // WooCommerce meta
        update_post_meta($product_id, '_price',           '29990');
        update_post_meta($product_id, '_regular_price',   '34990');
        update_post_meta($product_id, '_sale_price',      '29990');
        update_post_meta($product_id, '_stock_status',    'instock');
        update_post_meta($product_id, '_manage_stock',    'no');
        update_post_meta($product_id, '_visibility',      'visible');
        update_post_meta($product_id, '_sku',             'MONACO-DB-001');
        update_post_meta($product_id, '_product_attributes', []);
        update_post_meta($product_id, '_virtual',         'no');
        update_post_meta($product_id, '_downloadable',    'no');
        update_post_meta($product_id, '_tax_status',      'taxable');
        update_post_meta($product_id, '_tax_class',       '');
        // Product type
        wp_set_object_terms($product_id, 'simple', 'product_type');
        // Assign first category
        $cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'number' => 1]);
        if ($cats && !is_wp_error($cats)) {
            wp_set_object_terms($product_id, [(int) $cats[0]->term_id], 'product_cat');
        }
        echo "✓ Product created (ID: $product_id): Костюм Монако, цена 29990 / 34990 руб.\n";
    } else {
        echo "✗ Product creation failed: " . (is_wp_error($product_id) ? $product_id->get_error_message() : 'unknown') . "\n";
    }
} else {
    echo "  Product already exists (ID: {$existing->ID})\n";
}

// ── 6. Check and fix blog ─────────────────────────────────────────────────────
$blog_page = get_page_by_path('blog');
if (!$blog_page) {
    // Create blog page
    $blog_id = wp_insert_post([
        'post_title'  => 'Блог о стиле',
        'post_name'   => 'blog',
        'post_content'=> '',
        'post_status' => 'publish',
        'post_type'   => 'page',
    ]);
    if (!is_wp_error($blog_id)) {
        update_option('page_for_posts', $blog_id);
        update_option('show_on_front', 'page');
        update_option('page_on_front', 11);
        echo "✓ Blog page created (ID: $blog_id) and set as posts page\n";
    }
} else {
    // Make sure it's set as posts page
    if (get_option('page_for_posts') != $blog_page->ID) {
        update_option('page_for_posts', $blog_page->ID);
        echo "✓ Blog page found (ID: {$blog_page->ID}), set as posts page\n";
    } else {
        echo "  Blog page OK (ID: {$blog_page->ID})\n";
    }
}

// ── 7. Flush rewrite rules ────────────────────────────────────────────────────
flush_rewrite_rules(true);
echo "✓ Rewrite rules flushed\n";

// ── 8. Summary ────────────────────────────────────────────────────────────────
echo "\n=== Status ===\n";
echo "Site title:    " . get_option('blogname') . "\n";
echo "Custom logo:   " . (get_theme_mod('custom_logo') ? 'SET' : 'not set (text logo active)') . "\n";
echo "Blog page:     " . get_option('page_for_posts') . "\n";
echo "Front page:    " . get_option('page_on_front') . "\n";
echo "Primary color: " . (get_option('woodmart_options')['primary-color'] ?? 'n/a') . "\n";

$products = wc_get_products(['limit' => 5, 'status' => 'publish']);
echo "Products:      " . count($products) . " published\n";
foreach ($products as $p) {
    echo "  - [{$p->get_id()}] {$p->get_name()} | {$p->get_price()} руб.\n";
}
