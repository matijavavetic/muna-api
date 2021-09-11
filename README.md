# Project Muna

Game which checks user's input for certain patterns. The pattern to be searched for is defined as follows.

X = [a, e, i, o, u]

If the first character is not in X, the last character must be a "!". If the first character is in X, the second character must also be in X. After that an arbitrary number of characters can follow which all must be from X. Additionally the character "b" is now allowed. If a "b" is found the next characters must be a, g, u, e, t, t, e, in the given order. The string can be interrupted any number of times by single or multiple "#". All characters after that can be ignored. The maximum length of the string is limited to 100 characters. Upper and lower case is ignored. Only utf-8 characters are allowed. Following are a few examples.

- "DEADBEEF!" is ok
- "ok" is not ok
- "baguette" is not ok
- "oub#aguette" is ok
- "ouib#a##guette" is ok


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
