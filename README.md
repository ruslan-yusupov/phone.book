# Телефонная книга

# Команды для запуска
```
docker-compose up -d --build

docker-compose exec php composer install

docker-compose exec php bash -c "cd assets/ && npm install && npm run build"

```

# Проверка работы в командной строке
```
docker-compose exec php php -f index.php
```

# Локальный домен
```
phone.book
```