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

        $app->render('admin/posts/list.phtml', ['posts' => $posts]);
    }

    public function add(\Slim\Slim $app){
//        $postsModel = new Posts($app);
//        $posts = $postsModel->getAll();



        $app->render('admin/posts/add.phtml', []);
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

        $app->render('admin/posts/list.phtml', $params);
    }

    public function edit(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('admin/posts/list.phtml', ['posts' => $posts]);
    }
}