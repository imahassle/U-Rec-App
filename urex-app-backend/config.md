# Configuration (Ubuntu Server)

This program was originally hosted on an Ubuntu server, based on this [configuration](https://www.digitalocean.com/community/tutorials/how-to-install-laravel-with-an-nginx-web-server-on-ubuntu-14-04), with a few minor changes:
 * No installation of Laravel is needed. Just SCP/FTP the files to the server.
 * For permissions (`urex-app-backend` is the application's root folder):
   * `sudo chown -R :www-data /var/www/urex-app-backend`
   * `sudo chmod -R 775 /var/www/urex-app-backend/storage`
   * `sudo chmod -R 775 /var/www/urex-app-backend/public`

I don't know how to configure this project on Windows, but hopefully better server admins can convert this configuration for Windows, if needed.
