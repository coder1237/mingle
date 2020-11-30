# Pull the php:7.4-fpm image
FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libzip-dev \
        zip \
        libmagickwand-dev --no-install-recommends apt-utils \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install -j$(nproc) gd

# Required extensions
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install xml
RUN docker-php-ext-install dom
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install json
RUN docker-php-ext-install ctype
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install pcntl


# set configurations for file upload
RUN echo "max_file_uploads=100 \n\
post_max_size=120M \n\
upload_max_filesize=120M \n\
max_execution_time=400 \n\
" >> /usr/local/etc/php/conf.d/docker-php-ext-uploads.ini

# Update
RUN apt-get update

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# GIT
RUN apt-get install -y git

# Expose on custom port
EXPOSE 9000
