# CPX Seeders

Descripción:
Módulo de seeders incrementales para mantener el control de seeders ejecutados a través del tiempo.
El objetivo es que puedas agregar nuevos registros en la base de datos sin comprometer la integridad de los datos que ya existen.
Es sólamente aditivo, no permite rollbacks.

El módulo está basado en la estructura de migraciones de laravel para que sea simple de entender.

## Lista de comandos:
```php artisan cpx-seed:install```\
```php artisan make:cpx-seeder <name>```\
```php artisan cpx-seed```\
```php artisan cpx-seed:status```\
```php artisan cpx-migrate --seed```\
```php artisan cpx-migrate:fresh --seed```\
```php artisan cpx-migrate:status```

### Equivalencia de comandos:
#### Comandos de seeders:
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-seed:install``` (No existe en laravel)\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan make:cpx-seeder <name>``` = ```php artisan make:migration <name>```\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-seed``` = ```php artisan migrate```\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-seed:status``` = ```php artisan migrate:status```

#### Comandos Laravel migrations + seeders:
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-migrate --seed``` = ```php artisan migrate && php artisan cpx-seed```\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-migrate:fresh --seed``` = ```php artisan migrate:fresh && php artisan cpx-seed```\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-migrate:status``` = ```php artisan migrate:status && php artisan cpx-seed:status```

## Uso
1. Si no tiene el módulo de seeders incrementales crear la migración.\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan cpx-seed:install```
2. Crear la tabla que registra los seeders en la base de datos.\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan migrate```
3. Crear archivo seeder. Por defecto se crea en el directorio **database/cpx_seeders**.\
&nbsp;&nbsp;&nbsp;&nbsp;```php artisan make:cpx-seeder User```
4. Ejecutar el seeder con ```php artisan cpx-seed```. Este comando solo ejecuta los seeders que no se han ejecutado.

## Ejemplo
Ruta: **database/cpx_seeders/YYYY_MM_DD_HHMMSS_user_seeder.php**
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::create([
            'name' => 'John Doe',
            'email' => [EMAIL_ADDRESS]',
            'password' => bcrypt('password'),
        ]);
    }
}
```

### Nota:
Si quieres tener varios seeders para una misma tabla, no puedes usar el mismo nombre de seeder. Debes usar un nombre diferente para cada seeder.
Ejemplo:
  Para la primera vez UserSeeder.
  Para la segunda vez AddUserSellerSeeder.
  Para la tercera vez AddUserAdminSeeder.