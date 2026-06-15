# shopsmoking.ru — Технический документ

## Сервер
- VPS: 176.124.212.75 (Timeweb Cloud), панель FASTPANEL
- Nginx → Apache 81 → PHP-FPM как fastuser
- Путь: /var/www/fastuser/data/www/shopsmoking.ru/
- WP-CLI: /usr/local/bin/wp --allow-root

## Стек
- WordPress 7.0 ru_RU + WooCommerce 10.8.1
- Тема: WoodMart 7.5.0 (parent) + woodmart-child (активна)
- Репозиторий: avtotema056-cmyk/test
- Ветка: claude/russian-language-y7kuv7
- Авто-деплой: push → GitHub Actions → SCP → VPS

## Дочерняя тема woodmart-child
- functions.php — хуки, переводы gettext, логотип, CSS-переменные
- assets/css/main.css — все стили (900+ строк)
- assets/js/main.js — scroll, MutationObserver для динамических элементов WoodMart
- front-page.php — кастомная главная страница
- footer.php — кастомный футер (4 колонки)

## Дизайн-токены
| Переменная | Значение | Назначение |
|---|---|---|
| --c-dark | #0e0e0e | Тёмный фон, кнопки |
| --c-gold | #c9a96e | Акцент везде |
| --c-cream | #f8f6f2 | Светлый фон |
| --f-serif | Cormorant Garamond | Заголовки |
| --f-sans | Inter | Текст |

## Контакты магазина
- Телефон: +7 (3532) 99-88-77
- Адрес: Оренбург, ул. Ленинская, 1
- Email: info@shopsmoking.ru
- Часы: Пн–Сб 10:00–20:00, Вс 11:00–18:00

## Известные проблемы (2026-06-15)
- Кнопка «Вернуться в магазин» — может быть зелёная (CSS+JS патч применён)
- Мобильное меню — английский текст «Set your categories menu...» (JS патч применён)
- Фото товаров — скрипт setup_images.php создан, нужно запустить через setup-shop.yml
