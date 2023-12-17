FROM php:8.1-fpm-alpine

RUN apk --update add \
    wget \
    curl \
    build-base \
    libmcrypt-dev \
    libxml2-dev \
    pcre-dev \
    zlib-dev \
    autoconf \
    oniguruma-dev \
    openssl \
    openssl-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    jpeg-dev \
    libpng-dev \
    imagemagick-dev \
    imagemagick \
    postgresql-dev \
    libzip-dev \
    gettext-dev \
    libxslt-dev \
    libgcrypt-dev &&\
    rm /var/cache/apk/*

RUN pecl channel-update pecl.php.net && \
    pecl install mcrypt redis-5.3.7 && \
    rm -rf /tmp/pear

RUN docker-php-ext-install \
    mysqli \
    mbstring \
    pdo \
    pdo_mysql \
    xml \
    pcntl \
    bcmath \
    pdo_pgsql \
    zip \
    intl \
    gettext \
    soap \
    sockets \
    xsl
    
# Install nginx and other dependencies
RUN apk add --no-cache nginx wget

# Create nginx runtime directory
RUN mkdir -p /run/nginx

# Copy nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Create the application directory
RUN mkdir -p /app

# Copy the Laravel application files to the container
COPY . /app

# Download and install Composer
RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"

# Install PHP dependencies
RUN cd /app && /usr/local/bin/composer install --no-dev

# Set ownership of the application files
RUN chown -R www-data: /app

# Copy the startup script into the container
COPY startup.sh /app/startup.sh

# Grant execution permissions to the startup script
RUN chmod +x /app/startup.sh

# Expose the port
EXPOSE 9000

# Set the working directory
WORKDIR /app

# Set the environment variable for PHP
ENV PORT=9000

# Update the nginx configuration with the correct port
CMD sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf && /app/startup.sh
