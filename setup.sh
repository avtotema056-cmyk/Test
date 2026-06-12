#!/bin/bash
set -e

echo "=== Установка Claude API Server ==="

# Install flask
apt-get install -y python3-flask 2>/dev/null || pip3 install flask --break-system-packages

# Generate unique API key
API_KEY=$(cat /proc/sys/kernel/random/uuid | tr -d '-')

# Create API server
cat > /opt/claude-api.py << PYEOF
from flask import Flask, request, jsonify
import subprocess

app = Flask(__name__)
KEY = "$API_KEY"

@app.route('/ping')
def ping():
    return 'ok'

@app.route('/exec', methods=['POST'])
def run():
    if request.headers.get('X-Key') != KEY:
        return 'Unauthorized', 401
    cmd = (request.json or {}).get('cmd', '')
    if not cmd:
        return 'No command', 400
    try:
        r = subprocess.run(cmd, shell=True, capture_output=True, text=True, timeout=120)
        return jsonify({'out': r.stdout[-10000:], 'err': r.stderr[-3000:], 'code': r.returncode})
    except subprocess.TimeoutExpired:
        return jsonify({'out': '', 'err': 'timeout', 'code': -1})

app.run(host='0.0.0.0', port=7777)
PYEOF

# Create systemd service
cat > /etc/systemd/system/claude-api.service << SVCEOF
[Unit]
Description=Claude API Server
After=network.target

[Service]
ExecStart=/usr/bin/python3 /opt/claude-api.py
Restart=always
RestartSec=3

[Install]
WantedBy=multi-user.target
SVCEOF

systemctl daemon-reload
systemctl enable --now claude-api

# Open firewall
ufw allow 7777/tcp 2>/dev/null || true

echo ""
echo "================================"
echo "=== ГОТОВО ==="
echo "================================"
echo "API Key: $API_KEY"
echo "URL: http://176.124.212.75:7777"
echo "================================"
echo "Скопируйте API Key и отправьте Клоду!"
