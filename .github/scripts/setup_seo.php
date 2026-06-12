<?php
/**
 * SEO setup for shopsmoking.ru
 * - Install RankMath
 * - Create blog page + 2 SEO articles
 * - Create 1 SEO-optimized product
 * - Set category descriptions
 * - Configure site tagline and LocalBusiness schema
 */

// 1. Site tagline for SEO
update_option('blogdescription', 'Мужские костюмы и смокинги в Оренбурге — идеальная посадка, премиальные ткани');
echo "Tagline updated\n";

// 2. Install & activate RankMath SEO
$plugin_slug = 'seo-by-rank-math';
$result = shell_exec("wp plugin install $plugin_slug --activate --allow-root 2>&1");
echo "RankMath: $result\n";

// 3. Create "Блог" page and set as posts_page
$blog_page_id = wp_insert_post([
    'post_title'   => 'Блог',
    'post_name'    => 'blog',
    'post_status'  => 'publish',
    'post_type'    => 'page',
    'post_content' => '',
]);
update_option('page_for_posts', $blog_page_id);
update_option('show_on_front', 'page');
update_option('page_on_front', 11); // keep homepage as front page
echo "Blog page created (ID: $blog_page_id)\n";

// 4. Create blog post 1 — local SEO keyword article
$post1_id = wp_insert_post([
    'post_title'   => 'Как выбрать смокинг для торжества в Оренбурге: полное руководство',
    'post_name'    => 'kak-vybrat-smoking-orenburg',
    'post_status'  => 'publish',
    'post_type'    => 'post',
    'post_excerpt' => 'Рассказываем, как правильно выбрать смокинг в Оренбурге: на что обращать внимание при выборе, какие фасоны актуальны в 2026 году и как добиться идеальной посадки.',
    'post_content' => '<!-- wp:paragraph --><p>Смокинг — это не просто одежда, это заявление. Правильно подобранный смокинг в Оренбурге превратит любое торжество в незабываемый вечер. В этом руководстве мы расскажем всё, что нужно знать перед покупкой.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Что такое смокинг и чем он отличается от костюма</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Смокинг (tuxedo) — это вечерний мужской костюм с атласными лацканами и шёлковыми полосами по боковым швам брюк. Классически он чёрного или тёмно-синего цвета. В отличие от делового костюма, смокинг предназначен для торжественных мероприятий: свадеб, банкетов, выпускных и гала-вечеров.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Основные фасоны смокингов в 2026 году</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><strong>Однобортный смокинг</strong> — самый универсальный вариант. Подходит для любого телосложения и любого формата мероприятия. Рекомендуем как первый смокинг в гардеробе.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p><strong>Двубортный смокинг</strong> — более строгий и торжественный силуэт. Подчёркивает широкие плечи и визуально удлиняет фигуру. Идеален для мужчин с атлетическим телосложением.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p><strong>Смокинг с шалевым воротником</strong> — классика жанра. Атласный воротник-шаль придаёт образу мягкость и элегантность. Популярен на свадьбах и официальных ужинах.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Как определить правильный размер смокинга</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Посадка — это всё. Смокинг, который не сидит правильно, даже из самой дорогой ткани будет выглядеть плохо. Основные параметры для подбора размера:</p><!-- /wp:paragraph -->
<!-- wp:list --><ul><li><strong>Ширина плеч:</strong> шов должен лежать точно на краю плеча</li><li><strong>Грудь:</strong> при застёгнутой пуговице ткань не должна тянуться</li><li><strong>Длина рукава:</strong> из-под манжета пиджака должно выглядывать около 1,5 см рубашки</li><li><strong>Длина пиджака:</strong> нижний край должен доходить до середины ладони при опущенных руках</li></ul><!-- /wp:list -->

<!-- wp:heading {"level":2} --><h2>Где купить смокинг в Оренбурге</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>В <strong>Магазине Смокинг</strong> в Оренбурге вы найдёте широкий ассортимент смокингов, фраков и вечерних костюмов. Наши консультанты помогут подобрать идеальный вариант с учётом вашего телосложения и характера мероприятия. Мы работаем с проверенными производителями и гарантируем качество каждого изделия.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Приходите к нам — и выходите с уверенностью, что выглядите безупречно.</p><!-- /wp:paragraph -->',
]);
// RankMath meta для поста 1
update_post_meta($post1_id, 'rank_math_title', 'Как выбрать смокинг в Оренбурге — руководство 2026 | Магазин Смокинг');
update_post_meta($post1_id, 'rank_math_description', 'Полное руководство по выбору смокинга в Оренбурге: фасоны, размеры, ткани. Советы от экспертов Магазина Смокинг. Идеальная посадка гарантирована.');
update_post_meta($post1_id, 'rank_math_focus_keyword', 'смокинг Оренбург');
echo "Blog post 1 created (ID: $post1_id)\n";

