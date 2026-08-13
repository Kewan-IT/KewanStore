#!/bin/bash
set -e

echo "=================================================="
echo " KewanStore - Setup automático do ambiente"
echo "=================================================="

PHP_VERSION=$(php -r "echo PHP_VERSION;")
PHP_BASE=$(php -r "echo PHP_BINARY;" | sed 's|/bin/php||')
PHP_INI_SCAN_DIR=$(php -r "echo PHP_CONFIG_FILE_SCAN_DIR;")

echo "-> PHP detectado: $PHP_VERSION"
echo "-> Base: $PHP_BASE"
echo "-> Pasta de extensões (.ini): $PHP_INI_SCAN_DIR"

if ! command -v mariadb &> /dev/null; then
    echo "-> Instalando MariaDB..."
    sudo apt-get update -qq
    sudo apt-get install -y -qq mariadb-server mariadb-client
else
    echo "-> MariaDB já instalado, a saltar."
fi

sudo service mariadb start
sleep 2

if php -m | grep -qi "pdo_mysql"; then
    echo "-> pdo_mysql já ativo, a saltar compilação."
else
    echo "-> Compilando mysqlnd e pdo_mysql a partir do código-fonte do PHP $PHP_VERSION..."

    cd /tmp
    rm -rf "php-${PHP_VERSION}" "php-${PHP_VERSION}.tar.gz"
    curl -sSO "https://www.php.net/distributions/php-${PHP_VERSION}.tar.gz"
    tar -xzf "php-${PHP_VERSION}.tar.gz"

    cd "/tmp/php-${PHP_VERSION}/ext/mysqlnd"
    cp config9.m4 config.m4
    phpize
    CPPFLAGS="-I/tmp/php-${PHP_VERSION}" ./configure
    make -j"$(nproc)"
    sudo make install

    cd "/tmp/php-${PHP_VERSION}/ext/pdo_mysql"
    phpize
    CPPFLAGS="-I/tmp/php-${PHP_VERSION}" ./configure --with-pdo-mysql=mysqlnd
    make -j"$(nproc)"
    sudo make install

    echo "extension=mysqlnd.so" | sudo tee "${PHP_INI_SCAN_DIR}/00-mysqlnd.ini" > /dev/null
    echo "extension=pdo_mysql.so" | sudo tee "${PHP_INI_SCAN_DIR}/10-pdo_mysql.ini" > /dev/null

    cd /
    rm -rf "/tmp/php-${PHP_VERSION}" "/tmp/php-${PHP_VERSION}.tar.gz"

    echo "-> Extensões compiladas e ativadas."
fi

if ! php -m | grep -qi "^mysqli$"; then
    echo "-> Nota: extensão mysqli não instalada (opcional; o projeto usa apenas PDO)."
fi

DB_NAME="kewanstore"
DB_USER="kewanstore_user"
DB_PASS="kewanstore_pass"

echo "-> Configurando base de dados '$DB_NAME'..."

sudo mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
sudo mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

if [ -f "database/schema.sql" ] && [ -s "database/schema.sql" ]; then
    echo "-> Importando database/schema.sql..."
    sudo mysql "${DB_NAME}" < database/schema.sql
fi

echo ""
echo "=================================================="
echo " Setup concluído"
echo "=================================================="
php -m | grep -i -E "pdo|mysqlnd"
echo ""
echo " Base de dados: ${DB_NAME}"
echo " Utilizador:    ${DB_USER}"
echo " Password:      ${DB_PASS}  (ajusta em config/database.php)"
echo ""
echo " Para iniciar o servidor: php -S localhost:8000 -t public/"
echo "=================================================="
