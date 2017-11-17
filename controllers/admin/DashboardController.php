<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Posts;

class DashboardController
{
    public function __construct()
    {

    }

    public function index(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $app->render('admin/header.phtml', []);
        $app->render('admin/dashboard.phtml', ['postsCount' => count($posts)]);
        $app->render('admin/footer.phtml', []);
    }
}