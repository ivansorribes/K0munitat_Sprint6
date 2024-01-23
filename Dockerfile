RUN apt-get update; \ # Imagick extension apt-get install -y libmagickwand-dev; \ pecl install imagick; \ docker-php-ext-enable imagick; \ # Success true
