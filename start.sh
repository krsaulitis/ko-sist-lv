#!/bin/sh

platform="lin";
if [[ "$OSTYPE" == "darwin"* ]]; then
    platform="mac";
elif [[ "$OSTYPE" == "cygwin" ]]; then
    platform="win";
elif [[ "$OSTYPE" == "msys" ]]; then
    platform="win";
fi

if [[ "$platform" == "lin" ]]; then
    sudo docker compose up -d || echo "Failed starting container" exit 1;
else
    docker compose up -d || echo "Failed starting container" exit 1;
fi

docker exec -it kosist-app /bin/bash
