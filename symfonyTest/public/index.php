<?php
use App\Kernel;

//header('Content-type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "http://vueproject.local" || $http_origin == "http://localhost:8080")
{
    header("Access-Control-Allow-Origin: $http_origin");
}


require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
