# Mpwarfwk_App #
La parte de la aplicación del Framework creado para el MPWAR

# Instalación #

Primero descárgate este repositorio (por ejemplo a la derecha tienes la opción de bajartelo todo en un archivo.zip) y guardalo en un directorio de tu carpeta compartida de tu máquina virtual.
Para este ejemplo creamos una carpeta llamada framework y lo guardamos todo allí:

```zsh
[vagrant@localhost ~]$ mkdir /www/framework
```

Para trabajar con este framework debes crear dos virtualhosts. Uno para el entorno de desarrollo y otro para producción.
Teniendo en cuenta que lo hemos instalado todo en una carpeta llamada framework nuestro virtualhost de desarrollo seria el que apunta a index_dev de la carpeta public:

```zsh
[vagrant@localhost ~]$ sudo vi /etc/httpd/conf.d/20-framework.local.conf
```

```zsh
<VirtualHost *:80>
DocumentRoot /www/framework/public
ServerName framework.local
ServerAlias *.framework.local
RewriteEngine On
#Allowed media extensions (includes .txt files for robots or .html, e.g: Google hosted HTMLs):
RewriteCond %{REQUEST_FILENAME} !^(.+)\.(js|css|gif|png|jpg|swf|ico|txt|html)$
RewriteRule ^/(.+) /index_dev.php [QSA,L]
</VirtualHost>
```

y el virtualhost de producción el que apunta a index.php de la carpeta public:

```zsh
[vagrant@localhost ~]$ sudo vi /etc/httpd/conf.d/20-framework.pro.conf
```

```zsh
<VirtualHost *:80>
DocumentRoot /www/framework/public
ServerName framework.pro
ServerAlias *.framework.pro
RewriteEngine On
#Allowed media extensions (includes .txt files for robots or .html, e.g: Google hosted HTMLs):
RewriteCond %{REQUEST_FILENAME} !^(.+)\.(js|css|gif|png|jpg|swf|ico|txt|html)$
RewriteRule ^/(.+) /index.php [QSA,L]
</VirtualHost>
```

Ahora podremos acceder a nuestro framework desde 'framework.local' y 'framework.pro' y además hemos dejado los archivos frontcontroller (index_dev.php e index.php), que se encuentra en la carpeta Public, como único punto de entrada.
Modificamos el Hosts (sudo vi /etc/hosts)y le añadimos la siguente ip para poder ver los virtualhost que acabamos de crear:

```zsh
192.168.33.10 framework.local framework.pro
```

Reiniciamos Apache:
```zsh
[vagrant@localhost ~]$ sudo /etc/init.d/httpd restart
```

y ahora desde www/framework lanzamos el comando:

```zsh
[vagrant@localhost ~]$ composer update
```

Y se nos instalarán el resto de archivos (básicamente el framework con todas sus dependencias, twig, smarty, yaml...)

Si todo ha ido bien, desde el navegador, escribiendo 'framework.local' o 'framework.pro' podrás acceder a las páginas que he creado como demo, que explican diversas de las posibilidades del framework.

Antes, pero, necesitarás crearte una base de datos llamada framework para poder hacer la ruta completa por el framework. Tienes un dump de la misma en la carpeta database_dump.
