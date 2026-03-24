# # Étape 1 : Choisir une image PHP avec Apache
# FROM php:8.2-apache

# # Étape 2 : Installer les extensions PHP requises
# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# # Étape 3 : Activer le module Apache pour Laravel (mod_rewrite)
# RUN a2enmod rewrite

# # Étape 4 : Copier le code du projet Laravel dans le conteneur
# COPY . /var/www/html

# # Étape 5 : Définir les permissions correctes
# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html

# # Étape 6 : Copier un fichier de configuration Apache personnalisé (optionnel)
# # COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# # Étape 7 : Installer Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Étape 8 : Installer les dépendances Laravel
# RUN composer install --no-interaction

# # Port exposé
# EXPOSE 80

FROM php:8.4-fpm

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    jpegoptim optipng pngquant gifsicle \
    nginx \
    supervisor \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /app

# Copier fichiers
COPY . .

# ⚠️ Important : éviter les erreurs liées au .env
RUN cp .env.example .env || true

# Installer Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Générer clé Laravel
RUN php artisan key:generate || true

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Configurer Nginx
COPY <<EOF /etc/nginx/sites-available/default
server {
    listen 80;
    index index.php index.html;
    server_name localhost;
    root /app/public;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php\$ {
        try_files \$uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)\$;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param PATH_INFO \$fastcgi_path_info;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOF

# Configurer Supervisor
COPY <<EOF /etc/supervisor/conf.d/supervisord.conf
[supervisord]
nodaemon=true

[program:php-fpm]
command=php-fpm
autostart=true
autorestart=true
priority=5

[program:nginx]
command=nginx -g "daemon off;"
autostart=true
autorestart=true
priority=10
EOF

# Exposer port
EXPOSE 80

# Démarrer les services
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]