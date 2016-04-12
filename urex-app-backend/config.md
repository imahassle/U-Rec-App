# Configuration (Ubuntu Server)

This program was originally hosted on an Ubuntu server, based on this [configuration](https://www.digitalocean.com/community/tutorials/how-to-install-laravel-with-an-nginx-web-server-on-ubuntu-14-04), with a few minor changes:
 * No installation of Laravel is needed. Just SCP/FTP the files to the server.
 * For permissions (`urex-app-backend` is the application's root folder):
   * `sudo chown -R :www-data /var/www/urex-app-backend`
   * `sudo chmod -R 775 /var/www/urex-app-backend/storage`
   * `sudo chmod -R 775 /var/www/urex-app-backend/public`

I don't know how to configure this project on Windows, but hopefully better server admins can convert this configuration for Windows, if needed.

# Extensive steps to deploy app to a DO droplet (Ubuntu)

``` bash
sudo apt-get update
sudo apt-get install nginx php5-fpm php5-cli php5-mcrypt
sudo apt-get install git
cd /etc/nginx/sites-availavle/
vim default
```
# /etc/nginx/sites-availavle/default
change line 6 to: root/www/urex-app-backend/public/;
change line 7 to: index index.php index.html index.htm;
change server_name to <IP_OF_BOX>
add this:
``` php
location / {
        try_files $uri $uri/ /index.php?$query_string;
   	 }
    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
```
save vim file
``` bash
git clone  https://github.com/imahassle/U-Rec-App.git
mv U-Rec-App/urex-app-backend/ var/www/
apt-get install mysql-server
mysqld --initialize
cd /urex-app-backend/config/
vim database.php
```

# database.php
``` php
change connections to  'connections' => [
        'mysql' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'mysql',
            'username'  => 'root',
            'password'  => 'toddsapp',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
```
# /var/www/urex-app-backend/
``` bash        
sudo chown -R :www-data /var/www/urex-app-backend
sudo chmod -R 775 /var/www/urex-app-backend/storage
sudo chmod -R 775 /var/www/urex-app-backend/public
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
composer install
apt-get -y install php5-mysql
php artisan migrate
php artisan db:seed
```
