
# Use a imagem oficial do PHP com FPM
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código fonte da aplicação para o contêiner
COPY . .

# Definindo as permissões corretas (opcional)
RUN chown -R www-data:www-data /var/www/html

# Instalar dependências do PHP
RUN composer install

# RUN chmod +x /usr/local/bin/docker-php-entrypoint

# Expor a porta (opcional)
# Expondo a porta 8000, que é a padrão para o PHP-FPM
EXPOSE 8000

# Inicia o servidor PHP-FPM
# ENTRYPOINT ["docker-php-entrypoint"]
# CMD ["php-fpm"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]