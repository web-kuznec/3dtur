# Используем ваш образ в качестве основы
FROM shinsenter/php:5.6-fpm-nginx

# Принимаем UID пользователя хоста как аргумент сборки
ARG USER_ID=1000
ARG GROUP_ID=1000

# Меняем UID и GID существующего пользователя www-data
RUN usermod -u $USER_ID www-data && groupmod -g $GROUP_ID www-data