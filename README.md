## Configuracion de Laravel

Estos son los pasos y comandos que debes correr al momento de clonar el proyecto

- Correr el comando **composer update** para instalar todas las dependencias laravel.
- Copiar el archivo .env.example y renombrarlo a .env.
- Colocar las diferentes variables de entorno en el archivo .env (las mas importantes son las de conexión a la BD).
- Correr el comando **php artisan key:generate**.
- Ejecutar el comando **php artisan migrate** para que se cree la bd

Ya se debería tener el laravel configurado.
## Configuracion del Front 

Estos son los pasos y comandos que debes correr al momento de clonar el proyecto

- Correr el comando **npm i** para instalar todas las dependencias node modules.
- Correr el comando **npm run dev** para preparar el front.


## Correr el proyecto

En una nueva consola de visual code, se debe correr el comando **php artisan serve** y la ruta generada por este comando es la debemos 
colocar en nuestro navegador.

### Autor
- **[Jeymar Herrera](https://github.com/jeymarherrera)**

## Instrucciones
- Puede regustrarse a traves del aplicativo pero le dara el rol de cliente
* Para tener role administrador por favor cambie el role a admin directamente en la bd que se creo en su mysql localhost o a traves de tinker (No tuve el tiempo de agregar un usuario predeterminado)