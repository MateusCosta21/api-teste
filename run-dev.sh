#!/bin/bash

# Definindo variáveis de ambiente
export DB_DATABASE="laravel"
export DB_USERNAME="root"
export DB_PASSWORD="secret"
export DB_HOST="pgsql"
export DB_PORT="5432"
export DB_CONNECTION="pgsql"
# Passo 1: Subir os containers do Docker
echo "📦 Instalando dependências do Composer..."
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
if [ $? -ne 0 ]; then
    echo "Erro ao instalar as dependências do Composer. Abortando."
    exit 1
fi
export WWWUSER=1000
export WWWGROUP=1000

# Passo 3: Copiar o arquivo .env.example para .env
echo "Copiando o arquivo .env.example para .env..."
cp .env.example .env
if [ $? -ne 0 ]; then
    echo "Erro ao copiar o arquivo .env.example para .env. Abortando."
    exit 1
fi
echo "Subindo os containers do Docker..."
docker-compose up -d
if [ $? -ne 0 ]; then
    echo "Erro ao subir os containers do Docker. Abortando."
    exit 1
fi

# Passo 2: Instalar as dependências do Composer
echo "Instalando dependências com o Composer..."
docker-compose exec laravel.test composer install
if [ $? -ne 0 ]; then
    echo "Erro ao instalar as dependências com o Composer. Abortando."
    exit 1
fi

# Passo 5: Rodar as migrations
echo "Rodando as migrations..."
docker-compose exec laravel.test php artisan migrate
if [ $? -ne 0 ]; then
    echo "Erro ao rodar as migrations. Abortando."
    exit 1

fi

# Passo 4: Gerar a chave do aplicativo Laravel
echo "Gerando a chave do aplicativo Laravel..."
docker-compose exec laravel.test php artisan key:generate
if [ $? -ne 0 ]; then
    echo "Erro ao gerar a chave do aplicativo Laravel. Abortando."
    exit 1
fi


echo "Gerando a chave jwt "
docker-compose exec  laravel.test php artisan jwt:secret
if [ $? -ne 0 ]; then
    echo "Erro ao gerar a chave do aplicativo Laravel. Abortando."
    exit 1
fi


echo "Rodando a MusicasSeeder..."
docker-compose exec laravel.test php artisan db:seed --class=MusicasSeeder
if [ $? -ne 0 ]; then
    echo "Erro ao rodar a MusicasSeeder. Abortando."
    exit 1
fi


echo "Rodando a RoleSeeder..."
docker-compose exec laravel.test php artisan db:seed --class=RoleSeeder
if [ $? -ne 0 ]; then
    echo "Erro ao rodar a RoleSeeder. Abortando."
    exit 1
fi

# Passo 6: Exibir mensagem de conclusão
echo "Configuração concluída com sucesso!"
