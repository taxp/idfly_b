Основано на Yii 2 Basic Project Template


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

Склонировать этот репозиторий, перейти в папку с проектом.

Если в системе есть Composer, перейти к следующему шагу, иначе установить его, следуя инструкциям на getcomposer.org.

Запустить
```text
composer install
```

Установить права на папки:
```text
chmod -R 777 runtime/
chmod -R 777 web/assets/
```

Прописать реальный доступ к базе данных в файле `config/db.php`

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

Запустить миграцию для создания таблицы:
```text
php yii migrate
```

Установить корневой директорией хоста директорию web