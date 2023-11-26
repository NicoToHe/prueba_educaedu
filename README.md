# PRUEBA EDUCAEDU

## Instalación

Clonar repositorio con el siguiente comando:
```
git clone https://github.com/NicoToHe/prueba_educaedu.git
```
A continuación instalar dependencias con composer:
```
composer install
```
Crear la base de datos para los datos dummy:
```
php bin/console doctrine:database:create
```
Ejecutar las migraciones para cargar los datos dummy:
```
php bin/console doctrine:migrations:migrate
```

## Probar la aplicación de forma manual
La app contiene dos id validas: 1 y 2

Se puede acceder a ellas de la siguiente manera:
```
/curso/$id
```

## Ejectur los test
Primero se crea la base de datos a la que accederan los test con estos comandos:
```
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create
```
Y ahora se llama a los test:
```
php bin/phpunit
```
