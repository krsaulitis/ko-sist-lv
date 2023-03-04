# ko-sist-lv

## Setup
### Docker
1. Download and install Docker from https://www.docker.com/
2. Run `docker-compose up --build -d`

### Backend
1. Connect to docker instance `docker exec -it kosist-app /bin/bash`
2. Run `composer install`
3. Run `php artisan migrate`
4. Open https://localhost/ from browser of choice

#### * Additional (optional) config
1. Edit `/etc/hosts` (Linux or macOS) or `C:/...` (Windows)
2. Add `127.0.0.1 kosist.test` at the end of the file
3. Open https://kosist.test from browser of choice

### Frontend
1. ...
