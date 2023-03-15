# Korvadības sistēma - kosist.lv

## Prerequisites
### Windows
1. Download and install Docker from https://www.docker.com/
2. Download and install Git for Windows - https://git-scm.com/download/win
3. All further actions should be done through GitBash terminal

### Linux (Ubuntu)
1. Install docker using - `sudo apt install docker.io`
2. Install docker compose using following instructions - https://docs.docker.com/compose/install/linux/

### MacOS
1. Download and install Docker from https://www.docker.com/

## Setup
### Automatic
1. Run `bash build.sh`
2. Open https://kosist.test or https://localhost/ from browser of choice

### Manual
1. Run `docker-compose up --build -d`
2. Connect to docker instance `docker exec -it kosist-app /bin/bash`
3. Run `composer install`
4. Run `php artisan migrate`
5. Open https://localhost/ from browser of choice

#### * Additional (optional) config
1. Edit `/etc/hosts` (Linux or macOS) or `C:\Windows\System32\drivers\etc\hosts` (Windows)
2. Add `127.0.0.1 kosist.test` at the end of the file
3. Open https://kosist.test from browser of choice
