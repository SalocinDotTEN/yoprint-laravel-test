## YoPrint Test

This is the source code of the test Laravel app created for the purpose of the YoPrint interview ONLY.

It uses resumable js to handle the large file upload and then SQLite as the database.

To install locally clone the repo then run in project root...

```composer install```

Create the .env file.

```php artisan key:generate```

```php artian vendor:publish```

Create the database.sqlite file inside of the database folder/directory.

```php artisan migrate```

```php artisan serve```

The app is accessible from the URL http://yoprint.salocinten.info/

The database viewer is accessible from the URL http://yoprint.salocinten.info/dbviewer
