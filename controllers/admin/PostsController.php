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

        $app->render('admin/lists.phtml', ['posts' => $posts]);
    }

    public function add(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('admin/lists.phtml', ['posts' => $posts]);
    }

    public function edit(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('admin/lists.phtml', ['posts' => $posts]);
    }
}