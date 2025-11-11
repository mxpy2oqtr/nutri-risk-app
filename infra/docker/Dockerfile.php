# docker/Dockerfile.php
FROM php:8.3-fpm-alpine AS php-fpm

LABEL maintainer="NutriRisk Team"

# Instala dependencias + Nginx + Supervisor
RUN apk add --no-cache \
    nginx \
    supervisor \
    git curl zip unzip \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    postgresql-dev oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql mbstring exif pcntl bcmath

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia código
WORKDIR /var/www/html
COPY . .

# Laravel - ORDEN CORRECTO
RUN composer install --optimize-autoloader --no-dev --no-interaction \
    && cp .env.example .env 2>/dev/null || true \
    && php artisan key:generate --force \
    # PRIMERO: Crear archivo api.php si no existe
    && if [ ! -f routes/api.php ]; then \
        echo '<?php' > routes/api.php && \
        echo '' >> routes/api.php && \
        echo 'use Illuminate\Support\Facades\Route;' >> routes/api.php && \
        echo '' >> routes/api.php && \
        echo '// Rutas API aquí' >> routes/api.php; \
    fi \
    # LUEGO: Ejecutar migraciones (necesita api.php existente)
    && php artisan migrate --force \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Configs
COPY nginx.conf /etc/nginx/http.d/default.conf
COPY supervisord.conf /etc/supervisord.conf

EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
