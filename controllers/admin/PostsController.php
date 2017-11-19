<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Posts;

class PostsController
{
    public function __construct()
    {

    }

    public function lists(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('admin/header.phtml', []);
        $app->render('admin/posts/list.phtml', ['posts' => $posts]);
        $app->render('admin/footer.phtml', []);
    }

    public function add(\Slim\Slim $app){
//        $postsModel = new Posts($app);
//        $posts = $postsModel->getAll();


        $app->render('admin/header.phtml', []);
        $app->render('admin/posts/add.phtml', []);
        $app->render('admin/footer.phtml', []);
    }

    public function addSubmit(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $formData = $app->request->post();
        $title = $formData['title'];
        $text = $formData['text'];

        $params = [
            'posts' => $posts
        ];
        $params['msg'] = $postsModel->insert($title, $text) ? 'You successfully added the post' : 'There was a problem adding the post';

        $app->render('admin/header.phtml', $params);
        $app->render('admin/posts/list.phtml', $params);
        $app->render('admin/footer.phtml', []);
    }

    public function edit(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('admin/header.phtml', []);
        $app->render('admin/posts/list.phtml', ['posts' => $posts]);
        $app->render('admin/footer.phtml', []);
    }
}