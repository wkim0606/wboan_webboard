FROM php:8.2-apache

# mysqli 확장 설치
RUN docker-php-ext-install mysqli

# Apache 설정 (rewrite)
RUN a2enmod rewrite

# 소스 복사
COPY . /var/www/html/

# 권한 설정
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
