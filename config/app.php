<?php
/** @var \Psr\Container\ContainerInterface $container */
$container = require 'container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get(\Zend\Expressive\Application::class);

require 'config/pipeline.php';

return $app;
