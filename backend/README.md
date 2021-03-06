создаем файл конфига
composer install
key:generate
migrate
db:seed
добавить файлы конфигурации для инжинкс в nginx/conf.d

default.conf
## start
# All requests with response
# codes 2xx and 3xx will not be logged:
map $status $loggable {
        ~^[23]  0;
        default 1;
    }
## end

vhost.conf
## start
server {
    listen 80;
    index index.php index.html;
    error_log /var/log/nginx/backend.error.log;
    access_log /var/log/nginx/backend.access.log combined if=$loggable;

     location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        add_header Access-Control-Allow-Origin *;
        root /var/www/html/public;
        include fastcgi_params;
        include fastcgi.conf;
        fastcgi_pass php-7.4:9000;
        fastcgi_index index.php;
        fastcgi_param PATH_INFO $fastcgi_path_info;

    }
}

## end


sudo docker ps					-все запущенные контейнеры
sudo docker stop $(sudo docker ps -a -q)	-остановить все контейнеры
sudo docker rm $(sudo docker ps -a -q)	-удалить все контейнеры
sudo docker images				-список images
sudo docker rmi $(sudo docker images -q)	-удалить все images
sudo docker-compose build			-собрать docker образ		
sudo docker exec -it <container_id> bash   - войти в контейнер	
sudo docker-compose up запустить контейнеры
sudo systemctl stop apache2



php artisan migrate:refresh
php artisan db:seed

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
