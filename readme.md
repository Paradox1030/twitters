
# Laravel docker redis twitters queue


## Installation 

 ```Clone the repo```
 
```sh
docker-compose build

```


```sh
docker-compose up -d

```

```sh
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed --class=Category
docker-compose exec php php artisan queue:work
```

Now browse project 

 ```
 http://localhost:8083/

```