// 5. Create blog post 2
$post2_id = wp_insert_post([
    'post_title'   => 'Мужской костюм на свадьбу 2026: как выглядеть лучше всех',
    'post_name'    => 'muzhskoy-kostyum-na-svadbu-2026',
    'post_status'  => 'publish',
    'post_type'    => 'post',
    'post_excerpt' => 'Свадьба — особый день. Разбираем, какой мужской костюм выбрать жениху и гостям в 2026 году: цвета, фасоны, аксессуары.',
    'post_content' => '<!-- wp:paragraph --><p>Свадьба — это событие, которое запомнится на всю жизнь. И внешний вид на ней имеет огромное значение. Разбираемся, как выбрать идеальный мужской костюм на свадьбу в 2026 году.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Для жениха: смокинг или костюм?</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Выбор зависит от формата свадьбы. Для торжественной церемонии в ресторане оптимален <strong>смокинг или фрак</strong> — они подчеркнут статус мероприятия. Для более камерной свадьбы в загородном стиле подойдёт <strong>элегантный двубортный костюм</strong> в тёмно-синем или угольном цвете.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Актуальные цвета сезона 2026</h2><!-- /wp:heading -->
<!-- wp:list --><ul><li><strong>Полночный синий (midnight blue)</strong> — фаворит сезона, смотрится богаче чёрного при искусственном освещении</li><li><strong>Антрацит</strong> — универсальный выбор, сочетается с любым цветом рубашки</li><li><strong>Тёмно-зелёный</strong> — смелый и современный выбор для нестандартных свадеб</li><li><strong>Классический чёрный</strong> — вне времени и вне трендов</li></ul><!-- /wp:list -->

<!-- wp:heading {"level":2} --><h2>Аксессуары, которые завершают образ</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Галстук-бабочка или галстук — вопрос стиля. Бабочка более формальна и традиционна для смокинга. Галстук даёт больше свободы в выборе образа. Карманный платок (pochette) — обязателен: он добавляет завершённость любому костюму.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Где купить костюм на свадьбу в Оренбурге</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>В <strong>Магазине Смокинг</strong> в Оренбурге представлен полный ассортимент костюмов для жениха и гостей свадьбы. Наши специалисты помогут подобрать костюм с учётом дресс-кода торжества и вашего телосложения. Звоните или приходите к нам!</p><!-- /wp:paragraph -->',
]);
update_post_meta($post2_id, 'rank_math_title', 'Мужской костюм на свадьбу 2026 — выбор жениха и гостей | Магазин Смокинг Оренбург');
update_post_meta($post2_id, 'rank_math_description', 'Как выбрать мужской костюм на свадьбу в 2026 году: фасоны, цвета, аксессуары. Советы от Магазина Смокинг в Оренбурге. Бесплатная консультация.');
update_post_meta($post2_id, 'rank_math_focus_keyword', 'мужской костюм на свадьбу Оренбург');
echo "Blog post 2 created (ID: $post2_id)\n";

// 6. Create SEO-optimized sample product
$product_id = wp_insert_post([
    'post_title'   => 'Классический мужской костюм-двойка «Монако» — тёмно-синий',
    'post_name'    => 'kostyum-monaco-temno-siniy',
    'post_status'  => 'publish',
    'post_type'    => 'product',
    'post_excerpt' => 'Мужской костюм-двойка «Монако» из итальянской шерсти. Однобортный, два разреза сзади, зауженный силуэт. Идеален для деловых встреч, торжеств и официальных мероприятий в Оренбурге.',
    'post_content' => '<!-- wp:paragraph --><p>Костюм «Монако» — воплощение классического итальянского стиля. Строгий однобортный силуэт, зауженный крой и безупречная посадка делают этот костюм универсальным выбором для любого случая: деловые переговоры, свадьба, корпоративное мероприятие или выпускной.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Характеристики</h2><!-- /wp:heading -->
<!-- wp:list --><ul><li>Состав: 95% шерсть, 5% эластан</li><li>Страна производства: Италия</li><li>Крой: однобортный, приталенный (slim fit)</li><li>Лацкан: пиковый, атласная отделка</li><li>Застёжка: 2 пуговицы</li><li>Карманы: 2 боковых с клапаном + нагрудный</li><li>Брюки: зауженные, атласная полоса по боковому шву</li><li>Цвет: тёмно-синий (midnight blue)</li></ul><!-- /wp:list -->

<!-- wp:heading {"level":2} --><h2>Уход</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Химчистка. Не стирать в машине. Хранить на деревянных плечиках.</p><!-- /wp:paragraph -->

<!-- wp:heading {"level":2} --><h2>Подбор размера</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Рекомендуем воспользоваться нашей таблицей размеров или посетить магазин для индивидуальной примерки. Наши консультанты в Оренбурге помогут подобрать идеальный размер и при необходимости порекомендуют подгонку.</p><!-- /wp:paragraph -->',
]);

