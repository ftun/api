# api
API Rest Phalcon Framework




configuracion virtual host aplicacion api. Utilizando sl SO ubutun 16.04

crear el siguiente archivo de configuracion en el directorio:

**sudo gedit /etc/apache2/sites-available/api.conf**

agregar el siguiente contenido al archivo:

```
<VirtualHost *:80>

    ServerAdmin webmaster@localhost
    DocumentRoot "/var/www/html/api/public"
    ServerName apiRest
    ServerAlias dev.apiRest
    DirectoryIndex index.php

    <Directory "/var/www/html/api/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```

ejecutar los siguientes comandos para activar la configuacion del virtual host

**sudo a2ensite api.conf**

**sudo a2enmod rewrite**

**sudo a2enmod headers**

**sudo service apache2 restart**

configurar el archivo host con el siguiente comando:

**sudo nano /etc/hosts**

o

**sudo gedit /etc/hosts**

el cual deberia quedar de la siguiente manera:

**127.0.0.1	localhost dev.apiRest**

**127.0.1.1	@USER dev.apiRest**

*@USER: es el nombre del propietario del equipo

y por ultimo realizar la prueba en el sitio, entrar:

http://dev.apiRest/
