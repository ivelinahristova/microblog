<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Posts;

class DefaultController
{
    protected $params = [];
    protected $isLogged = FALSE;
    protected $userId = null;

    public function __construct()
    {
        session_start();
        if(isset($_SESSION['userId']) && $_SESSION['userId']) {
            $this->userId = $_SESSION['userId'];
            $this->isLogged = TRUE;
        }

        $this->params['isLogged'] = $this->isLogged;
        $this->params['userId'] = $this->userId;
    }

    public function index(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();
        $this->params['postsCount'] = count($posts);

        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/dashboard.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }
}