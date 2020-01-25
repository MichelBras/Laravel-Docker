FROM php:7.2-fpm-alpine

COPY launch-container.sh /usr/local/bin/launch-container
RUN chmod +x /usr/local/bin/launch-container

COPY local.ini /usr/local/etc/php/conf.d/local.ini

# Set working directory
WORKDIR /var/www

RUN apk update

# Install extensions
# RUN docker-php-ext-install pdo_mysql mbstring

# ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Add user for laravel application
RUN addgroup -S www && adduser -S www -G www

# Copy existing application directory permissions
RUN mkdir -p /var/www/vendor \
    && chown -R www:www /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/launch-container"]
CMD [""]
