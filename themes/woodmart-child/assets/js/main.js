/* Магазин Смокинг — Child Theme JS */
(function ($) {
  'use strict';

  var $header = $('.site-header, .wd-header, header#masthead');

  // Header scroll state
  function updateHeader() {
    if ($(window).scrollTop() > 60) {
      $header.addClass('smk-scrolled');
    } else {
      $header.removeClass('smk-scrolled');
    }
  }
  $(window).on('scroll.smk', updateHeader);
  updateHeader();

  // Smooth scroll anchors
  $(document).on('click', 'a[href*="#"]', function (e) {
    var hash = this.hash;
    if (!hash || hash === '#') return;
    var $target = $(hash);
    if (!$target.length) return;
    e.preventDefault();
    var offset = $header.outerHeight() + 16;
    $('html, body').animate({ scrollTop: $target.offset().top - offset }, 500);
  });

  // Intersection Observer — fade-in on scroll
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('smk-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll(
      '.smk-product-card, .smk-cat-card, .smk-blog-card, .smk-usp-strip__item'
    ).forEach(function (el, i) {
      el.style.transitionDelay = (i % 4) * 0.07 + 's';
      el.classList.add('smk-fade-init');
      io.observe(el);
    });
  }

  // ── Fix WoodMart green "Return to shop" button → dark ────────────────────
  function fixButtons(root) {
    (root || document).querySelectorAll(
      '.return-to-shop a, .return-to-shop .button'
    ).forEach(function (btn) {
      btn.style.setProperty('background-color', '#0e0e0e', 'important');
      btn.style.setProperty('background',       '#0e0e0e', 'important');
      btn.style.setProperty('border-color',     '#0e0e0e', 'important');
      btn.style.setProperty('color',            '#ffffff', 'important');
    });
  }
  fixButtons();

  // ── Remove "Set your categories menu..." tip text in mobile nav ───────────
  function removeCatTip(root) {
    (root || document).querySelectorAll(
      '[class*="categories-tip"], .woodmart-nav-tab-categories-tip'
    ).forEach(function (el) { el.remove(); });

    // Fallback: find by text content inside mobile nav paragraphs
    (root || document).querySelectorAll(
      '.wd-nav-mobile p, .wd-mobile-nav p, .woodmart-mobile-nav p, ' +
      '.wd-nav-tabs-content p'
    ).forEach(function (p) {
      if (p.textContent && p.textContent.indexOf('Header builder') !== -1) {
        p.parentElement.remove();
      }
    });
  }
  removeCatTip();

  // Watch for WoodMart's dynamically-rendered cart popup and mobile menu
  if ('MutationObserver' in window) {
    var mo = new MutationObserver(function (mutations) {
      mutations.forEach(function (m) {
        m.addedNodes.forEach(function (node) {
          if (node.nodeType !== 1) return;
          fixButtons(node);
          removeCatTip(node);
        });
      });
    });
    mo.observe(document.body, { childList: true, subtree: true });
  }

})(jQuery);
