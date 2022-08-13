<?php

//if (!session_id() ) @session_start();

require __DIR__."/../vendor/autoload.php";

use DI\ContainerBuilder;
use League\Plates\Engine;
use Delight\Auth\Auth;
use Aura\SqlQuery\QueryFactory;


$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    League\Plates\Engine::class =>function(){
    return new Engine('../views/templates');
    },
    PDO::class => function(){
        $driver="mysql";
        $host="localhost";
        $dbname="module";
        $username ="root";
        $password="root";
        return  new PDO("$driver:host=$host;dbname=$dbname",$username,$password);
       //return new PDO("mysql:host=localhost;dbname=module","root","root");
    },
    Auth::class => function($container){
    return new Auth($container->get('PDO'));
    },
    QueryFactory::class => function(){
    $db="mysql";
    return new QueryFactory($db);
    }
]);
$container = $containerBuilder->build();
//$mailer = new SimpleMail();
//d(SimpleMail::make()
//    ->setTo('manulwild@gmail.com', 'Sveta')
//    ->setFrom('sonyatestest@gmail.com', 'admin')
//    ->setSubject('test test')
//    ->setMessage('сообщение')
//    ->send());exit;

//SimpleMail::make()
//    ->setTo('manulwild@gmail.com', 'Sveta')
//    ->setFrom('info@gmail.com', 'admin')
//    ->setSubject('test test')
//    ->setMessage('сообщение')
//    ->send();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
//    $r->addRoute('GET', '/homepage/{amount:\d+}', ['Controllers\HomepageController','homepage']);
     $r->addRoute('GET', '/homepage', ['Controllers\HomepageController','homepage']);
    $r->addRoute('GET', '/login', ['Controllers\LoginPageController', 'index']);
    $r->addRoute('POST', '/login', ['Controllers\LoginPageController', 'logIn']);
    $r->addRoute('GET', '/logout', ['Controllers\UsersController', 'logout']);
    $r->addRoute('GET', '/delete', ['Controllers\UsersController', 'delete']);
    $r->addRoute('GET', '/', ['Controllers\UsersController', 'index']);
    $r->addRoute('GET', '/profile', ['Controllers\ProfileController', 'index']);
    $r->addRoute('GET', '/create', ['Controllers\CreateUserController', 'index']);
    $r->addRoute('POST', '/create', ['Controllers\CreateUserController', 'insert']);
    $r->addRoute('GET', '/edit', ['Controllers\EditUserController', 'index']);
    $r->addRoute('POST', '/edit', ['Controllers\EditUserController', 'update']);
    $r->addRoute('GET', '/medias', ['Controllers\MediaController', 'index']);
    $r->addRoute('POST', '/medias', ['Controllers\MediaController', 'update']);
    $r->addRoute('GET', '/register', ['Controllers\RegisterController', 'index']);
    $r->addRoute('GET', '/emailVerification', ['Controllers\RegisterController', 'emailVerification']);
//    $r->addRoute('POST', '/register', ['Controllers\RegisterController', 'update']);
    $r->addRoute('POST', '/register', ['Controllers\RegisterController', 'userRegister']);
    $r->addRoute('GET', '/status', ['Controllers\StatusController', 'index']);
    $r->addRoute('POST', '/status', ['Controllers\StatusController', 'update']);
    $r->addRoute('GET', '/security', ['Controllers\SecurityController', 'index']);
    $r->addRoute('POST', '/security', ['Controllers\SecurityController', 'update']);


    $r->addRoute('GET', '/404', ['Controllers\PageNotFoundController', 'index']);
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/', 'get_user_handler');
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

//d($_SERVER);

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header("LOCATION:/404");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "not allowed";
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
//        $handler = $routeInfo[1];
//
//        $vars = $routeInfo[2];


$container = $container->call($routeInfo[1],$routeInfo[2]);
//d($container);exit;
//        $controller = new $handler[0];
//    call_user_func([$controller, $handler[1]], $vars);

        break;
}