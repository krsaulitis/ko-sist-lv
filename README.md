# Korvadības sistēma - kosist.lv

## Prerequisites
### Windows
1. Download and install Docker from https://www.docker.com/
2. Download and install Git for Windows - https://git-scm.com/download/win
3. All further actions should be done through GitBash terminal

### Linux
1. Install docker using - `sudo apt install docker.io` (<b>Only Ubuntu/Debian</b>) For other distros follow: https://docs.docker.com/desktop/linux/install/
2. (<b>If `docker compose` doesn't work</b>) Install docker compose using following instructions - https://docs.docker.com/compose/install/linux/
3. Set up permissions for Docker if needed:
    - `sudo usermod -a -G docker [user_name]`
    - `newgrp docker`

### MacOS
1. Download and install Docker from https://www.docker.com/

## Setup
### Automatic
1. Run `bash build.sh`
2. Open https://kosist.test or https://localhost/ from browser of choice

### Manual
1. Run `docker compose build --no-cache`
2. Run `docker compose up -d`
3. Connect to docker instance `docker exec -it kosist-app /bin/bash`
4. Copy .env.example to .env `cp .env.example .env`
5. Install required php packages - run `composer install`
6. Install required npm packages - run `npm install`
7. Set up database - run `php artisan migrate`
8. Build frontend - run `npm run build`
9. Open https://localhost/ from browser of choice

#### * Additional (optional) config
1. Edit `/etc/hosts` (Linux or macOS) or `C:\Windows\System32\drivers\etc\hosts` (Windows)
2. Add `127.0.0.1 kosist.test` at the end of the file
3. Open https://kosist.test from browser of choice

#### * Sākotnējais dokuments:
https://docs.google.com/document/d/1SRhEzSGWGs_138FUkqPDfD_ZpUUJL3FhAieG0tFNX1s/edit#

#### * Esošais dizaina apraksts:
https://docs.google.com/document/d/1VqbX0v-3tz63FEKzLHdGlzlUp6WPW3DllULLItIK_jA/edit#
