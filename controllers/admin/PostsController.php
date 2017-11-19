<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Posts;

class PostsController extends DefaultController
{
    public function lists(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();
        $this->params['posts'] = $posts;

        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/posts/list.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }

    public function add(\Slim\Slim $app){
        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/posts/add.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }

    public function addSubmit(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();

        $formData = $app->request->post();
        $title = $formData['title'];
        $text = $formData['text'];
        $userId = $this->userId;

        $this->params['posts'] = $posts;
        $this->params['msg'] = $postsModel->insert($title, $text, $userId) ? 'You successfully added the post' : 'There was a problem adding the post';

        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/posts/list.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }

    public function edit(\Slim\Slim $app){
        $postsModel = new Posts($app);
        $posts = $postsModel->getAll();
        $this->params['posts'] = $posts;

        $app->render('admin/header.phtml', []);
        $app->render('admin/posts/list.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }
}