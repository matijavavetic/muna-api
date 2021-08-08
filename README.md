# Project Muna

## Installation
#### Clone the repository
```
git clone https://github.com/matijavavetic/tq-api.git
```

#### Install docker images, up the containers & run local UI server
```
make setup
```

#### Create .env file in src/api:
```
cd src/api
cp .env.example .env
```

#### SSH inside the API container and install packages:
```
make api-ssh
composer install
```
#### Run tests in API container
```
./vendor/bin/phpunit
./vendor/bin/phpunit --group unit
./vendor/bin/phpunit --group integration
./vendor/bin/phpunit --group functional
```
