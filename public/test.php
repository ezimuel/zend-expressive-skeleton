<?php
chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$app = require 'config/app.php';

$app->get('/', function($request, $handler) {
    echo "Hello World!";
});

$app->run();
