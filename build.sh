#!/bin/sh

platform="lin";
if [[ "$OSTYPE" == "darwin"* ]]; then
    platform="mac";
elif [[ "$OSTYPE" == "cygwin" ]]; then
    platform="win";
elif [[ "$OSTYPE" == "msys" ]]; then
    platform="win";
fi

if ! grep -q "kosist.test" "/etc/hosts"; then
    echo "Adding kosist.test to hosts file...";nano

    if [[ "$platform" == "win" ]]; then
        echo '127.0.0.1 kosist.test' >> /etc/hosts || echo "Failed to add kosist.test to hosts file";
    else
        sudo -- sh -c -e "echo '127.0.0.1 kosist.test' >> /etc/hosts" || echo "Failed to add kosist.test to hosts file";
    fi
fi

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

if [[ "$platform" == "lin" ]]; then
    sudo systemctl start docker || echo "Failed starting docker service" exit 1;
fi

docker compose build || echo "Container build failed" exit 1;
docker compose up -d || echo "Failed to start container" exit 1;

docker exec -it kosist-app composer install
docker exec -it kosist-app php artisan migrate;
docker exec -it kosist-app npm install
docker exec -it kosist-app npm run build
