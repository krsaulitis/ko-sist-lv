#!/bin/sh

platform="lin"
if [[ "$OSTYPE" == "darwin"* ]]; then
    platform="mac"
elif [[ "$OSTYPE" == "cygwin" ]]; then
    platform="win"
elif [[ "$OSTYPE" == "msys" ]]; then
    platform="win"
fi

if ! grep -q "kosist.test" "/etc/hosts"; then
    echo "Adding kosist.test to hosts file"

    if [[ "$platform" == "mac" ]]; then
        sudo -- sh -c -e "echo '127.0.0.1 kosist.test' >> /etc/hosts";
    else
        echo '127.0.0.1 kosist.test' >> /etc/hosts;
    fi
fi

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

docker-compose up --build -d
docker exec -it kosist-app php artisan migrate
