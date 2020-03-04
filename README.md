# Authentication with clear PHP7.4

В image входит PHP-Apache, MySQL. 

Развернуть контейнер:
`sudo docker-compose up -d --build`

Установить компоненты composer:
 - `docker exec -t -i php_auth_php_1 /bin/bash`
 - `composer install`
 - `exit`

Развернуть dump базы данных:

`docker exec -i php_auth_db_1 sh -c "exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"" < ./db/all-databases.sql`

Зарегистрированые номера телефонов:
- `+1898678456`
- `+79958553240`

Пароль для всех один: `123456`

Сайт доступен по адресу http://localhost

Для быстрого подключения к базе данных можно подключить Adminer:

    adminer:
         image: adminer
         restart: always
         ports:
           - 8080:8080