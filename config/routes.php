<?php

declare(strict_types=1);

$app->get('/', App\Handler\HomePageHandler::class, 'home');
$app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
