# Doc24
> Challenge
## Table of Contents
* [General Info](#general-information)
* [Technologies Used](#technologies-used)
* [Setup](#setup)
* [Response](#response)
<!-- * [License](#license) -->
## General Information

Tareas:

Crea una nueva ruta en Slim para procesar peticiones POST en el siguiente formato de URL:
/update-persona/{id}/{brand}. La variable {id} y la variable {brand} deben ser parámetros dinámicos
que identifique el id de la persona y la marca relacionada con la solicitud.
Dentro de la ruta creada, implementa la lógica necesaria para realizar lo siguiente:

● Utiliza ORM Eloquent para obtener los datos de la tabla credenciales donde el campo brand
coincida con el valor recibido como parámetro en la URL. Los campos a obtener son client_id
y secret_id.

● Utiliza los datos obtenidos para generar un JWT (JSON Web Token) utilizando una librería JWT
de tu elección.

● Realiza una solicitud al webservice https://example.com/webservice utilizando el JWT como
parte de la autorización.

● La respuesta será en formato json con datos de una persona. Ejemplo:
{
"nombe": "Juan",
"apellido": "Gomez",
"edad": 25,
"telefono": "123456789"
}

● Utiliza Eloquent para actualizar un dato en la tabla de personas de acuerdo con el resultado
de la tarea.

● Guarda los cambios en la base de datos utilizando Eloquent.
Devuelve una respuesta en formato JSON con la siguiente estructura:
{
"estado": 1,
"mensaje": "Datos actualizados correctamente"
}

Si ocurre algún error durante el procesamiento de la solicitud, devuelve una respuesta en formato
JSON con la siguiente estructura:
{
"estado": 0,
"mensaje": "Ha ocurrido un error al procesar la solicitud"
}

## Technologies Used
- Slim Framework 4
- PHP 7.4
- Apache2
- ORM Eloquent 5.4
- PostgreSQL
- php-jwt
- Composer

## Setup
1. Clonar el repositorio git@github.com:matutev/doc24.git
2. Situado en la carpeta raiz del repositorio, abrir terminal y ejecutar "composer update".
3. Vamos a crear las tablas personas y credenciales y algunos registros. Si queremos solo el esquema de las tablas, nos dirigimos a "src/db/personas_create.php" y "src/db/credenciales_create.php" y luego cambiamos el valor de la variable $insertRows a false.
4. Para crear las tablas, en un navegador ejecutar estas 2 rutas "http://localhost/doc24/src/db/personas_create.php" y "http://localhost/doc24/src/db/credenciales_create.php".
5. Por ultimo, acceder a una aplicacion que permita probar API web como Postman, elige metodo POST, ingresa como URL "http://localhost/doc24/public/update-persona/{id}/{brand}" y ejecutar.

## Response

● status: 200  =>       {"estado":1,"mensaje":"Datos Actualizados correctamente"}

● status: 400  =>       {"estado":0,"mensaje":"La peticion es incorrecta."}

● status: 401  =>       {"estado":0,"mensaje":"Fallo en el token de autenticacion."}

● status: 500  =>       {"estado":0,"mensaje":"Ha ocurrido un error al procesar la solicitud"}






