Приложение каталог товаров
---

* Основной файл конфигурации app/config/main.php.
* В public/js/ находится вебпак-vue2 приложение для клиентской части.
* 3 контейнера docker настроены для работы (php, nginx, mysql).
* Чтобы инициализировать схему БД 
    * ./bin/site - войти в docker php.
    * vendor/bin/doctrine orm:schema-tool:create - запустить команду генерации таблиц.