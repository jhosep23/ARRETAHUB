<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/conectionDB.php';


$app = new \Slim\App;

$container = $app->getContainer();

//clientes
require '../src/routes/clientes.php';

$app->run();