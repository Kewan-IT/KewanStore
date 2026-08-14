#!/bin/sh
set -e

echo "=================================================="
echo " KewanStore - Instalação do ambiente (Alpine)"
echo "=================================================="

sudo apk update

sudo apk add --no-cache \
  php83 \
  php83-cli \
  php83-pdo \
  php83-pdo_mysql \
  php83-mysqlnd \
  php83-mbstring \
  php83-session \
  php83-json \
  php83-fileinfo \
  php83-tokenizer \
  php83-xml \
  php83-curl \
  php83-gd \
  php83-openssl \
  php83-phar \
  php83-ctype \
  php83-dom \
  mariadb \
  mariadb-client

sudo ln -sf "$(which php83)" /usr/local/bin/php

if [ ! -d /var/lib/mysql/mysql ]; then
    sudo mkdir -p /run/mysqld
    sudo chown mysql:mysql /run/mysqld
    sudo mysql_install_db --user=mysql --datadir=/var/lib/mysql
fi

sudo mkdir -p /run/mysqld
sudo chown mysql:mysql /run/mysqld
sudo mariadbd-safe --user=mysql &
sleep 5

sudo mysql -e "CREATE DATABASE IF NOT EXISTS kewanstore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'kewanstore_user'@'localhost' IDENTIFIED BY 'kewanstore_pass';"
sudo mysql -e "GRANT ALL PRIVILEGES ON kewanstore.* TO 'kewanstore_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

if [ -f "database/schema.sql" ]; then
    TABELA_EXISTE=$(sudo mysql -N -e "SHOW TABLES FROM kewanstore LIKE 'produtos';")
    if [ -z "$TABELA_EXISTE" ]; then
        echo "-> Importando database/schema.sql..."
        sudo mysql kewanstore < database/schema.sql
    else
        echo "-> Schema já importado, a saltar."
    fi
fi

echo "=================================================="
echo " Instalação concluída"
echo "=================================================="
php -v
php -m | grep -i -E "pdo|mysqlnd"
