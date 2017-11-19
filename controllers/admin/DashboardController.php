<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Posts;

class DashboardController extends DefaultController
{
    public function index(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();
        $this->params['postsCount'] = count($posts);

        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/dashboard.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }
}