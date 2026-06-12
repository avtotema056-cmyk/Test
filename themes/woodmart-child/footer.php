<?php
/**
 * Footer — Магазин Смокинг
 */
defined('ABSPATH') || exit;
?>

<footer class="smk-footer" role="contentinfo">

  <div class="smk-footer__main">
    <div class="smk-container">
      <div class="smk-footer__grid">

        <!-- Brand column -->
        <div class="smk-footer__col smk-footer__col--brand">
          <a class="smk-footer__logo" href="<?= esc_url(home_url('/')) ?>">Магазин Смокинг</a>
          <p class="smk-footer__tagline">Мужские костюмы и смокинги<br>премиального качества в Оренбурге</p>
          <div class="smk-footer__socials">
            <a class="smk-footer__social" href="#" aria-label="ВКонтакте" rel="noopener">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M15.07 2H8.93C3.33 2 2 3.33 2 8.93v6.14C2 20.67 3.33 22 8.93 22h6.14C20.67 22 22 20.67 22 15.07V8.93C22 3.33 20.67 2 15.07 2zm3.08 13.5h-1.5c-.57 0-.74-.45-1.76-1.48-.89-.86-1.28-.97-1.5-.97-.31 0-.4.09-.4.52v1.35c0 .37-.12.59-1.12.59-1.65 0-3.47-1-4.75-2.87C5.57 10.5 5 8.5 5 8.07c0-.22.09-.43.52-.43h1.5c.39 0 .54.18.69.6.76 2.18 2.03 4.1 2.56 4.1.2 0 .29-.09.29-.59V9.57c-.06-1.06-.62-1.15-.62-1.53 0-.18.15-.37.39-.37h2.36c.33 0 .44.18.44.56v3.02c0 .33.15.44.25.44.2 0 .37-.11.74-.48 1.15-1.28 1.96-3.26 1.96-3.26.11-.22.29-.43.68-.43h1.5c.45 0 .55.23.45.56-.19.87-2.02 3.46-2.02 3.46-.16.26-.22.37 0 .66.16.22.69.68 1.04 1.09.65.74 1.15 1.36 1.28 1.79.14.42-.08.64-.51.64z"/></svg>
            </a>
            <a class="smk-footer__social" href="#" aria-label="Telegram" rel="noopener">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
            </a>
            <a class="smk-footer__social" href="#" aria-label="WhatsApp" rel="noopener">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
            </a>
          </div>
        </div>

        <!-- Navigation column -->
        <div class="smk-footer__col">
          <h4 class="smk-footer__heading">Магазин</h4>
          <ul class="smk-footer__links">
            <li><a href="<?= esc_url(wc_get_page_permalink('shop')) ?>">Каталог</a></li>
            <li><a href="<?= esc_url(wc_get_page_permalink('shop')) ?>?orderby=popularity">Популярное</a></li>
            <li><a href="<?= esc_url(wc_get_page_permalink('shop')) ?>?orderby=price">По цене</a></li>
            <li><a href="<?= esc_url(home_url('/blog/')) ?>">Журнал о стиле</a></li>
          </ul>
        </div>

        <!-- Info column -->
        <div class="smk-footer__col">
          <h4 class="smk-footer__heading">Информация</h4>
          <ul class="smk-footer__links">
            <li><a href="<?= esc_url(home_url('/o-nas/')) ?>">О нас</a></li>
            <li><a href="<?= esc_url(home_url('/dostavka/')) ?>">Доставка и оплата</a></li>
            <li><a href="<?= esc_url(home_url('/vozvrat/')) ?>">Возврат товара</a></li>
            <li><a href="<?= esc_url(home_url('/kontakty/')) ?>">Контакты</a></li>
          </ul>
        </div>

        <!-- Contacts column -->
        <div class="smk-footer__col">
          <h4 class="smk-footer__heading">Контакты</h4>
          <ul class="smk-footer__contacts">
            <li>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.13 12.7 19.79 19.79 0 0 1 1.07 4.12 2 2 0 0 1 3.05 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="1.5"/></svg>
              <a href="<?= esc_attr(SMK_PHONE_HREF) ?>"><?= esc_html(SMK_PHONE) ?></a>
            </li>
            <li>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="1.5"/><polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="1.5"/></svg>
              <a href="mailto:<?= esc_attr(SMK_EMAIL) ?>"><?= esc_html(SMK_EMAIL) ?></a>
            </li>
            <li>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/></svg>
              <?= esc_html(SMK_ADDRESS) ?>
            </li>
            <li>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
              <?= esc_html(SMK_HOURS) ?>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <div class="smk-footer__bottom">
    <div class="smk-container smk-footer__bottom-inner">
      <p class="smk-footer__copy">&copy; <?= date('Y') ?> Магазин Смокинг, Оренбург. Все права защищены.</p>
      <ul class="smk-footer__legal">
        <li><a href="<?= esc_url(home_url('/politika-konfidencialnosti/')) ?>">Политика конфиденциальности</a></li>
        <li><a href="<?= esc_url(home_url('/dostavka/')) ?>">Доставка и оплата</a></li>
      </ul>
    </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
