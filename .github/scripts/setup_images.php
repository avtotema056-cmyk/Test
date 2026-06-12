<?php
/**
 * Import product images from kingsence.ru into WP media library
 * and attach them to the first product (Костюм Монако, ID detection auto)
 */

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

// ── Find existing products ────────────────────────────────────────────────────
$products = wc_get_products(['limit' => 5, 'status' => 'publish']);
if (empty($products)) {
    echo "✗ No products found. Run setup_fix.php first.\n";
    exit;
}
$product    = $products[0];
$product_id = $product->get_id();
echo "→ Attaching images to product ID:{$product_id} — {$product->get_name()}\n\n";

// ── Try to fetch image list from kingsence.ru ─────────────────────────────────
$shop_html = wp_remote_retrieve_body(
    wp_remote_get('https://kingsence.ru/shop/', [
        'timeout'    => 15,
        'user-agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1)',
    ])
);

$image_urls = [];

if ($shop_html) {
    // Extract full-size WooCommerce product image URLs
    preg_match_all(
        '~https://kingsence\.ru/wp-content/uploads/[^\s"\'<>]+\.(?:jpg|jpeg|webp|png)~i',
        $shop_html,
        $matches
    );
    // Remove thumbnail duplicates (-150x150, -300x300 etc.)
    foreach (array_unique($matches[0]) as $url) {
        if (!preg_match('~-\d+x\d+\.~', $url)) {
            $image_urls[] = $url;
        }
    }
    echo "Found " . count($image_urls) . " images on kingsence.ru/shop/\n";
} else {
    echo "⚠ Could not fetch kingsence.ru/shop/ — using fallback placeholder images\n";
}

// ── Fallback: royalty-free suit placeholder images ────────────────────────────
if (empty($image_urls)) {
    // Picsum photos — dark/elegant style photos as placeholders
    $image_urls = [
        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80', // man in suit
        'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=800&q=80', // suit close-up
        'https://images.unsplash.com/photo-1593030761757-71fae45fa0e7?w=800&q=80', // elegant suit
    ];
    echo "Using " . count($image_urls) . " Unsplash placeholder images\n";
}

// ── Download and import each image ───────────────────────────────────────────
$imported     = [];
$limit        = 5; // max images to import
$count        = 0;

foreach ($image_urls as $url) {
    if ($count >= $limit) break;

    echo "Downloading: $url\n";

    // Download to temp file
    $tmp = download_url($url, 30);
    if (is_wp_error($tmp)) {
        echo "  ✗ Download failed: " . $tmp->get_error_message() . "\n";
        continue;
    }

    // Guess file name from URL
    $filename = sanitize_file_name(basename(parse_url($url, PHP_URL_PATH)));
    if (!preg_match('/\.(jpg|jpeg|png|webp)$/i', $filename)) {
        $filename .= '.jpg';
    }

    $file_array = [
        'name'     => $filename,
        'tmp_name' => $tmp,
    ];

    $attach_id = media_handle_sideload($file_array, $product_id, $product->get_name());

    if (is_wp_error($attach_id)) {
        echo "  ✗ Import failed: " . $attach_id->get_error_message() . "\n";
        @unlink($tmp);
        continue;
    }

    $imported[] = $attach_id;
    $count++;
    echo "  ✓ Imported attachment ID:{$attach_id}\n";
}

if (empty($imported)) {
    echo "\n✗ No images imported.\n";
    exit;
}

// ── Attach to product ─────────────────────────────────────────────────────────
// First image → featured (thumbnail)
set_post_thumbnail($product_id, $imported[0]);
echo "\n✓ Featured image set: attachment ID:{$imported[0]}\n";

// Remaining → gallery
if (count($imported) > 1) {
    $gallery_ids = array_slice($imported, 1);
    update_post_meta($product_id, '_product_image_gallery', implode(',', $gallery_ids));
    echo "✓ Gallery set: " . implode(', ', $gallery_ids) . "\n";
}

// ── Summary ───────────────────────────────────────────────────────────────────
echo "\n=== Images imported ===\n";
echo "Total: " . count($imported) . "\n";
foreach ($imported as $id) {
    echo "  [{$id}] " . wp_get_attachment_url($id) . "\n";
}
