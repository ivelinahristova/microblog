<?php
use Microblog\Models\Posts;
// Routes

$app->get('/', 'Microblog\Controllers\DefaultController:index')
    ->name('index')
    ->setParams([$app]);

$app->get('/post/:id', function($id) use ($app) {
    $postsModel = new Posts($app);
    $post = $postsModel->getById($id);

    $app->render('header.phtml', []);
    $app->render('post.phtml', ['post' => $post]);
    $app->render('footer.phtml', []);
    })
    ->name('post');

$app->get('/admin', 'Microblog\Controllers\Admin\DashboardController:index')
    ->name('dashboard')
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
