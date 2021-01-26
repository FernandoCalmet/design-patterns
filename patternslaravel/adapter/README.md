# Strategy Pattern

El patrón de adaptador funciona como un puente entre dos interfaces incompatibles. Este tipo de patrón de diseño viene bajo patrón estructural ya que este patrón combina la capacidad de dos interfaces independientes.

Este patrón involucra a una sola clase que es responsable de unir funcionalidades de interfaces independientes o incompatibles. Un ejemplo de la vida real podría ser el caso de un lector de tarjetas que actúa como adaptador entre la tarjeta de memoria y una computadora portátil. Conecta la tarjeta de memoria al lector de tarjetas y el lector de tarjetas a la computadora portátil para que la tarjeta de memoria se pueda leer a través de la computadora portátil.

## Implementación

Se implementara un adaptador para consumir los endpoints de **restcountries.eu** en nuestro proyecto.

## Paso 1

Crear un proyecto con Laravel

```bash
composer create-project laravel/laravel adapter
```


## Paso 2

Crear una carpeta **Contracts** y agregar una interfaz llamada **CountriesService.php**.

> app/Contracts/CountriesService.php

```php
<?php

namespace App\Contracts;

interface CountriesService
{
    public function getCountries();
    public function getCountryByName(string $name);
    public function getCountryByCapital(string $capital);
}
```

## Paso 3

Crear un controlador **CountryController** para gestionar las rutas del adaptador.

```bash
php artisan make:controller CountryController
```

## Paso 4

Agregamos en el service provider un data binding para agregar los servicios de paises de la API.

> app/Providers/AppServiceProvider.php

```php
<?php

namespace App\Providers;

use App\Contracts\CountriesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        CountriesService::class => RestCountriesAdapter::class
    ];
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
```

## Paso 5

Definir los metodos de la interfaz del adaptador y importar el adaptador en el constructor para poder acceder a todos sus metodos.

> app/Http/Controllers/CountryController.php

```php
<?php

namespace App\Http\Controllers;

use App\Contracts\CountriesService;

class CountryController extends Controller
{
    private $restCountriesAdapter;

    public function __construct(CountriesService $countryService)
    {
        $this->restCountriesAdapter = $countryService;
    }

    public function getCountries()
    {
        return $this->restCountriesAdapter->getCountries();
    }

    public function getCountryByName()
    {
        $name = request()->get('name');

        return $this->restCountriesAdapter->getCountryByName($name);
    }

    public function getCountryByCapital()
    {
        $capital = request()->get('capital');

        return $this->restCountriesAdapter->getCountryByCapital($capital);
    }
}
```

## Paso 6

Creamos la rutas para acceder al controlador.

> routes/api.php

```php
<?php

use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/countries', [CountryController::class, 'getCountries']);
Route::get('/country-by-name', [CountryController::class, 'getCountryByName']);
Route::get('/country-by-capital', [CountryController::class, 'getCountryByCapital']);
```


## Paso 7

Agregar al archivo de configuración de la app la URL de la API de **restcountries** que vamos a consumir.

> config/services.php

```php
<?php

return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'restcountries' => [
        'endpoint' => 'https://restcountries.eu/rest/v2/'
    ]

];
```

## Paso 8

Crear una carpeta **Adapters** y agregar una clase adaptador llamada **RestCountriesAdapter**. Donde se va a utilizar **Guzzle** para gestionar el cliente HTTP.

> app/Adapters/RestCountriesAdapter.php

```php
<?php

namespace App\Adapters;

use App\Contracts\CountriesService;
use Illuminate\Support\Facades\Http;

class RestCountriesAdapter implements CountriesService
{
    private $endpoint;

    public function __construct()
    {
        $this->endpoint = config('services.restcountries.endpoint');
    }

    public function getCountries()
    {
        $response = Http::get("{$this->endpoint}all");

        return $response->json();
    }

    public function getCountryByName(string $name)
    {
        $response = Http::get("{$this->endpoint}name/$name");

        return $response->json();
    }

    public function getCountryByCapital(string $capital)
    {
        $response = Http::get("{$this->endpoint}capital/$capital");

        return $response->json();
    }
}
```

## Paso 9

Ejecutar en localhost:8080

```bash
php artisan serve
```

Pruebe y verifique la salidas con la colección de Postman: [Importar Colección](https://www.getpostman.com/collections/684ce4a16e586ae0362b).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://www.getpostman.com/collections/684ce4a16e586ae0362b)  
  
HTTP Method | URL | Param Key | Param Value
--- | --- | --- | ---
GET | `/api/countries` | - | -
GET | `/api/country-by-name` | name | peru
GET | `/api/country-by-capital` | capital | lim

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
