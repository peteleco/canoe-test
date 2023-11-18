## Running the project
To speed up I'm using Laravel Sail that's a docker development environment
https://laravel.com/docs/10.x/sail#introduction

```
cd canoe-test && ./vendor/bin/sail up
# To start all of the Docker containers in the background, you may start Sail in "detached" mode:
./vendor/bin/sail up -d
```

### Migrate the database with some values
```shell
sail artisan migrate --step --seed
# or make a full refresh
sail artisan migrate:refresh --seed
```