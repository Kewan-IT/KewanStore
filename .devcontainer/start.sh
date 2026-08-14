#!/bin/sh
set -e

echo "-> A verificar ambiente KewanStore..."

if ! command -v php83 >/dev/null 2>&1 && [ ! -f /usr/local/bin/php ]; then
    echo "-> PHP não encontrado, a reinstalar o ambiente completo..."
    sh .devcontainer/setup.sh
    exit 0
fi

sudo ln -sf "$(which php83)" /usr/local/bin/php 2>/dev/null || true

if ! pgrep -x mariadbd >/dev/null 2>&1; then
    echo "-> A iniciar o MariaDB..."
    sudo mkdir -p /run/mysqld
    sudo chown mysql:mysql /run/mysqld
    sudo mariadbd-safe --user=mysql &
    sleep 5
else
    echo "-> MariaDB já está a correr."
fi

echo "-> Ambiente pronto."
