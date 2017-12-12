Alfred Nginx & MySQL & PHP-fpm
================================

Alfred 2 workflow to Toggle Localhost Services (Start, Stop, Restart and Check Status).

Based on my Localhost Enviroment [Installation](http://blog.frd.mn/install-nginx-php-fpm-mysql-and-phpmyadmin-on-os-x-mavericks-using-homebrew) (Thanks [frdmn](http://blog.frd.mn)!!).

> **Commands Included:** `localhost`, `nginx-cmd [start|stop|restart|status]`, `php-fpm-cmd [start|stop|restart|status]`, `mysql-cmd [start|stop|restart|status]`, `memcached-cmd [start|stop|restart|status]`.

## Installing
1. Click the download buttons below
2. Double-click to import into Alfred 2
3. Review the workflow to add custom Hotkeys
4. Edit /etc/sudoers to allow sudo to work without entering the password.

### Edit sudoers

1. `sudo visudo`
2. Add:<br>
	`Cmnd_Alias      NGINXSTART = /bin/launchctl load /Library/LaunchAgents/homebrew.mxcl.nginx.plist`<br>
	`Cmnd_Alias      NGINXSTOP = /bin/launchctl unload /Library/LaunchAgents/homebrew.mxcl.nginx.plist`<br><br>
	`username  ALL = NOPASSWD: NGINXSTART, NGINXSTOP`<br><br>

* * *

#### Localhost
![Screenshot](./src/screens/localhost.png)<br><br>

#### Nginx
![Screenshot](./src/screens/nginx.png)<br><br>

#### MySQL
![Screenshot](./src/screens/mysql.png)<br><br>

#### PHP-fpm
![Screenshot](./src/screens/php-fpm.png)<br><br>

#### Memcached
![Screenshot](./src/screens/memcached.png)<br><br>
