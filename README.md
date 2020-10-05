Приложение каталог товаров
---

* Основной файл конфигурации app/config/main.php.
* В public/js/ находится вебпак-vue2 приложение для клиентской части.
* 3 контейнера docker настроены для работы (php, nginx, mysql).
* Чтобы инициализировать схему БД 
    * ./bin/site - войти в docker php.
    * vendor/bin/doctrine orm:schema-tool:create - запустить команду генерации таблиц.
    
### Примеры работы

При первом входе

![First example](https://i.gyazo.com/2cd743117b7973eecdf9e74ff769ed3a.png)

При успешной оплате заказа

![Second example](https://i.gyazo.com/a1104c259985b1e20011e2915f5c0cbf.png)
