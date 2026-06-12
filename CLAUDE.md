# Магазин Смокинг — shopsmoking.ru

## Проект
Интернет-магазин мужских костюмов и смокингов в Оренбурге. Стиль: SuitSupply — тёмный, золото, минимализм.

## Сервер
- VPS: 176.124.212.75 (Timeweb Cloud)
- Панель: FASTPANEL (Nginx → Apache 81 → PHP-FPM как fastuser)
- Путь сайта: `/var/www/fastuser/data/www/shopsmoking.ru/`
- WP-CLI: `/usr/local/bin/wp --allow-root`

## WordPress
- WordPress 7.0 ru_RU
- WooCommerce 10.8.1
- Тема: WoodMart 7.5.0 (parent) + woodmart-child (активна)
- Плагин: woodmart-core

## Дочерняя тема
Путь: `themes/woodmart-child/`
- `functions.php` — регистрация хуков, переводы, логотип, CSS-переменные
- `assets/css/main.css` — все стили (900+ строк + патчи)
- `assets/js/main.js` — scroll, smooth anchors, fade-in
- `front-page.php` — кастомная главная страница

## Деплой
- Авто-деплой при push в `themes/woodmart-child/**` на ветке `claude/russian-language-y7kuv7`
- Workflow: `.github/workflows/deploy-theme.yml`
- Скрипты БД: `.github/scripts/` → запуск через `setup-shop.yml`

## Дизайн-токены
| Переменная | Значение | Назначение |
|---|---|---|
| `--c-dark` | `#0e0e0e` | Тёмный фон, кнопки |
| `--c-gold` | `#c9a96e` | Акцент везде |
| `--c-gold-dark` | `#b8975d` | Hover золота |
| `--c-cream` | `#f8f6f2` | Светлый фон |
| `--f-serif` | Cormorant Garamond | Заголовки |
| `--f-sans` | Inter | Текст, кнопки |

## Ограничения
- **kingsence.ru — живой магазин, НЕЛЬЗЯ ИЗМЕНЯТЬ ни при каких условиях**
- Только чтение с kingsence.ru для справки

## Ветка разработки
`claude/russian-language-y7kuv7`

## Контакты магазина
- Телефон: +7 (3532) 99-88-77
- Адрес: Оренбург, ул. Ленинская, 1
- Email: info@shopsmoking.ru
- Часы: Пн–Сб 10:00–20:00, Вс 11:00–18:00
