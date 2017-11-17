<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
// Routes

$app->get('/', 'Microblog\Controllers\DefaultController:index')
    ->name('index')
    ->setParams([$app]);

$app->get('/post', 'Microblog\Controllers\DefaultController:post')
    ->name('post')
    ->setParams([$app]);

$app->get('/admin', 'Microblog\Controllers\Admin\PostsController:lists')
    ->name('lists')
    ->setParams([$app]);

$app->get('/admin/posts', 'Microblog\Controllers\Admin\PostsController:lists')
    ->name('lists')
    ->setParams([$app]);

$app->get('/admin/login', 'Microblog\Controllers\Admin\UsersController:login')
    ->name('login')
    ->setParams([$app]);

$app->post('/admin/login', 'Microblog\Controllers\Admin\UsersController:loginSubmit')
    ->name('loginSubmit')
    ->setParams([$app]);

$app->get('/admin/posts/add', 'Microblog\Controllers\Admin\PostsController:add')
    ->name('addPost')
    ->setParams([$app]);

$app->post('/admin/posts/add', 'Microblog\Controllers\Admin\PostsController:addSubmit')
    ->name('addPostSubmit')
    ->setParams([$app]);
