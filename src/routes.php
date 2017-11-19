<?php
use Microblog\Models\Posts;
use Microblog\Models\Users;

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

$app->get('/author/:id', function($id) use ($app) {
    $usersModel = new Users($app);
    $user = $usersModel->getById($id);
    $posts = $usersModel->getPosts($id);

    $app->render('header.phtml', []);
    $app->render('author.phtml', ['posts' => $posts, 'author' => $user['name']]);
    $app->render('footer.phtml', []);
})
    ->name('author');

$app->get('/admin', 'Microblog\Controllers\Admin\DashboardController:index')
    ->name('dashboard')
    ->setParams([$app]);

$app->get('/admin/posts', 'Microblog\Controllers\Admin\PostsController:lists')
    ->name('lists')
    ->setParams([$app]);

$app->get('/admin/posts/delete/:id', function($id) use ($app) {
    $postsModel = new Posts($app);
    $postsModel->deleteById($id);

    $app->redirectTo('lists');
})
    ->name('postDelete');

$app->get('/admin/login', 'Microblog\Controllers\Admin\UsersController:login')
    ->name('login')
    ->setParams([$app]);

$app->get('/admin/logout', 'Microblog\Controllers\Admin\UsersController:logout')
    ->name('logout')
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

$app->get('/admin/users', 'Microblog\Controllers\Admin\UsersController:lists')
    ->name('usersLists')
    ->setParams([$app]);

$app->get('/admin/users/add', 'Microblog\Controllers\Admin\UsersController:add')
    ->name('usersAdd')
    ->setParams([$app]);

$app->post('/admin/users/add', 'Microblog\Controllers\Admin\UsersController:addSubmit')
    ->name('usersAddSubmit')
    ->setParams([$app]);

$app->get('/admin/users/changepass', 'Microblog\Controllers\Admin\UsersController:changepass')
    ->name('changepass')
    ->setParams([$app]);

$app->post('/admin/users/changepass', 'Microblog\Controllers\Admin\UsersController:changepassSubmit')
    ->name('changepassSubmit')
    ->setParams([$app]);