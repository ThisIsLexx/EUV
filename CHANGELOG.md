# Proceso de instalación y configuración del proyecto
En este documento podrá encontrar la forma para poder instalar el proyecto y configurarlo para usarlo
## REQUERIMIENTOS
- MySQL o MariaDB para el manejo de base de datos.
- Laragon para levantar servicios de apache y sql.
- PHP 8.2
## INSTALANDO EL PROYECTO
El primer paso para poder realizar la instalación del proyecto, es abrir una terminal desde laragon para ejecutar los siguientes comandos.
### Clonando el repositorio
```
git clone git@github.com:ThisIsLexx/EUV.git
```
Una vez el repositorio ha terminado de clonarse, ejecutar los siguientes comandos.
```
cp .env.example .env
composer i
npm i
php artisan key:generate
php artisan migrate --seed
```
### Configurando el proyecto
Dentro del archivo .env podrás encontrar algunos parametros para modificar los valores de entorno del proyecto. Es necesario que las credenciales
para tu usuario de MySQL o MariaDB esten configurados correctamente, y agregar la contraseña en caso de ser necesario.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=EUV
DB_USERNAME=root
DB_PASSWORD=
```
