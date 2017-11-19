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

        $app->render('header.phtml', []);
        $app->render('home.phtml', ['posts' => $posts]);
        $app->render('footer.phtml', []);
    }

    public function author(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('header.phtml', []);
        $app->render('home.phtml', ['posts' => $posts]);
        $app->render('footer.phtml', []);
    }
}