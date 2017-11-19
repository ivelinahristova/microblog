<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Posts;
use Microblog\Models\Users;
use Slim\Slim;

class DashboardController extends DefaultController
{
    public function index(Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();
        $this->params['postsCount'] = count($posts);

        $usersModel = new Users($app);
        $users = $usersModel->getAll();
        $this->params['usersCount'] = count($users);

        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/dashboard.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }
}