<?php
/**
 * Homepage template — Смокинг Premium
 */
defined('ABSPATH') || exit;
get_header();
?>

<main id="smk-main" class="smk-front-page" role="main">

  <!-- ═══ HERO ══════════════════════════════════════════════════════════════ -->
  <section class="smk-hero" aria-label="Главный баннер">
    <div class="smk-hero__bg" aria-hidden="true"></div>
    <div class="smk-hero__content">
      <span class="smk-eyebrow">Магазин смокингов · Оренбург</span>
      <h1 class="smk-hero__title">Костюм,<br>который <em>запомнят</em></h1>
      <p class="smk-hero__sub">Более 500 моделей · Идеальная посадка · Доставка по России</p>
      <div class="smk-hero__btns">
        <a class="smk-btn smk-btn--gold" href="<?= esc_url(wc_get_page_permalink('shop')) ?>">Смотреть каталог</a>
        <a class="smk-btn smk-btn--ghost" href="<?= esc_url(home_url('/kontakty/')) ?>">Записаться на примерку</a>
      </div>
    </div>
    <div class="smk-hero__scroll" aria-hidden="true">
      <span>Прокрутите вниз</span>
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12l7 7 7-7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </div>
  </section>

  <!-- ═══ USP STRIP ════════════════════════════════════════════════════════ -->
  <div class="smk-usp-strip" aria-label="Наши преимущества">
    <div class="smk-container">
      <div class="smk-usp-strip__grid">

        <div class="smk-usp-strip__item">
          <svg class="smk-usp-strip__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="1.5"/>
          </svg>
          <div><strong>Бесплатная подгонка</strong><span>При покупке костюма</span></div>
        </div>

        <div class="smk-usp-strip__item">
          <svg class="smk-usp-strip__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="1" y="3" width="15" height="13" rx="2" stroke="currentColor" stroke-width="1.5"/>
            <path d="M16 8h4l3 3v5h-7V8z" stroke="currentColor" stroke-width="1.5"/>
            <circle cx="5.5" cy="18.5" r="2.5" stroke="currentColor" stroke-width="1.5"/>
            <circle cx="18.5" cy="18.5" r="2.5" stroke="currentColor" stroke-width="1.5"/>
          </svg>
          <div><strong>Доставка по России</strong><span>От 3 рабочих дней</span></div>
        </div>

        <div class="smk-usp-strip__item">
          <svg class="smk-usp-strip__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
          <div><strong>Работаем каждый день</strong><span>Пн–Сб 10:00–20:00</span></div>
        </div>

        <div class="smk-usp-strip__item">
          <svg class="smk-usp-strip__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-width="1.5"/>
            <polyline points="22 4 12 14.01 9 11.01" stroke="currentColor" stroke-width="1.5"/>
          </svg>
          <div><strong>Гарантия качества</strong><span>Проверенные производители</span></div>
        </div>

      </div>
    </div>
  </div>

  <!-- ═══ CATEGORIES ════════════════════════════════════════════════════════ -->
  <section class="smk-section smk-section--light smk-categories-section">
    <div class="smk-container">
      <?php smk_section_head('Ассортимент', 'Категории', esc_url(wc_get_page_permalink('shop')), 'Весь каталог', true); ?>
      <div class="smk-cat-grid">
        <?php
        $cats = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'exclude'    => [(int) get_option('default_product_cat')],
            'orderby'    => 'name',
            'order'      => 'ASC',
            'number'     => 5,
        ]);
        foreach ((array) $cats as $cat) :
            if (is_wp_error($cat)) continue;
            $thumb_id  = get_term_meta($cat->term_id, 'thumbnail_id', true);
            $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'smk-category') : '';
            $cat_url   = get_term_link($cat);
        ?>
        <a class="smk-cat-card" href="<?= esc_url($cat_url) ?>"
           style="<?= $thumb_url ? "background-image:url('" . esc_url($thumb_url) . "')" : '' ?>">
          <div class="smk-cat-card__overlay" aria-hidden="true"></div>
          <div class="smk-cat-card__body">
            <h3 class="smk-cat-card__title"><?= esc_html($cat->name) ?></h3>
            <?php if ($cat->count > 0): ?>
              <span class="smk-cat-card__count"><?= (int) $cat->count ?>&nbsp;товаров</span>
            <?php endif; ?>
            <span class="smk-cat-card__arrow" aria-hidden="true">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ═══ NEW ARRIVALS ══════════════════════════════════════════════════════ -->
  <section class="smk-section smk-new-arrivals">
    <div class="smk-container">
      <?php smk_section_head('Коллекция', 'Новые поступления', esc_url(wc_get_page_permalink('shop')), 'Весь каталог', true); ?>
      <div class="smk-products-grid">
        <?php
        $products = wc_get_products([
            'limit'   => 8,
            'status'  => 'publish',
            'orderby' => 'date',
            'order'   => 'DESC',
        ]);
        foreach ($products as $product) {
            smk_product_card($product);
        }
        ?>
      </div>
      <div class="smk-section__more">
        <a class="smk-btn smk-btn--dark-outline" href="<?= esc_url(wc_get_page_permalink('shop')) ?>">Смотреть весь каталог</a>
      </div>
    </div>
  </section>

  <!-- ═══ BRAND STORY ═══════════════════════════════════════════════════════ -->
  <section class="smk-story" aria-label="О магазине">
    <div class="smk-story__visual" aria-hidden="true"></div>
    <div class="smk-story__content">
      <span class="smk-section-head__label">О нас</span>
      <h2 class="smk-story__title">Мастерство<br>в каждой детали</h2>
      <p class="smk-story__text">«Магазин Смокинг» в Оренбурге — это пространство для мужчин, которые знают цену своему образу. Мы подбираем костюмы из итальянских и британских тканей, с идеальной посадкой и профессиональной подгонкой по фигуре.</p>
      <p class="smk-story__text">Более 500 моделей: классика, свадебные костюмы, смокинги, деловые и торжественные ансамбли. На любой повод и бюджет.</p>
      <div class="smk-story__info">
        <div class="smk-story__info-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/></svg>
          <?= esc_html(SMK_ADDRESS) ?>
        </div>
        <div class="smk-story__info-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="1.5"/></svg>
          <a href="<?= esc_attr(SMK_PHONE_HREF) ?>"><?= esc_html(SMK_PHONE) ?></a>
        </div>
      </div>
      <a class="smk-btn smk-btn--gold-outline smk-story__btn" href="<?= esc_url(home_url('/o-nas/')) ?>">Узнать больше о нас</a>
    </div>
  </section>

  <!-- ═══ BLOG PREVIEW ══════════════════════════════════════════════════════ -->
  <?php
  $blog_posts = get_posts(['numberposts' => 3, 'post_status' => 'publish']);
  if ($blog_posts):
  ?>
  <section class="smk-section smk-section--light smk-blog-section">
    <div class="smk-container">
      <?php
      $blog_page_id = (int) get_option('page_for_posts');
      $blog_url     = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
      smk_section_head('Журнал о стиле', 'Советы и тренды', $blog_url, 'Все статьи', true);
      ?>
      <div class="smk-blog-grid">
        <?php foreach ($blog_posts as $post):
            setup_postdata($post);
            $img_id  = get_post_thumbnail_id($post->ID);
            $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'smk-blog') : '';
        ?>
        <article class="smk-blog-card">
          <?php if ($img_url): ?>
          <a class="smk-blog-card__img-wrap" href="<?= get_permalink($post->ID) ?>" tabindex="-1" aria-hidden="true">
            <img class="smk-blog-card__img" src="<?= esc_url($img_url) ?>"
                 alt="<?= esc_attr($post->post_title) ?>" loading="lazy">
          </a>
          <?php endif; ?>
          <div class="smk-blog-card__body">
            <time class="smk-blog-card__date" datetime="<?= get_the_date('Y-m-d', $post->ID) ?>">
              <?= get_the_date('d F Y', $post->ID) ?>
            </time>
            <h3 class="smk-blog-card__title">
              <a href="<?= get_permalink($post->ID) ?>"><?= esc_html($post->post_title) ?></a>
            </h3>
            <p class="smk-blog-card__excerpt"><?= wp_trim_words(get_the_excerpt($post->ID), 20) ?></p>
            <a class="smk-link-arrow" href="<?= get_permalink($post->ID) ?>">Читать статью
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="1.5"/></svg>
            </a>
          </div>
        </article>
        <?php endforeach; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ═══ CTA BANNER ════════════════════════════════════════════════════════ -->
  <section class="smk-cta-banner" aria-label="Запись на примерку">
    <div class="smk-cta-banner__bg" aria-hidden="true"></div>
    <div class="smk-cta-banner__content">
      <span class="smk-eyebrow">Индивидуальный подход</span>
      <h2 class="smk-cta-banner__title">Запишитесь на<br>бесплатную примерку</h2>
      <p class="smk-cta-banner__sub">Наш стилист подберёт идеальный костюм<br>и сделает подгонку по вашей фигуре</p>
      <div class="smk-cta-banner__actions">
        <a class="smk-btn smk-btn--gold" href="<?= esc_url(home_url('/kontakty/')) ?>">Записаться</a>
        <a class="smk-btn smk-btn--ghost" href="<?= esc_attr(SMK_PHONE_HREF) ?>"><?= esc_html(SMK_PHONE) ?></a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
