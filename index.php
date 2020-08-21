<?php

require './vendor/autoload.php';

use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);

$router->namespace("App");

$router->get('/', 'Todoist:updateHabits');

$router->dispatch();