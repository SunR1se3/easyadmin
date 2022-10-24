# Запуск easyadmin

### Установить необходимые пакеты
```composer install```

### Запуск сервера и контейнера
```
php -S localhost:8000 -t public/
docker-compose -f docker-compose.yml up
```

### Загрузить миграцию и фикстуры
```
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Готово.