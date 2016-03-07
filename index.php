<?php
use Cerberus\Providers\CerberusServiceProvider;

require_once __DIR__ . "/vendor/autoload.php";


$app = new Silex\Application();
$app->register(new Cerberus\Providers\CerberusServiceProvider());

$app->get('/helloworld/', function ($name) use ($app) {
    return 'Hello World';
});

$app->run();
