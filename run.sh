#!/bin/bash

if [ $# -eq 0 ]; then

    docker-compose run --rm artisan_alkamal_store_app remove $1 $2

else

    if [ $1 == "remove" ]; then
        docker-compose run --rm artisan_alkamal_store_app remove log session
    fi

    if [ $1 == "composer" ]; then
        docker-compose run --rm composer_alkamal_store_app $2 $3
    fi

    if [ $1 == "m" ]; then
        docker-compose run --rm artisan_alkamal_store_app make:model $2 $3
    fi

    if [ $1 == "c" ]; then
        docker-compose run --rm artisan_alkamal_store_app make:controller $2 $3
    fi

    if [ $1 == "storage:link" ]; then
        docker-compose run --rm artisan_alkamal_store_app storage:link
    fi

    if [ $1 == "dts" ]; then
        docker-compose run --rm artisan_alkamal_store_app db:wipe && docker-compose run --rm artisan_alkamal_store_app migrate --seed
    fi

    if [ $1 == "s" ]; then
        docker-compose run --rm artisan_alkamal_store_app make:seed $2
    fi

    if [ $1 == "a" ]; then
        docker-compose run --rm artisan_alkamal_store_app $2 $3 $4
    fi

fi
