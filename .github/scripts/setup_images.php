<?php
/**
 * Attach existing media library images to product
 * Uses images already uploaded to shopsmoking.ru
 */

// ── Find the product ──────────────────────────────────────────────────────────
$products = wc_get_products(['limit' => 5, 'status' => 'publish']);
if (empty($products)) {
    echo "✗ Нет товаров. Сначала запусти setup_fix.php\n";
    exit;
}
$product    = $products[0];
$product_id = $product->get_id();
echo "→ Товар ID:{$product_id} — {$product->get_name()}\n\n";

// ── Step 1: Find images already in the media library ─────────────────────────
$existing = get_posts([
    'post_type'      => 'attachment',
    'post_mime_type' => ['image/jpeg', 'image/png', 'image/webp'],
    'post_status'    => 'inherit',
    'posts_per_page' => 20,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

echo "Найдено в медиатеке: " . count($existing) . " изображений\n";
foreach ($existing as $att) {
    echo "  [{$att->ID}] " . wp_get_attachment_url($att->ID) . "\n";
}

// If we have images, attach them to the product
if (!empty($existing)) {
    $ids = array_column($existing, 'ID');

    // Featured image — first available
    set_post_thumbnail($product_id, $ids[0]);
    echo "\n✓ Главное фото: ID {$ids[0]}\n";

    // Gallery — remaining (up to 4 more)
    if (count($ids) > 1) {
        $gallery = array_slice($ids, 1, 4);
        update_post_meta($product_id, '_product_image_gallery', implode(',', $gallery));
        echo "✓ Галерея: " . implode(', ', $gallery) . "\n";
    }
    echo "\nГотово!\n";
    exit;
}

// ── Step 2: No images in library — download from kingsence.ru ────────────────
echo "\nВ медиатеке нет изображений. Пробую скачать с kingsence.ru...\n";

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

// Known kingsence.ru product image paths (VPS has direct access)
$urls_to_try = [
    'https://kingsence.ru/wp-content/uploads/',
];

// Fetch shop page from kingsence.ru to get real image URLs
$response = wp_remote_get('https://kingsence.ru/shop/', [
    'timeout'    => 20,
    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
]);

$image_urls = [];
if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
    $html = wp_remote_retrieve_body($response);
    preg_match_all(
        '~https://kingsence\.ru/wp-content/uploads/[^\s"\'<>]+\.(?:jpg|jpeg|webp|png)~i',
        $html, $matches
    );
    foreach (array_unique($matches[0]) as $url) {
        if (!preg_match('~-\d+x\d+\.~', $url)) {
            $image_urls[] = $url;
        }
    }
    echo "Найдено на kingsence.ru: " . count($image_urls) . " изображений\n";
} else {
    $err = is_wp_error($response) ? $response->get_error_message() : wp_remote_retrieve_response_code($response);
    echo "⚠ kingsence.ru недоступен: $err\n";
}

// Fallback — import from shopsmoking.ru own uploads (files already there)
if (empty($image_urls)) {
    echo "Использую файлы из /uploads/ на shopsmoking.ru...\n";
    $upload_dir = wp_upload_dir();
    $files = glob($upload_dir['basedir'] . '/**/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
    if (empty($files)) {
        $files = glob($upload_dir['basedir'] . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
    }
    foreach (array_slice($files, 0, 5) as $file) {
        if (!preg_match('~-\d+x\d+\.~', $file)) {
            $image_urls[] = $upload_dir['baseurl'] . str_replace($upload_dir['basedir'], '', $file);
        }
    }
    echo "Найдено локально: " . count($image_urls) . "\n";
}

// Import and attach
$imported = [];
foreach (array_slice($image_urls, 0, 5) as $url) {
    echo "Загружаю: $url\n";
    $tmp = download_url($url, 30);
    if (is_wp_error($tmp)) { echo "  ✗ " . $tmp->get_error_message() . "\n"; continue; }

    $filename = sanitize_file_name(basename(parse_url($url, PHP_URL_PATH)));
    if (!preg_match('/\.(jpg|jpeg|png|webp)$/i', $filename)) $filename .= '.jpg';

    $id = media_handle_sideload(['name' => $filename, 'tmp_name' => $tmp], $product_id);
    if (is_wp_error($id)) { echo "  ✗ " . $id->get_error_message() . "\n"; continue; }

    $imported[] = $id;
    echo "  ✓ ID:$id\n";
}

if (!empty($imported)) {
    set_post_thumbnail($product_id, $imported[0]);
    if (count($imported) > 1) {
        update_post_meta($product_id, '_product_image_gallery', implode(',', array_slice($imported, 1)));
    }
    echo "\n✓ Готово! Прикреплено " . count($imported) . " фото к товару ID:{$product_id}\n";
} else {
    echo "\n✗ Не удалось добавить изображения\n";
}
