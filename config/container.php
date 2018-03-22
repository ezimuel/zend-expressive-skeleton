<?php

declare(strict_types=1);

use Zend\ServiceManager\ServiceManager;

// Load configuration
$config = require 'config.php';

$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
