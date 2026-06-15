# Инфраструктура

## Основной VPS
- IP: 176.124.212.75 (Timeweb Cloud)
- Доступ: SSH через GitHub Actions (secrets.VPS_SSH_KEY)

## VPN сервер
- IP: 5.129.224.199
- Доступ: secrets.VPN_SSH_PASS (хранить только в GitHub Secrets)
- ⚠️ WireGuard НЕ установлен на основном VPS (176.124.212.75)
- Проверка: wg show, ip a, ss -tulnp

## Безопасность
- ⚠️ Никогда не передавать пароли в чате (инцидент 2026-06-15)
- Только GitHub Secrets для credentials
- VPN важен для стабильного IP — Claude аккаунт не банят

## Планируемое
- Claude на Timeweb VPS
- Python скрипт: VPS + cron + Claude API + Telegram Bot
- VPN Амстердам (рекомендация от Димы Квашнинова)
