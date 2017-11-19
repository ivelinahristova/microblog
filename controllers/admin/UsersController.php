<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Users;

class UsersController extends DefaultController
{
    public function login(\Slim\Slim $app){
        $app->render('admin/login.phtml', $this->params);
    }

    public function loginSubmit(\Slim\Slim $app){
        $usersModel = new Users($app);
        $formData = $app->request->post();
        $email = $formData['email'];
        $password = $formData['password'];
        $user = $usersModel->getByEmail($email);

        if($user && $user['password'] && password_verify($password, $user['password'])) {
            session_regenerate_id();
            $sessionId = session_id();
            $_SESSION['userId'] = $user['id'];
            $usersModel->setLastLogin($user['id'], $sessionId);
        }

        $app->redirectTo('dashboard');
    }

    public function logout(\Slim\Slim $app) {
        session_unset();
        session_regenerate_id();

        $app->redirectTo('login');
    }
}