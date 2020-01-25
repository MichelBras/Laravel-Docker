# Containerized Laravel project

This is a Laravel install that runs on containers. To run the containers you will need Docker Compose installed on your machine. If you dont have have Docker Compose installed refer to [this](https://docs.docker.com/compose/install/) manual.

## Installation

This will build all the needed containers. This commando will run the containers `daemonised`. Without the flag you will see the logging printed to the terminal.

``` 
docker-compose up -d
```

In the `mysql` container a laravel user will be added, because you dont want to operate as a root user in the database. So first you will need to open an interactive prompt with:

``` 
docker-compose exec db bash
```

Now you can login in the database as root. In the `docker-compose.yaml` you have entered the mysql root password `MYSQL_ROOT_PASSWORD`.

``` 
mysql -u root -p 'MYSQL_ROOT_PASSWORD'
```

In the `.env` there is a database user `DB_USERNAME` and database password `DB_PASSWORD`. You will need this variable for the next commando.

``` 
GRANT ALL ON laravel.* TO 'DB_USERNAME'@'%' IDENTIFIED BY 'DB_PASSWORD';
FLUSH PRIVILEGES;
EXIT;
```

You can check if you have access as the new user with:

``` 
mysql -u 'DB_USERNAME' -p 'DB_PASSWORD'
```

With acess to the database as the new user you can migrate the database.

``` 
docker-compose exec app php artisan migrate
```

You can also use tinker in the container

``` 
docker-compose exec app php artisan tinker
```

## Troubleshooting

While creating this environment I had some problems and I list al the problems I was dealing with:

1. Docker Laravel Mysql: could not find driver
I fixed this problem after removing all my containers, images and volumes. WARNING! these commandos will remove ALL, so dont copy these commandos if you dont want to delete all your containers, images or volumes!!

``` 
docker image rm $(docker image ls -q) to remove all your images.
docker rm $(docker ps -a -q) -f to remove all your containers.
docker volume prune to remove all your volumes.
docker-compose up -d to build all your containers.
docker-compose exec app php artisan config:cache for clearing all the config caches.
```

2. PDOException::("SQLSTATE[HY000][1045] Access denied for user 'laraveluser'@'app.laravel-container_app-network' (using password: YES)")
I fixed this problem after checking the `.env` in my `app` container

``` 
docker-compose exec app vi .env this is the `.env` that is binded to your local `.env`. But you can always check if all the variables are accurate.
docker-compose exec app php artisan config:cache for clearing all the config caches.
```
