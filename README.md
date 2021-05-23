# Todo List<br>

Тестовое приложение где фронт часть и бэкэнд часть независимы друг от друга. 
В web интерфейсе отображается список задач и у задач со статусом "В работе" есть возможность выставить статус "Выполнена"

### Требования
1.  PHP 7.4
2. СУБД MySQL <= 7


### Настройка приложения

1. Создать рабочую БД (СУБД MySQL)
2. Залить схему БД -
`mysql -u <user db> -h <host db> <database> < ddl.sql` (ddl.sql содержит схему БД и тестовые данные)
3. Файл `api/config/config.yaml.example` переименовать в `api/config/config.yaml`
4. Настроить параметры подключения к БД в файле `api/config/config.yaml`
5. Настроить параметр окружающей среды в файле `api/config/config.yaml`
6. Cоздать папку для временных файлов `mkdir api/var`
6. Изменить права на папку api/var - `chmod 777 api/var`
7. Уставновить пакеты composer <br>
```
cd <path project>/api
composer install --no-dev
```

### Запуск
1. API часть: <br>
```
open new terminal
cd <path project>
start-api.sh
```  
1. Front часть: <br>
```
open new terminal
cd <path project>
start-front.sh
```   
*Не реализован совместный запуск и остановка

web приложение станет доступно по url http://127.0.0.1:8800/

---
### Используемые библиотеки/реализации
1. Контейнер - **bitexpert/disco** (https://github.com/bitExpert/disco)
2. Механизм внедрение зависимостей - собственная ревлизация
2. Работа с БД (ORM) - **Doctrine**
3. Router - **league/route** (https://github.com/thephpleague/route)
4. Request and Response - **laminas/laminas-diactoros** (https://github.com/laminas/laminas-diactoros) 
5. emitter - **narrowspark/http-emitter** (https://github.com/narrowspark/http-emitter)
6. loger - **monolog/monolog** (https://github.com/Seldaek/monolog)
7. тесты - **phpunit/phpunit**

---
### Качество кода

1. **allysonsilva/php-pre-commit** - установленн pre-commit (https://github.com/allysonsilva/php-pre-commit). Подкорректированный файл в корне проекта `pre-commit` необходимо копировать в папку `.git/hooks/`
2. **phpstan/phpstan** - установлен статический анализатор кода (https://github.com/phpstan/phpstan)
3. **phpunit/phpunit** - тесты

---
### Не реализовано

1. Полноценная обработка ошибок
2. Безопасность
3. Тесты
4. Полноценные скрипты запуска/остановки
5. Не написан Swagger






