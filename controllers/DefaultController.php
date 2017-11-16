<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers;

use Microblog\Models\Posts;

class DefaultController
{
    public function __construct()
    {

    }

    public function index(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('home.phtml', ['posts' => $posts]);
    }

    public function post(\Slim\Slim $app){
        $id = 1;
        $postsModel = new Posts($app);
        $post = $postsModel->getById($id);

        $app->render('post.phtml', ['post' => $post]);
    }
}