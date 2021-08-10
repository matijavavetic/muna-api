# Project Muna

## Installation
#### Clone the repository
```
git clone https://github.com/matijavavetic/project-muna.git
```

#### Build docker images and run the containers
```
docker-compose build
docker-compose up -d
```

#### Create .env file in src/api:
```
cd src/api
cp .env.example .env
```

#### SSH inside the API container, install packages and run migrations:
```
docker container exec -it project-muna_muna-api_1 sh
composer install
php artisan doctrine:migrations:migrate
```
#### Run tests in API container
```
./vendor/bin/phpunit
./vendor/bin/phpunit --group unit
./vendor/bin/phpunit --group integration
./vendor/bin/phpunit --group functional
```
#### Available API endpoints
```
muna.localhost/api/check -> accepts string and checks for patterns
muna.localhost/api/stat  -> shows current state of the game and previous attempts 
```
