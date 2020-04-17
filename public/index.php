<?php

require '../config/dev.php';
require '../vendor/autoload.php';

$router = new \Blog\config\Router();
$router->run();