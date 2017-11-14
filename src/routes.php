<?php

// Routes

$app->get('/', 'Microblog\Controllers\DefaultController:index')
    ->name('index')
    ->setParams([$app]);