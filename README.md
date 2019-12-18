## How To

### Prerequisite

- PHP 7.2.5
- A database (mysql/innodb is preferred)
- Composer
- (optional) symfony app

### Install

- Clone this repo
- Install dependency with `composer install`
- Copy `.env` to `.env.local` and edit related configs, a bare minimum looks like this:

```
###> doctrine/doctrine-bundle ###
DATABASE_URL=mysql://user:password@server:port/db_name?serverVersion=5.7
###< doctrine/doctrine-bundle ###
```
- Execute the following command to recreate schema
```
php bin/console doctrine:schema:create
```

> note: no migration provided to ensure portability

### Try

- To start the server, either execute `symfony server:start` (if you have symfony installed) or `php -S 127.0.0.1:8000 -t public` to use PHP's built in server.

### Tests

TBA
