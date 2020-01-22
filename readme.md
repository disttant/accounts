**1.  Introduction**

This is the manual page for explanations about Accounts Service. This service is made as a Laravel application because of the ease of fixing possible bugs in this microservice related to database, routes, security and other areas.

**2.  Dependencies**

* PHP >= 7.2.0
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

* Laravel Passport (Composer will install it automatically)
* Laravel Auth (Composer will install it automatically)

> Sometimes, `PHP XML extension is not available` as **php7-xml** and it's possible to install `php7-dom, php7-xmlreader, php7-xmlwriter`

> `PDO PHP Extension has another requirement` for doing the job. That requirement is the extension able to query the database in the background because PDO is just a kind of database proxy. So if we are going to use MySQL/MariaDB, que need another extension: **php7-mysql** 

Moreover, it is good to know that Laravel does not copy the /vendor folder when uploading the code to a git repository. This is because it uses composer to download dependencies when installing. Composer is a package manager for PHP software and it needs git too. So, after installing all the extensions for PHP, we need to install these extra packages on the system. 

> Remember: **install composer and git**

**3.  Web server**

This application can work with several web servers in the market but we decided to use NGINX because of the reliability on uptime and the ease of configuration. 

For this app, **we need to route all the traffic to the /public/index.php** file because it works like a proxy of the Laravel app.

The easier way is configuring a virtual host that listens to a fixed port like an independent server. **The most common path for vhost .conf files is /etc/nginx/vhosts.d. Inside that path we must to create a file with the following content:**

```php

server {
        listen 8000;
        server_name localhost;
        root /srv/accounts/public;

        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-XSS-Protection "1; mode=block";
        add_header X-Content-Type-Options "nosniff";

        index index.html index.htm index.php;

        charset utf-8;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        error_page 404 /index.php;

        location ~ \.php$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~ /\.(?!well-known).* {
            deny all;
        }
    }


```

**4. Installation process**

Once we have installed all the prequisites, installation of this app should be as easy as:
1.  Copy the project into a folder
2.  cd /path/to/app/main/dir
3.  composer install
4.  Re-copy the whole project into the main folder (this is because Passport overwrites a lot of things when installing)
5.  Configure database login parameters in ./.env
6.  php artisan migrate:fresh
7.  php artisan passport:keys


**5. Extra**

As always, some things could not be defined here. The most important part is to install all the extensions of PHP and **remember the following for the .env file**

```
APP_NAME="ALKE Accounts"
APP_ENV=local
APP_KEY=base64:VNt8gejhfX7I3UwNv40focB3QOoH7Jofju9C4h5UeNY=
APP_DEBUG=false
APP_URL=http://accounts.alke.es

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=DB_SERVER_IP
DB_PORT=3306
DB_DATABASE=DB_NAME
DB_USERNAME=DB_USER
DB_PASSWORD=DB_PASSWORD

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120
```


DONE