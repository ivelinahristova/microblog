<?php

$config = require('config.dist.php');

return [
    'templates.path' => __DIR__ . '/../templates/',
    'db' => $config['db']
];