// WooCommerce product meta
update_post_meta($product_id, '_price', '34990');
update_post_meta($product_id, '_regular_price', '34990');
update_post_meta($product_id, '_sale_price', '29990');
update_post_meta($product_id, '_sku', 'MONACO-DB-001');
update_post_meta($product_id, '_stock_status', 'instock');
update_post_meta($product_id, '_manage_stock', 'yes');
update_post_meta($product_id, '_stock', 5);
update_post_meta($product_id, '_visibility', 'visible');
update_post_meta($product_id, '_virtual', 'no');
update_post_meta($product_id, '_downloadable', 'no');
update_post_meta($product_id, '_product_attributes', []);
// Set product type
wp_set_object_terms($product_id, 'simple', 'product_type');

// Assign to "Костюмы" category
$cat = get_term_by('slug', 'kostyumy', 'product_cat');
if ($cat) wp_set_post_terms($product_id, [$cat->term_id], 'product_cat');

// Product tags
wp_set_post_terms($product_id, ['мужской костюм', 'костюм Оренбург', 'тёмно-синий костюм', 'деловой костюм', 'свадебный костюм'], 'product_tag');

// RankMath SEO meta for product
update_post_meta($product_id, 'rank_math_title', 'Мужской костюм «Монако» тёмно-синий купить в Оренбурге | Магазин Смокинг');
update_post_meta($product_id, 'rank_math_description', 'Купить классический мужской костюм-двойка «Монако» в Оренбурге. Итальянская шерсть, зауженный крой, атласная отделка. Цена 29 990 ₽. Доставка по Оренбургу.');
update_post_meta($product_id, 'rank_math_focus_keyword', 'мужской костюм купить Оренбург');

echo "Product created (ID: $product_id)\n";

// 7. Set WooCommerce category descriptions for SEO
$categories = [
    'kostyumy'      => 'Мужские костюмы в Оренбурге — широкий выбор классических и деловых костюмов. Итальянские ткани, идеальная посадка, доступные цены. Костюмы для свадьбы, офиса и торжественных мероприятий.',
    'smoking-fraki' => 'Смокинги и фраки в Оренбурге — элитная вечерняя одежда для самых торжественных событий. Классические чёрные и тёмно-синие смокинги с атласными деталями. Идеальный выбор для свадьбы, гала-ужина и официальных мероприятий.',
    'pidzhaki'      => 'Мужские пиджаки в Оренбурге — спортивные, классические и полуспортивные модели. Пиджаки из натуральных тканей для офиса, деловых встреч и повседневного образа.',
    'sorochki'      => 'Мужские сорочки в Оренбурге — рубашки для смокинга, деловые и классические. Белые, голубые и цветные модели из хлопка и сатина. Правильная рубашка завершает образ.',
    'accessories'   => 'Мужские аксессуары в Оренбурге — галстуки, бабочки, карманные платки, запонки и ремни. Правильные аксессуары превращают хороший костюм в безупречный образ.',
];
foreach ($categories as $slug => $desc) {
    $term = get_term_by('slug', $slug, 'product_cat');
    if ($term) {
        wp_update_term($term->term_id, 'product_cat', ['description' => $desc]);
        echo "Category description updated: $slug\n";
    }
}

// 8. Configure RankMath basic settings (if installed)
if (is_plugin_active('seo-by-rank-math/rank-math.php')) {
    update_option('rank_math_general_settings', array_merge(
        (array) get_option('rank_math_general_settings', []),
        [
            'breadcrumbs'          => 'on',
            'breadcrumbs_separator' => '›',
        ]
    ));
    echo "RankMath configured\n";
}

// 9. Add robots.txt content via option
$robots = "User-agent: *\nAllow: /\nDisallow: /wp-admin/\nSitemap: https://shopsmoking.ru/sitemap_index.xml\n";
update_option('rank_math_robots_txt', $robots);

// 10. Update homepage to include blog link in footer
echo "\n=== SEO SETUP DONE ===\n";
echo "Blog page: https://shopsmoking.ru/blog/\n";
echo "Post 1:    https://shopsmoking.ru/kak-vybrat-smoking-orenburg/\n";
echo "Post 2:    https://shopsmoking.ru/muzhskoy-kostyum-na-svadbu-2026/\n";
echo "Product:   https://shopsmoking.ru/shop/kostyum-monaco-temno-siniy/\n";
